<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gender;

class GendersController extends Controller
{
    public function index() {
        $genders = Gender::all();
        return view('admin.categories.genders.index', compact('genders'));
    }
}
