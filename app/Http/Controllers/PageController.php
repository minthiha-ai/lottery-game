<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function index()
    {
        $route_name = ( Auth::user()->roles == 1 ) ? 'admin.home' : 'agent.home';
        return redirect()->route($route_name);
    }

    public function change_password()
    {
        return view('pages.change_password');
    }

    public function change_password_post(Request $request)
    {
        // return $request->all();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required_with:password_confirmation|same:password_confirmation|min:6',
            'password_confirmation' => 'min:6'
        ]);

        if(Hash::check($request->old_password , auth()->user()->password)) {
            if(!Hash::check($request->new_password , auth()->user()->password)) {
                $user = User::find(auth()->id());
                $user->update([
                    'password' => Hash::make($request->new_password)
                ]);
                session()->flash('success','Password updated successfully!');
                return redirect()->back();
            }
            session()->flash('error','New password can not be the old password!');
            return redirect()->back();
        }
        session()->flash('error','Old password does not matched!');
        return redirect()->back();
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
