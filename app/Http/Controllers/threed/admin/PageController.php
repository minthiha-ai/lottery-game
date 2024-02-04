<?php

namespace App\Http\Controllers\threed\admin;

use App\Models\Setting;
use App\Models\LotteryTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        // return 'admin home';
        return view('threed.admin.index');
    }

    public function setting()
    {
        $data = Setting::all();
        $am = LotteryTime::where('type', 0)->first();
        $pm = LotteryTime::where('type', 1)->first();
        // return $am;
        return view('threed.admin.setting', compact('data', 'am', 'pm'));
    }

    public function change_setting($id)
    {
        $data = Setting::findOrFail($id);

        $data->update([
            'status' => !$data->status
        ]);

        return response()->json('success');
    }

    public function deleteAllData(LoginRequest $request)
    {
        // return response()->json(['data'=>$request->all()]);
        $credentials = $request->only('username', 'password');

        if ( Auth::guard('threed')->attempt($credentials) ) {
            Artisan::call('reset:threed-lottery-data');
            return response()->json(true);
        }else{
            return response()->json(false);
        }

    }
}
