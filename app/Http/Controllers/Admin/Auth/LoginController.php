<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Validation\ValidationException;
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
        return view('admin.auth.login',  ['authgroup' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required|min:5'
        ],
        [
            'email.required' => 'メールアドレスは必須です。',
            'email.email'    => '有効なメールアドレスを入力してください。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは5文字以上で入力してください。',
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
