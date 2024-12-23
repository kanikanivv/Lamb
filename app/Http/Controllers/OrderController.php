<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use Payjp\Payjp;
use Payjp\Charge;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{
    /**
     * カート内商品を表示
     *
     * @return void
     */
    public function index()
    {
        $user_id = Auth::id();

        // itemがnullでないカートアイテムのみ取得
        $carts = Cart::with('item', 'user')
        ->where('user_id', $user_id)
        ->whereHas('item')
        ->get();

        //合計金額の計算
        $total = $carts->reduce(function ($carry, $cart) {
            //dd($cart->item->item_price);
            //dd($cart->count);
                $subtotal = $cart->item->item_price * $cart->count;
            return $carry + $subtotal;
        }, 0);
        $user = auth()->user();
        $total_count = $carts->sum('count'); //カート内の商品数の合計

        $cardList = [];

         // 既にpayjpに登録済みの場合
        if (!empty($user->payjp_customer_id)) {
         // PayJPのAPIキー設定
            \Payjp\Payjp::setApiKey(config('payjp.secret_key'));

             // 顧客情報取得
            $customer = \Payjp\Customer::retrieve($user->payjp_customer_id);

             // カード一覧を取得
            $cardDatas = $customer->cards->data;
            foreach ($cardDatas as $cardData) {
            $cardList[] = [
                'id' => $cardData->id,
                'cardNumber' =>  "**** **** **** {$cardData->last4}",
                'brand' =>  $cardData->brand,
                'exp_year' =>  $cardData->exp_year,
                'exp_month' =>  $cardData->exp_month,
                'name' =>  $cardData->name,
            ];
        }
        }
        return view('orders.index', compact('carts', 'total', 'total_count', 'user', 'cardList'));
    }


    public function createCharge(Request $request)
    {

        // ログインユーザ取得
        $user = auth()->user();
        $user_id = Auth::id();

        // itemがnullでないカートアイテムのみ取得
        $carts = Cart::with('item', 'user')
        ->where('user_id', $user_id)
        ->whereHas('item')
        ->get();

                    // 各カートアイテムごとにOrderDetailを作成
                    foreach ($carts as $cart) {
                        $item = $cart->item;  // カートに関連するアイテム
                        $itemCount = $cart->count;

        //合計金額の計算
        $total = $carts->reduce(function ($carry, $cart) {
            $subtotal = $cart->item->item_price * $cart->count;
            return $carry + $subtotal;
        }, 0);

        DB::beginTransaction();

        if (empty($request->get('payjp-token'))) {
            return redirect()->back()->with('error', 'カード情報が不足しています');
        }

        try {
            // ログインユーザー取得
            $user = auth()->user();
            //  シークレットキーを設定
            \Payjp\Payjp::setApiKey(config('payjp.secret_key'));

            //  顧客情報登録
            $customer = \Payjp\Customer::create([
              // カード情報も合わせて登録する
            'card' => $request->get('payjp-token'),
              // 概要
            'description' => "userId: {$user->id}, userName: {$user->name}",
            ]);

            //  DBにpayjpの顧客idを登録
            $user->payjp_customer_id = $customer->id;
            $user->save();

            //  支払い処理
            // 新規支払い情報作成
            \Payjp\Charge::create([
               // 上記で登録した顧客のidを指定
            "customer" => $customer->id,
               // 金額
            "amount" => $total,
               // 通貨
            "currency" => 'jpy',
            ]);

                // デバッグ用ログ
                Log::info('支払い処理完了');

                // 注文の作成
                $order = Order::create([
                    'user_id'        => $user->id,
                    'billing_amount' => $total,
                ]);

                // デバッグ用ログ
                Log::info('注文作成完了: ', $order->toArray());

                $orderdetail = OrderDetail::create([
                    'user_id'        => $user->id,
                    'item_id'        => $item->id,
                    'item_count'     => $itemCount,
                    'price'          => $item->item_price
                ]);

                // デバッグ用ログ
                Log::info('注文作成完了: ', $orderdetail->toArray());

            // カート内の商品を削除
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect(route('items.done'))->with('message', '支払が完了しました');

        } catch (\Exception $e) {
            Log::error('決済エラー: ' . $e->getMessage());
            DB::rollback();
            return redirect()->back()->with('error', '支払いに失敗しました。エラー詳細: ' . $e->getMessage());
            // return redirect()->back()->with('error', '支払いに失敗しました');
        }
    }
    }

    public function payment(Request $request)
    {
        // ログインユーザ取得
        $user = auth()->user();
        $user_id = Auth::id();

        // itemがnullでないカートアイテムのみ取得
        $carts = Cart::with('item', 'user')
            ->where('user_id', $user_id)
            ->whereHas('item')
            ->get();

            // 各カートアイテムごとにOrderDetailを作成
        foreach ($carts as $cart) {
            $item = $cart->item;  // カートに関連するアイテム
            $itemCount = $cart->count;

        //合計金額の計算
        $total = $carts->reduce(function ($carry, $cart) {
            $subtotal = $cart->item->item_price * $cart->count;
            return $carry + $subtotal;
        }, 0);
        DB::beginTransaction();

        try {
            // シークレットキー設定
            \Payjp\Payjp::setApiKey(config('payjp.secret_key'));

            if (!empty($user->payjp_customer_id)) {
                // 既存の顧客情報がある場合、カードを追加または設定
                $customer = \Payjp\Customer::retrieve($user['payjp_customer_id']);

                if (!empty($request->get('payjp_card_id'))) {
                    // 使用するカードを設定
                    $customer->default_card = $request->get('payjp_card_id');
                    $customer->save();
                } else {
                    //選択してない場合
                    return redirect()->back()->with('error', 'カードを選択してください');
                }
            }
            // 支払処理
            \Payjp\Charge::create([
                'customer' => $customer->id,
                'amount'   => $total,  // 金額
                'currency' => 'jpy',
            ]);

                // デバッグ用ログ
            Log::info('支払い処理完了');

            // 注文の作成
            $order = Order::create([
                'user_id'        => $user->id,
                'billing_amount' => $total,
            ]);

            // デバッグ用ログ
            Log::info('注文作成完了: ', $order->toArray());

            $orderdetail = OrderDetail::create([
                'user_id'        => $user->id,
                'item_id'        => $item->id,
                'item_count'     => $itemCount,
                'price'          => $item->item_price
            ]);

            // デバッグ用ログ
            Log::info('注文作成完了: ', $orderdetail->toArray());

            //カート内の商品を削除
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect(route('items.done'))->with('message', '支払が完了しました');

        } catch (\Exception $e) {
            Log::error('決済エラー: ' . $e->getMessage());
            DB::rollback();
            return redirect()->back()->with('error', '支払いに失敗しました。エラー詳細: ' . $e->getMessage());
            // return redirect()->back()->with('error', '支払いに失敗しました');
        }
    }
}
}
