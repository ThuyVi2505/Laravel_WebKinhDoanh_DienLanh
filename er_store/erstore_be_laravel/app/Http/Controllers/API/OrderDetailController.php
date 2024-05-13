<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Response;
use App\Http\Resources\OrderDetailResource;

class OrderDetailController extends Controller
{
    public function getByCode($code){
        
        $order = Order::where('code',$code)->first();
        if (!$order) {
            $err = [
                'success' => false,
                'message' => "Không tìm thấy đơn hàng $code...",
            ];
            return response()->json($err, status: Response::HTTP_NOT_FOUND);
        }
        $query = OrderDetail::where('order_id', $order->id);
        $all = $query->get();
        

        $Resc = OrderDetailResource::collection($all);
        // re-type brand respond api
        $arr = [
            // 'title' => "Danh sách thương thiệu",
            'success' => true,
            'message' => "Lấy dữ liệu thành công",
            'record_count' => $all->count(),
            'data' => $Resc
        ];

        return response()->json($arr, status: Response::HTTP_OK);
    }
    public function storeadd(Request $request){
        $data=$request->validate([
            'order_code' => 'required',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Check if order ID already exists in order details
        $existingOrderIds = OrderDetail::where('order_id', Order::where('code',$request->order_code)->first()->id)->first();
        if ($existingOrderIds) {
            $err = [
                'success' => false,
                'message' => "Đơn hàng này đã có sản phẩm, không thể thêm...",
            ];
            return response()->json($err, status: Response::HTTP_NOT_FOUND);        
        }
        // Process products array
        $products = collect($request->products)->groupBy('product_id')->map(function ($item) {
            return [
                'product_id' => $item->first()['product_id'],
                'quantity' => $item->sum('quantity'),
            ];
        })->toArray();
        $total_amount = 0;
        foreach ($products as $key => $detail) {
            $product = Product::find($detail['product_id']);

            $order_detail = new OrderDetail();
            $order_detail->product_id = $product->id;
            $order_detail->order_id = Order::where('code',$request->order_code)->first()->id;
            $order_detail->percent_sale = $product->sale->percent;
            $order_detail->price = $product->prod_price-round($product->sale->percent/100*$product->prod_price);
            $order_detail->quantity = $detail['quantity'];
            $order_detail->total_price = $product->prod_price-round($product->sale->percent/100*$product->prod_price)*$detail['quantity'];
            $order_detail->save();

            $total_amount += $product->prod_price-round($product->sale->percent/100*$product->prod_price)*$detail['quantity'];
        }
        $order = Order::where('code',$request->order_code)->first();
        $order->total_amount = $total_amount;
        $order->update();
        $arr = [
            'success' => true,
            'message' => "Thêm thành công",
        ];
        return response()->json($arr, status: Response::HTTP_CREATED);
    }
}
