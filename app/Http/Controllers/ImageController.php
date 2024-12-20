<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        // ディレクトリ名
        $dir = 'images';

        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();

        // 取得したファイル名を保存
        $request->file('image')->storeAs('public/' . $dir, $file_name);

        return redirect('/');
    }
}
