<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
=======
use App\Models\Admin;
use Illuminate\Validation\ValidationException;
>>>>>>> remotes/origin/feature/202411/waseda
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected function guard()
    {
        return Auth::guard('admin');
    }

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
<<<<<<< HEAD
        $credentials = $request->validate([
            'email'    => ['required|email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended(route('admin.items.index'));
        }
=======
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:5'
        ]);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);
                return $this->sendLockoutResponse($request);
            }

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')))
            {
                // dd($request->all());
                $request->session()->regenerate();
                return redirect()->intended(route('admin.items.index'));
            } else {
                // ログイン失敗
                return back()->withErrors(['login' => 'ログイン情報が正しくありません。']);
            }

            $this->incrementLoginAttempts($request);
            return back()->withInput($request->only('email', 'remember'));
    }
>>>>>>> remotes/origin/feature/202411/waseda

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
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
