<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $user = DB::table('users')->find($id);
        return view('user.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'email'      => 'required|email|max:250|',
            'password'   => 'nullable|string|min:8|',
            'name'       => 'required|string|max:60',
            'user_name'  => 'required|string|max:60',
            'tel'        => 'required|string|max:20',
            'address'    => 'required|string|max:150',
            'age'        => 'nullable|integer',
        ]);

        $user->email     = $request->input('email');
        $user->name      = $request->input('name');
        $user->user_name = $request->input('user_name');
        $user->tel       = $request->input('tel');
        $user->address   = $request->input('address');
        $user->age       = $request->input('age');

        if ($request->filled('password'))
        {
            $user->password = Hash::make($request->input('password'));  // 新しいパスワードをハッシュ化して保存
        }

        $user->save();

        return redirect()->route('user.index')->with('success', $user->name . 'の情報が更新されました');
    }
}
