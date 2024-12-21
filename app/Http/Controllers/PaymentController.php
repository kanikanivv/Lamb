<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Cart;
use App\Models\User;
use Payjp\Payjp;
use Payjp\Charge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * 決済のサンプルコード
 */
class PaymentController extends Controller
{
    public function create()
    {
        return view('payment.create');
    }

    public function createCharge(Request $request)
{
    if (empty($request->get('payjp-token'))) {
        return redirect()->back()->with('error', 'カード情報が不足しています');
    }

    DB::beginTransaction();

    try {
        // ログインユーザ取得
        $user = auth()->user();
        // シークレットキー設定
        \Payjp\Payjp::setApiKey(config('payjp.secret_key'));

        // 顧客IDがない場合は新規作成
        if (empty($user->payjp_customer_id)) {
            // 顧客情報登録
            $customer = \Payjp\Customer::create([
                'card' => $request->get('payjp-token'),
                'description' => "userId: {$user->id}, userName: {$user->name}",
            ]);
            // DBにpayjpの顧客IDを登録
            $user->payjp_customer_id = $customer->id;
            $user->save();
        } elseif {
            // 既存の顧客情報がある場合、カードを追加または設定
            $customer = \Payjp\Customer::retrieve($user->payjp_customer_id);
            if (!empty($request->get('payjp_card_id'))) {
                // 使用するカードを設定
                $customer->default_card = $request->get('payjp_card_id');
                $customer->save();
            } else {
                // 新しいカードを追加
                $card = $customer->cards->create([
                    'card' => $request->get('payjp-token'),
                ]);
                // 使用するカードを設定
                $customer->default_card = $card->id;
                $customer->save();
            }
        }

        // 支払処理
        \Payjp\Charge::create([
            'customer' => $customer->id,
            'amount' => 100,  // 金額
            'currency' => 'jpy',
        ]);

        // カート内の商品を削除
        Cart::where('user_id', $user->id)->delete();

        DB::commit();

        return redirect(route('items.done'))->with('message', '支払が完了しました');

    } catch (\Exception $e) {
        Log::error($e);
        DB::rollback();

        if (strpos($e, 'has already been used') !== false) {
            return redirect()->back()->with('error-message', '既に登録されているカード情報です');
        }
        return redirect()->back()->with('error', '支払いに失敗しました');
    }
}
}
