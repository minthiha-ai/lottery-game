<?php

namespace App\Http\Controllers\threed\admin;

use App\Models\Setting;
use App\Models\ThreeDItem;
use App\Models\ThreeDUser;
use App\Models\ThreeDNumber;
use Illuminate\Http\Request;
use App\Models\LotteryNumber;
use App\Models\ThreeDLottery;
use Illuminate\Support\Facades\DB;
use App\Models\ThreeDLotteryNumber;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LotteryManagementController extends Controller
{
    public function index()
    {
        $data = ThreeDLottery::orderBy('id', 'desc')->get();

        return view('threed.admin.lottery.management', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            // 'name' => 'required',
        ]);
        $data = new ThreeDLottery();
        $data->date = $request->date;
        // $data->name = $request->name;
        $data->remark = $request->remark;
        $data->win_number = $request->win_number;
        $data->close_number = $request->close_number;
        if($request->status != null){
            $data->status = $request->status;
        }else{
            $data->status = 'off';
        }

        $data->save();

        return redirect()->route('threed.lottery.management.index')->with('success', 'Lottery created successfully!');
    }

    public function edit($id)
    {
        $lottery = ThreeDLottery::find($id);
        return response()->json($lottery);
    }

    public function update(Request $request, $id)
    {
        $lottery = ThreeDLottery::find($id);
        // Update the lottery data based on the request inputs
        $lottery->date = $request->input('date') ?? '';
        // $lottery->name = $request->input('name');
        $lottery->remark = $request->input('remark');
        $lottery->win_number = $request->input('win_number');
        $lottery->close_number = $request->input('close_number');
        if ($request->status != null) {
            $lottery->status = $request->input('status');
        } else {
            $lottery->status = 'off';
        }
        $lottery->save();

        return redirect()->route('threed.lottery.management.index')->with('success', 'Lottery updated successfully!');
    }

    public function deleteLottery($id)
    {
        $data = ThreeDLottery::findOrFail($id);

        // Delete related lottery numbers
        foreach ($data->lottery_numbers as $number) {
            $number->delete();
        }

        ThreeDItem::where('lottery_id', $id)->delete();

        // Delete the lottery entry
        $data->delete();

        return redirect()->route('threed.lottery.management.index')->with('success', 'Lottery deleted successfully!');
        // return response()->json(['message' => 'Data deleted successfully']);
    }

    public function addLottery()
    {
        $data = ThreeDLottery::orderBy('id', 'desc')->get();
        return view('threed.admin.lottery.add', compact('data'));
    }

    public function createLottery($id)
    {
        // return checkLotteryTime();
        // $amOrPm = checkLotteryTime();
        // $now = new \DateTime();


        // if ($amOrPm == 'AM') {
        //     // Create a DateTime object for 11:50 AM.
        //     $targetTime = new \DateTime($now->format('Y-m-d') . ' 11:50:00');
        //     if ($now >= $targetTime) {
        //         // It's 11:50 AM or later.
        //         return back()->with('error', 'နံပတ်ထိုးချိန်ကျော်လွန်သွားပါပြီ');
        //     }
        // } else {
        //     $targetTime = new \DateTime($now->format('Y-m-d') . ' 15:50:00');
        //     if ($now >= $targetTime) {
        //         // It's 11:50 AM or later.
        //         return back()->with('error', 'နံပတ်ထိုးချိန်ကျော်လွန်သွားပါပြီ');
        //     }
        // }
        $data = ThreeDLottery::with('hot_numbers')->findOrFail($id);
        // return $data;
        $numbers = ThreeDLotteryNumber::orderby('id', 'desc')->where([
            ['lottery_id', $id],
            ['user_id', Auth::guard('threed')->id()]
        ])->get();
        // return $numbers;
        $setting = Setting::where('id', 1)->first();
        // return $setting->status;
        return view('threed.admin.lottery.create', compact('data', 'numbers', 'setting'));
    }

    public function getNumbers(Request $request)
    {
        $data = ThreeDLotteryNumber::orderby('id', 'desc')->where([
            ['lottery_id', $request->id],
            ['user_id', Auth::guard('threed')->id()]
        ])->get();

        return response()->json(['data' => $data]);
    }

    public function addNumber(Request $request)
    {
        try {
            $data = $request->validate([
                'lottery_id' => 'required',
                'name' => 'nullable|string',
                'total_numbers' => 'required',
                'total_amount' => 'required',
                'data' => 'required|array',
            ]);

            // return response()->json($data);

            DB::beginTransaction();

            $user = Auth::guard('threed')->user();
            // return response()->json($user);
            if (!$user) {
                // Log or handle the case where the user is not found
                return response()->json(['message' => 'error', 'error_message' => 'User not found'], 404);
            }
            // Create a new LotteryNumber entry
            $lotteryNumber = new ThreeDLotteryNumber([
                'lottery_id' => $data['lottery_id'],
                'user_id' => $user->id,
                'name' => $data['name'],
                'total_numbers' => $data['total_numbers'],
                'total_price' => $data['total_amount'],
            ]);

            $lotteryNumber->save();

            foreach ($data['data'] as $itemData) {
                $numberIds = [];
                $rNumberIds = [];

                foreach ($itemData['num'] as $numberValue) {
                    $number = ThreeDNumber::where('number', $numberValue)->first();
                    if ($number) {
                        $numberIds[] = $number->id;
                    }
                }

                foreach ($itemData['r_num'] as $rNumberValue) {
                    $rNumber = ThreeDNumber::where('number', $rNumberValue)->first();
                    if ($rNumber) {
                        $rNumberIds[] = $rNumber->id;
                    }
                }

                $prices = $itemData['price'];
                $rPrices = $itemData['r_price'];

                // Create 'Item' records for 'num'
                foreach ($numberIds as $index => $numberId) {
                    $item = new ThreeDItem([
                        'lottery_id' => $data['lottery_id'],
                        'lottery_number_id' => $lotteryNumber->id,
                        'number_id' => $numberId,
                        'user_id' => $user->id,
                        'price' => $prices[$index],
                    ]);

                    $item->save();
                }

                // Create 'Item' records for 'r_num'
                foreach ($rNumberIds as $index => $rNumberId) {
                    $item = new ThreeDItem([
                        'lottery_id' => $data['lottery_id'],
                        'lottery_number_id' => $lotteryNumber->id,
                        'number_id' => $rNumberId,
                        'user_id' => $user->id,
                        'price' => $rPrices[$index],
                    ]);

                    $item->save();
                }
            }

            DB::commit();

            return response()->json(['message' => 'Data stored successfully']);
        } catch (\Exception $e) {
            DB::rollback();

            // Log the error and handle it as needed
            Log::error($e->getMessage());

            return response()->json([
                'message' => 'error',
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }


    public function updateNumber(Request $request)
    {
        try {
            $id = $request->input('id');
            $number = $request->input('number');

            // Retrieve the LotteryNumber by its ID
            $lotteryNumber = ThreeDLotteryNumber::find($id);

            if (!$lotteryNumber) {
                return response()->json([
                    'message' => 'error',
                    'error_message' => 'Lottery number not found.'
                ], 404);
            }

            $numbers = explode(',', $lotteryNumber->numbers);
            $rNumbers = $lotteryNumber->r_numbers ? explode(',', $lotteryNumber->r_numbers) : [];

            // Check if the number exists in either numbers or rNumbers array
            $numbers = array_filter($numbers, function ($value) use ($number) {
                return $value != $number;
            });

            $rNumbers = array_filter($rNumbers, function ($value) use ($number) {
                return $value != $number;
            });

            // If both numbers and rNumbers arrays are empty, delete the LotteryNumber
            if (empty($numbers) && empty($rNumbers)) {
                $lotteryNumber->delete();
                return response()->json([
                    'message' => 'success',
                    'data' => null
                ]);
            }

            // Update the numbers and rNumbers in the LotteryNumber model
            $lotteryNumber->numbers = implode(',', $numbers);
            $lotteryNumber->r_numbers = !empty($rNumbers) ? implode(',', $rNumbers) : null;
            $lotteryNumber->save();

            return response()->json([
                'message' => 'success',
                'data' => $lotteryNumber
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error_message' => $e->getMessage()
            ], 500);
        }
    }

    public function lotteryReport($id)
    {
        $lotte = ThreeDLottery::findOrFail($id);
        $data = ThreeDLotteryNumber::with(['user', 'items.number'])->where([
            ['lottery_id', $id],
            ['user_id', Auth::guard('threed')->user()->id]
        ])->orderby('id', 'desc')->get();
        // Calculate the sum of 'total_price' using array_reduce
        $totalPriceSum = array_reduce($data->toArray(), function ($carry, $item) {
            return $carry + (int)$item['total_price'];
        }, 0);

        // Calculate the sum of 'total_numbers' using array_reduce
        $totalNumbersSum = array_reduce($data->toArray(), function ($carry, $item) {
            return $carry + (int)$item['total_numbers'];
        }, 0);
        // return $totalNumbersSum;
        return view('threed.admin.lottery.report.lottery_report', compact('lotte', 'data', 'totalPriceSum', 'totalNumbersSum'));
    }

    public function bouncherReport($id)
    {
        $lotte = ThreeDLottery::findOrFail($id);
        $data = ThreeDUser::with(['setting', 'lottery_numbers' => function ($query) use ($id) {
            $query->where('lottery_id', $id);
        }, 'lottery_numbers.items.number'])
        ->whereHas('lottery_numbers', function ($query) use ($id) {
            $query->where('lottery_id', $id);
        })->where('id', Auth::guard('threed')->user()->id)->first();

        // return $data;
        return view('threed.admin.lottery.report.boucher_report', compact('lotte', 'data'));
    }

    public function getHotNumbers($id)
    {
        $data = ThreeDLottery::with('hot_numbers')->findOrFail($id);

        return response()->json($data->hot_numbers);
    }
}
