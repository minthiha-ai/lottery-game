<?php

namespace App\Http\Controllers\threed;

use App\Models\ThreeDUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function index()
    {
        $route_name = (Auth::guard('threed')->user()->roles == 1) ? 'threed.admin.home' : 'threed.agent.home';
        return redirect()->route($route_name);
    }

    public function change_password()
    {
        return view('threed.pages.change_password');
    }

    public function change_password_post(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required_with:password_confirmation|same:password_confirmation|min:6',
            'password_confirmation' => 'min:6'
        ]);

        if(Hash::check($request->old_password , Auth::guard('threed')->user()->password)) {
            if(!Hash::check($request->new_password , Auth::guard('threed')->user()->password)) {
                $user = ThreeDUser::find(Auth::guard('threed')->user()->id);
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
        Auth::guard('threed')->logout();
        return redirect(route('login3d'));
    }
}
