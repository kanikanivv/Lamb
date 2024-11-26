<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /**
     * ログインフォーム
     *
     * @return void
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * ログイン機能
     *
     * @param Request $request
     * @return void
     */
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended(route('admin.items.index'));
        }

        if (Auth::guard('admin')->check()) {
            $adminName = Auth::guard('admin')->user()->name;
        } else {
            return redirect()->route('admin.login');
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }


}
