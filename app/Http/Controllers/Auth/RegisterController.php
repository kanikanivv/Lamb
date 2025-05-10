<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/items';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'     => ['required', 'string', 'email', 'max:250', 'unique:users'],
            'password'  => ['required', 'string', 'min:8'],
            'name'      => ['required', 'string', 'max:60'],
            'user_name' => ['required', 'string', 'max:60'],
            'tel'       => ['required', 'string', 'regex:/^(070|080|090)\d{8}$/'],
            'address'   => ['required', 'string', 'max:150'],
            'age'       => ['required', 'integer']
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'name'      => $data['name'],
            'user_name' => $data['user_name'],
            'tel'       => $data['tel'],
            'address'   => $data['address'],
            'age'       => $data['age']
        ]);

        return view('items.index');
    }

/**
     * 新規登録フォーム
     *
     * @return void
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
 }
