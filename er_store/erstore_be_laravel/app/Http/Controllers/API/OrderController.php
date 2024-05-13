<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Http\Response;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function get(Request $request){
        $query = Order::query();

        if ($request->has('id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->has('code')) {
            $query->where('code', $request->code);
        }
        $all = $query->get();

        $allResc = OrderResource::collection($all);
        // re-type brand respond api
        $arr = [
            // 'title' => "Danh sách thương thiệu",
            'success' => true,
            'message' => "Lấy dữ liệu thành công",
            'record_count' => $all->count(),
            'data' => $allResc
        ];

        return response()->json($arr, status: Response::HTTP_OK);
    }
    public function store(Request $request){
        $data=$request->validate([
            'address_id' => 'required',
        ]);
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'message' => ['Tài khoản chưa đăng nhập'],
            ], status: Response::HTTP_UNAUTHORIZED);
        } // Retrieve authenticated user using access toke
        $item = new Order($data);
        $item->user_id = $user->id;
        
        // Lấy một thời gian ngẫu nhiên trong khoảng thời gian đã cho
        $faker = \Faker\Factory::create();
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh');

        $item->code = 'HD' . $currentTime->format('Hisdmy') . $faker->randomNumber(5);

        // địa chỉ ship random tương ứng với của user
        $address=Address::where('id',$request->address_id)->first();
        $item->address_ship = $address->number.' '.$address->street.', '.$address->ward.', '.$address->district.', '.$address->city.'.';
        $item->created_at = $currentTime;

        $item->save($data);
        $arr = [
            'success' => true,
            'message' => "Thêm thành công",
        ];
        return response()->json($arr, status: Response::HTTP_CREATED);
    }
}
