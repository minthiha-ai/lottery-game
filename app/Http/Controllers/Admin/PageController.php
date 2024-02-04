<?php

namespace App\Http\Controllers\Admin;


use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LotteryTime;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function setting()
    {
        $data = Setting::all();
        $am = LotteryTime::where('type', 0)->first();
        $pm = LotteryTime::where('type', 1)->first();
        // return $am;
        return view('admin.setting', compact('data', 'am', 'pm'));
    }

    public function changeLotteryTime(Request $request)
    {
        // return response()->json($request->data['time']);
        switch ($request->data['time']) {
            case 'am':
                $data = LotteryTime::where('type', 0)->first();
                break;
            case 'pm':
                $data = LotteryTime::where('type', 1)->first();
                break;
        }
        // return response()->json($data);
        $data->time = $request->data['data'];
        $data->save();
        return response()->json('success');
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

        if ( Auth::attempt($credentials) ) {
            Artisan::call('reset:lottery-data');
            return response()->json(true);
        }else{
            return response()->json(false);
        }

    }
}
