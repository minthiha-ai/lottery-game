<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\UserSetting;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    public function store(UserAddRequest $request)
    {
        // return $request->all();

        $user = User::create([
                    'username' => $request->username,
                    'name' => $request->staffname,
                    'roles' => $request->roles,
                    'password' => Hash::make($request->password)
                ]);

                UserSetting::create([
                    'user_id' => $user->id,
                    'sales' => $request->sales ?? 0,
                    'za' => $request->za ?? 0,
                    'limit' => $request->limit ?? 0
                ]);

        return back()->with('success', '* user is successfully added.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserEditRequest $request, User $user)
    {
        $user->update([
            'username' => $request->username,
            'name' => $request->staffname,
            'roles' => $request->roles,
        ]);

        $user->setting->update([
            'sales' => $request->sales ?? 0,
            'za' => $request->za ?? 0,
            'limit' => $request->limit ?? 0
        ]);

        return redirect()->route('users.index')->with('success', '* user is successfully updated.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', '* user is successfully deleted.');
    }

    public function reset_password(User $user)
    {
        $user->update([ 'password' => Hash::make('12345') ]);
        return redirect()->route('users.index')->with('success', '* password changed to 12345');
    }
}
