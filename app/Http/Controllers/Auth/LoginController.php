<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        // return $request;
        $credentials = $request->only('username', 'password');

        if ( Auth::attempt($credentials, $request->filled('remember')) ) {
            return redirect()->intended(route('home'));
        }

        throw ValidationException::withMessages([ 'error' => '* Invalid Credentials .' ]);
    }


}
