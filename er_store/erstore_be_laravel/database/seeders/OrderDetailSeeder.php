<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\{Product, Order, OrderDetail};

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::all();
        foreach($orders as $order){
            // tổng tiền đơn hàng Order
            $total_amount = 0;

            // số order detail của 1 order
            $num = 5;
            for ($i = 0; $i < $num; $i++) {
                $quantity = 1;
                // random sản phẩm
                $product_rand=Product::inRandomOrder()->first();
                $product_check_in_orderdetail = OrderDetail::where('order_id',$order->id)->where('product_id',$product_rand->id)->first();
                $sale_price = $product_rand->prod_price-round($product_rand->sale->percent/100*$product_rand->prod_price);
                $total_price=$sale_price*$quantity;
                if(!$product_check_in_orderdetail){
                    OrderDetail::create([
                        'order_id'=>$order->id,
                        'product_id'=>$product_rand->id,
                        'percent_sale'=>$product_rand->sale->percent,
                        'quantity'=>$quantity,
                        'price'=>$sale_price,
                        'total_price'=>$total_price,
                        'created_at'=>$order->created_at
                    ]);
                }
                else{
                    $new_quantity = $product_check_in_orderdetail->quantity+$quantity;
                    $product_check_in_orderdetail->update([
                        'quantity'=>$new_quantity,
                        'total_price'=>$sale_price*$new_quantity,
                    ]);
                    
                }
                // tăng tổng đơn tiền sau khi có 1 order detail được tạo
                $total_amount += $total_price;
            }
            //Cập nhật tổng tiền đơn hàng
            Order::where('code',$order->code)->update([
                'total_amount'=>$total_amount
            ]);

        }
    }
}
