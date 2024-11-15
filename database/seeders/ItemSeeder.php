<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 出力件数を指定
        $NUM_FAKER = 21;
        $faker = Factory::create('ja_JP');
        $itemTitle = [
            'ボアフリースジャケット',
            'フローラルフリルブラウス',
            'ハイウエストストレートパンツ',
            'チェスターコート',
            'クロスボディバッグ',
            'スニーカー',
            'プリーツスカート',
            'デニムジャケットインナー',
            'ストライプ柄ボウタイブラウス',
            'ロングブーツ',
            'ダブルブレストブレザー',
            'サイドゴアブーツ',
            'フレアシルエットジーンズ',
            'ショルダーバッグ',
            'シルクドレープトップ',
            'ラップスカート',
            'エスパドリーユ',
            'スリムバッグ',
            'ジップトップトート',
            'スリットスカート',
            'バレエフラット'
        ];
        $itemComment = [
            '「寒い季節には欠かせないアイテムです。柔らかくて温かい素材がとても心地よく、寒さ対策にはぴったりです。丈感も丁度良く、重ね着しても動きやすいのが嬉しいポイント。カジュアルに着こなせるので、デイリー使いにも最適ですが、毛が抜けやすい点が少し気になります。',
            '「フラワープリントとフリルデザインが可愛らしく、着るだけで気分が上がります。軽やかな素材感が春や秋にぴったりで、デニムやスカートにも合わせやすいです。特別な日だけでなく、普段使いにも使える万能アイテムです。とてもお気に入り！',
            '「ハイウエスト仕様なので、脚長効果があり、スタイルアップできます。ストレートのシルエットがきれいで、どんなトップスとも相性が良いです。少しポケットが浅いのが気になりますが、履き心地は良く、カジュアルにもきれいめにも使える優れたアイテムです。',
            '「シンプルで洗練されたデザインが素晴らしいです。どんな服にも合わせやすく、上品な印象を与えてくれます。軽量なのに暖かく、寒い日にも活躍します。長く使える一着で、カジュアルにもドレッシーにも着こなせるので、非常に重宝しています。',
            '「コンパクトで使いやすく、軽量なのでお出かけに最適です。ショルダーストラップの長さを調節できるため、どんな体型でも使いやすい点が嬉しいです。収納も十分で、必要最低限のアイテムがすっきりと収まります。肩が少し疲れることがあるので、長時間使用する際には注意が必要です。',
            '「シンプルなデザインがどんなコーディネートにも合わせやすく、デイリーに活躍します。歩きやすくて、長時間履いても疲れにくいのが嬉しいポイントです。クッション性のあるソールが足をしっかりサポートしてくれるので、日常使いにはとても便利なアイテムです。',
            '「動くたびに揺れるプリーツがとてもきれいで、女性らしさを引き立ててくれます。ウエスト部分がゴムなので、着心地が良く、楽に履けます。少し長めの丈なので、身長によってはバランスを考えてコーディネートするとより美しく見えます。',
            '「軽く羽織るのにぴったりなアイテムです。インナーとして使っても良いし、アウターとしても使える汎用性の高いアイテム。シンプルなデザインなので、どんなコーディネートにも合わせやすいですが、袖が少し短めなのが気になる点です。',
            '「ストライプ柄がシンプルでありながら、ボウタイがフェミニンな印象を与えます。オフィスにもカジュアルにも着こなせるデザインで、素材も滑らかで着心地がとても良いです。シワになりにくく、長時間着ても快適です。オールシーズン使える一着です。',
            '「脚長効果抜群で、履くだけでシルエットが美しく見えます。合わせる服を選ばないシンプルなデザインが素敵で、カジュアルにもエレガントにもコーディネートできます。足元をすっきり見せることができ、寒い季節でも暖かく過ごせます。',
            '「クラシックなデザインが大人っぽい印象を与えます。きれいめにもカジュアルにも着こなせるため、シーンを選ばず活躍します。生地もしっかりしていて、形も崩れにくいです。ビジネスシーンでも大活躍するアイテムです。',
            '「履きやすさが抜群で、脱ぎ履きが簡単なのが嬉しいポイント。デザインが特徴的で、カジュアルながらもスタイリッシュな印象を与えてくれます。軽くて歩きやすく、長時間履いていても疲れません。カジュアルコーデにぴったりです。',
            '「フレアデザインが脚をきれいに見せてくれて、スタイルアップ効果があります。柔らかく、伸縮性のある生地なので動きやすく、日常使いにも最適。ウエスト部分も調整できるので、履き心地も良いです。少し長めの丈なので、ヒールと合わせるとさらに素敵に見えます。',
            '「シンプルなデザインで、どんな服にも合わせやすいです。収納力もあり、財布やスマホなど最低限のアイテムをしっかり収納できます。肩掛けしやすく、デイリーに使うのに最適。お手入れも簡単で、長く使えそうな一品です。',
            '「滑らかな肌触りが心地よく、着心地がとても良いです。ドレープが美しく、シンプルなのに上品さを感じさせます。オフィスコーデにもカジュアルにも使え、シーンを選ばず活躍します。デザインも気に入っています。',
            '「ラップデザインがシンプルでありながら、どこか女性らしい印象を与えてくれます。ウエストで調整できるので、着心地が良く、動きやすいです。フレア感が美しく、普段使いにもおしゃれなアクセントとして活躍しています。',
            '「夏にぴったりな軽やかなデザインです。通気性が良く、足が蒸れにくいため、長時間履いていても快適です。ラフなカジュアルスタイルにぴったりで、ビーチやリゾート地でのコーディネートに最適です。シンプルながらもおしゃれな足元が演出できます。',
            '「コンパクトで軽量なアイテムは、必要最低限のアイテムだけを持ち歩きたいときにぴったり。シンプルなデザインで、どんなシーンにも合わせやすいです。肩掛けにも手持ちにも対応できるので、使い勝手も抜群です。',
            '「デザインがシンプルで使いやすいバッグ。大きさもちょうど良く、毎日のお出かけに活躍しています。ジッパーがついているので、安心して物を収納でき、便利です。仕事でもプライベートでも使えるデザインで重宝しています。',
            '「スリットのデザインがセクシーでありながらも、上品な印象を与えてくれます。スカート自体のラインがきれいで、着るだけでスタイルが良く見えます。カジュアルにもドレッシーにも使えるので、幅広いシーンで活躍しています。',
            '「足元を華奢に見せてくれるシューズは、普段使いに最適です。柔らかく履き心地が良く、足が疲れにくいです。シンプルなデザインなので、どんなコーディネートにも合わせやすく、定番アイテムとして愛用しています。」'
        ];

        //ダミーデータの生成
        for ($i = 0; $i < $NUM_FAKER; $i++) {
            Item::create([
                'item_category_id' => $faker->numberBetween(1, 6),
                'item_size_id' => $faker->numberBetween(1, 3),
                'item_gender_id' => $faker->numberBetween(1, 3),
                'item_name' => $itemTitle[mt_rand(0, array_key_last($itemTitle))],
                'price' => $faker->numberBetween(1000, 3000),
                'item_comment' =>$itemComment[mt_rand(0, array_key_last($itemComment))],
                'item_count' => 20,
                'created_at' => $faker->dateTime('now'),
                'updated_at' => $faker->dateTime('now'),
            ]);
        }
    }
}