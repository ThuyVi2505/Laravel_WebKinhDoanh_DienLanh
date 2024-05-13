<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Order,OrderDetail, User};
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        //min-max date
        $minDate = Carbon::createFromDate(2023, 1, 1)->toDateString();
        $maxDate = Carbon::today()->toDateString();
        // Retrieve start and end date inputs from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Set default values if inputs are null or empty
        if (empty($startDate)) {
            $startDate = $minDate;
        }
        if (empty($endDate)) {
            $endDate = $maxDate;
        }

        $orders = Order::query()
                ->when($request->end_date !=null && $request->start_date, function($query) use ($request){
                    // return $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
                    return $query->whereDate('created_at','>=',$request->start_date)->whereDate('created_at','<=',$request->end_date);
                })
                ->when($request->searchBox != null, function ($query) use ($request) {
                    return $query->where('code', 'like', '%' . $request->searchBox . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            return view('admin.order.index', compact('minDate','maxDate','startDate', 'endDate','orders'));
    }
    public function show($code){
        $order = Order::where('code',$code)->first();
        $order_details = OrderDetail::where('order_id',$order->id)->orderBy('created_at','desc')->get();
        $user = User::find($order->user_id);
        return view('admin.order.detail')->with(compact('order','order_details','user'));
    }

    public function delete(Request $request)
    {
        $data = Order::find($request->id);
        $data->delete();
        return response()->json(['status' => 'success']);
    }
}
