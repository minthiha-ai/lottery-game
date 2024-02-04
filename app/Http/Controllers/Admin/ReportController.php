<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Number;
use App\Models\Lottery;
use App\Models\HotNumber;
use Illuminate\Http\Request;
use App\Models\LotteryNumber;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function report($id)
    {
        $lotte = Lottery::findOrFail($id);

        $data = User::with(['setting', 'lottery_numbers' => function ($query) use ($id) {
            $query->where('lottery_id', $id);
        }, 'lottery_numbers.items.number'])
            ->whereHas('lottery_numbers', function ($query) use ($id) {
                $query->where('lottery_id', $id);
            })
            ->get();

        // Filter out users who have no matching lottery_numbers
        $data = $data->filter(function ($user) {
            return count($user->lottery_numbers) > 0;
        });

        // $totalPrice = Item::where('lottery_id', 8)->sum('price');

        // return Item::with(['user.setting'])->where('lottery_id', $id)->get();
        // return $data;

        return view('admin.lottery.report.report', compact('data', 'lotte'));
    }

    public function numberReport(Request $request,$id)
    {
        $lotte = Lottery::findOrFail($id);

        if (isset($request->user)) {
            if ($request->user != "default") {
                $data = Number::with(['items' => function ($query) use ($request, $id){
                    $query->where('items.user_id', $request->user)->where('items.lottery_id', $id);
                }])
                ->whereHas('items', function ($query) use ($request, $id){
                    $query->where('items.user_id', $request->user)->where('items.lottery_id', $id);
                })
                ->get()
                ->map(function ($number) {
                    $totalPrice = $number->items->sum('price');
                    $number->total_price = $totalPrice;
                    return $number;
                });
            } else {
                return redirect()->route('lottery.report.number',$lotte->id);

            }
        }else{
            $data = Number::with(['items' => function ($query) use ($id){
                $query->where('lottery_id',$id);
            }])
            ->whereHas('items', function ($query) use ($id) {
                $query->where('lottery_id', $id);
            })
            ->get()
            ->map(function ($number) {
                $totalPrice = $number->items->sum('price');
                $number->total_price = $totalPrice;
                return $number;
            });
        }

        $totalPriceSum = array_reduce($data->toArray(), function ($carry, $item) {
            return $carry + (int)$item['total_price'];
        }, 0);
        $users = User::all();
        return view('admin.lottery.report.number_report',compact('lotte','data','totalPriceSum', 'users'));
    }


    public function numberLager($id)
    {
        $lotte = Lottery::findOrFail($id);
        $data = Number::with(['items' => function ($query) use ($id){
                $query->where('lottery_id',$id);
            }])
            ->whereHas('items', function ($query) use ($id) {
                $query->where('lottery_id', $id);
            })
            ->get()
            ->map(function ($number) {
                $totalPrice = $number->items->sum('price');
                $number->total_price = $totalPrice;
                return $number;
            })->sortByDesc('total_price');
        $totalPriceSum = array_reduce($data->toArray(), function ($carry, $item) {
            return $carry + (int)$item['total_price'];
        }, 0);

        return view('admin.lottery.report.number_lager',compact('lotte','data', 'totalPriceSum'));
    }

    public function headBreak($id, $price)
    {
        $lotte = Lottery::findOrFail($id);

        $data = Number::with(['items' => function ($query) use ($id) {
            $query->where('lottery_id', $id);
        }])
        ->whereHas('items', function ($query) use ($id) {
            $query->where('lottery_id', $id);
        })
        ->get()
        ->map(function ($number) use ($price) {
            $number->total_price = $number->items->sum('price') - $price;
            return $number;
        })
        ->filter(function ($number) {
            return $number->total_price > 0;
        })->sortByDesc('total_price');

        $totalPriceSum = $data->sum('total_price');

        return view('admin.lottery.report.head_break', compact('data', 'lotte', 'price', 'totalPriceSum'));
    }

    public function numberLagerDetail($id, $number) {
        $lotte = Lottery::find($id);

        // Retrieve the Number model with its associated items, lottery numbers, and users
        $number = Number::where('number', $number)
        // ->with(['items.lottery_number.user'])
        ->with(['items' => function($query) use ($id){
            $query->where('lottery_id', $id);
        }])
        ->whereHas('items', function ($query) use ($id) {
            $query->where('lottery_id', $id);
        })
        ->first();
        // return $number;
        if ($number) {
            // Group the items by user and calculate the total price for each user
            $data = $number->items->groupBy('lottery_number.user.id')->map(function ($items) {
                $totalPrice = $items->sum('price');
                $user = $items->first()->lottery_number->user; // Get the user from the first item
                return [
                    'items' => $items,
                    'total_price' => $totalPrice,
                    'user_id' => $user->id,
                    'username' => $user->name, // Add the username field
                ];
            });

            // Attach the total prices to the Number model
            $number->user_total_prices = $data->pluck('total_price', 'user_id');
            // return $data;
            return view('admin.lottery.report.head_break_detail', compact('number', 'data', 'lotte'));
        } else {
            // Handle the case when the number is not found
            return response()->json(['error' => 'Number not found'], 404);
        }
    }

    public function numberBoucher(Request $request,$id)
    {
        $lotte = Lottery::findOrFail($id);

        $query = LotteryNumber::with(['user', 'items.number']);

        if (isset($request->keyword)) {
            $query = $query->where('id','like',"%{$request->keyword}%");
        }else{
            $query = $query;
        }

        $data = $query->where([
            ['lottery_id', $id],
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
        return view('admin.lottery.report.number_boucher',compact('lotte','data', 'totalPriceSum', 'totalNumbersSum'));
    }

    public function search(Request $request) {
        $searchQuery = $request->input('search');

        $data = LotteryNumber::with(['user','items.number'])->where([
            ['lottery_id', $request->id],
        ])->orderby('id', 'desc')->where('id', 'like', '%' . $searchQuery . '%')->get();
        // Calculate the sum of 'total_price' using array_reduce
        $totalPriceSum = array_reduce($data->toArray(), function ($carry, $item) {
            return $carry + (int)$item['total_price'];
        }, 0);

        // Calculate the sum of 'total_numbers' using array_reduce
        $totalNumbersSum = array_reduce($data->toArray(), function ($carry, $item) {
            return $carry + (int)$item['total_numbers'];
        }, 0);
        return response()->json(['results' => $data]);
    }

    public function numberBoucherDetail($id, $bId) {
        $lotte = Lottery::findOrFail($id);
        $data = LotteryNumber::with(['user','items.number'])->findOrFail($bId);
        return view('admin.lottery.report.number_boucher_detail', compact('lotte','data'));
    }

    public function deleteNumberBoucher($id)
    {
        $data = LotteryNumber::findOrFail($id);
        $data->delete();
        return back()->with('success','boucher deleted successfully');
    }

    public function userComm($id)
    {
        $lotte = Lottery::findOrFail($id);
        return view('admin.lottery.report.user_coms',compact('lotte'));
    }

    public function getNumbersByUser($id ,$userId)
    {
        if ($userId == "default") {
            $data = Number::with('items')
            ->whereHas('items', function ($query) use ($id) {
                $query->where('lottery_id', $id);
            })
            ->get()
            ->map(function ($number) {
                $totalPrice = $number->items->sum('price');
                $number->total_price = $totalPrice;
                return $number;
            });

        } else {
            $data = Number::with('items.lottery_number')
            ->whereHas('items', function ($query) use ($id) {
                $query->where('lottery_id', $id);
            })
            ->whereHas('items.lottery_number', function($query) use ($userId){
                $query->where('user_id', $userId);
            })
            ->get()
            ->map(function ($number) {
                $totalPrice = $number->items->sum('price');
                $number->total_price = $totalPrice;
                return $number;
            });
        }

        $totalPriceSum = array_reduce($data->toArray(), function ($carry, $item) {
            return $carry + (int)$item['total_price'];
        }, 0);

        return response()->json(["data" =>$data, "totalPriceSum" => $totalPriceSum]);
    }

    public function hotNumber($id)
    {
        $lotte = Lottery::findOrFail($id);
        $data = HotNumber::orderBy('id','desc')->where('lottery_id',$id)->get();
        // return $data;
        return view('admin.lottery.report.hot_number', compact('lotte', 'data'));
    }

    public function hotNumberStore($id, Request $request)
    {
        $this->validate($request, [
            'hot_number' => 'required',
            'covered_amount' => 'required'
        ]);
        $data = new HotNumber();
        $data->lottery_id = $id;
        $data->hot_number = $request->hot_number;
        $data->covered_amount = $request->covered_amount;
        $data->save();

        return back()->with('success', 'Hot Number created successfully!');
    }

    public function deleteHotNumber($id)
    {
        $data = HotNumber::findOrFail($id);
        $data->delete();

        return back()->with('success', 'Hot Number deleted successfully!');
    }
}
