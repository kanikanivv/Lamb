<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenderController extends Controller
{
    /**
     * Genderのデータを取得し代入した変数をitems.indexに変数を渡す
     *
     * @return void
     */
    public function index() {
        $gender = Gender::all();
        return view('items.index', compact('gender'));
    }
}
