<?php

namespace App\Http\Controllers\threed\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\ThreeDUser;
use App\Models\ThreeDUserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = ThreeDUser::all();
        return view('threed.admin.users.index', compact('users'));
    }

    public function store(UserAddRequest $request)
    {
        // return $request->all();

        $user = ThreeDUser::create([
            'username' => $request->username,
            'name' => $request->staffname,
            'roles' => $request->roles,
            'password' => Hash::make($request->password)
        ]);

        ThreeDUserSetting::create([
            'user_id' => $user->id,
            'sales' => $request->sales ?? 0,
            'za' => $request->za ?? 0,
            't_za' => $request->t_za ?? 0,
            'p_za' => $request->p_za ?? 0,
            'limit' => $request->limit ?? 0
        ]);

        return back()->with('success', '* user is successfully added.');
    }

    public function edit(ThreeDUser $user)
    {
        return view('threed.admin.users.edit', compact('user'));
    }

    public function update(UserEditRequest $request, ThreeDUser $user)
    {
        $user->update([
            'username' => $request->username,
            'name' => $request->staffname,
            'roles' => $request->roles,
        ]);

        $user->setting->update([
            'sales' => $request->sales ?? 0,
            'za' => $request->za ?? 0,
            't_za' => $request->t_za ?? 0,
            'p_za' => $request->p_za ?? 0,
            'limit' => $request->limit ?? 0
        ]);

        return redirect()->route('threed.users.index')->with('success', '* user is successfully updated.');
    }

    public function destroy(ThreeDUser $user)
    {
        $user->delete();
        return back()->with('success', '* user is successfully deleted.');
    }

    public function reset_password(ThreeDUser $user)
    {
        $user->update(['password' => Hash::make('12345')]);
        return redirect()->route('threed.users.index')->with('success', '* password changed to 12345');
    }
}
