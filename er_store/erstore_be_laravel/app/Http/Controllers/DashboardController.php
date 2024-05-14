<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\{
    User,
    Product,
    Brand,
    Order
};

class DashboardController extends Controller
{
    public function index(){
        // user count number
        $count_user = User::count();
        // product count number
        $count_product = Product::count();
        // product count number
        $count_brand = Brand::count();
        //count_order
        $startDate = Carbon::now()->startOfWeek()->toDateString();
        $nowDate = Carbon::today()->toDateString();
        $order_in_today = $this->getOrderStatistics($nowDate, $nowDate);
        $order_in_week = $this->getOrderStatistics($startDate, $nowDate);

        return view('admin.dashboard')->with(compact(
            'count_user',
            'count_product',
            'count_brand',

            'startDate',
            'nowDate',
            'order_in_today',
            'order_in_week',
        ));
    }
    public function getOrderChartData($year){
        // $year = $request->input('year', date('Y')); 
        $results = DB::table(DB::raw('(SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) AS months'))
            ->leftJoin('orders', function ($join) use($year) {
                $join->on(DB::raw('MONTH(orders.created_at)'), '=', 'months.month')
                    ->whereYear('orders.created_at', '=', $year);
            })
            ->select(
                DB::raw('months.month AS month'),
                DB::raw('IFNULL(SUM(orders.total_amount), 0) AS total_revenue'),
                DB::raw('COUNT(orders.id) AS total_orders')
            )
            ->groupBy('months.month')
            ->orderBy('months.month')
            ->get();
            // Tính tổng doanh thu của năm
        $totalYear = $results->sum('total_revenue');

        return response()->json([
            'results' => $results,
            'totalYear' => $totalYear,
        ]);

    }

    public function getOrderStatistics($startDate, $endDate)
    {
        $orders = Order::whereDate('created_at','>=',$startDate)->whereDate('created_at','<=',$endDate)
                        ->select(DB::raw('COUNT(*) as order_count'), DB::raw('SUM(total_amount) as total_amount_sum'))
                        ->first();

        return $orders;
    }
}
