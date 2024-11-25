<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Gender;
use App\Models\Category;
use App\Models\Size;

class CategoriesController extends Controller
{
    public function index() {
        return view('admin.categories.index');
    }
}
