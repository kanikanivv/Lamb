<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Size;

class SizesController extends Controller
{
    public function index() {
        $sizes = Size::all();
        return view('admin.categories.sizes.index', compact('sizes'));
    }
}
