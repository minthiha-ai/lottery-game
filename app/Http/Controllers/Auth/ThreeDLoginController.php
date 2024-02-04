<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ThreeDLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login_3d');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username','password');
        if (Auth::guard('threed')->attempt($credentials, $request->get('remember'))) {
            // return Auth::guard('threed')->user();
            return redirect()->route('threed.home');
        }

        throw ValidationException::withMessages(['error' => '* Invalid Credentials.']);
    }

}
