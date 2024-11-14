<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemsController extends Controller
{
    public function index()
    {
        $item = Item::all();
        return view('items.index', compact('items')); //変数$itemsをviewに渡す
    }

}
