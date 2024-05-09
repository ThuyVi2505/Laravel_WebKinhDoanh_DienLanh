<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\{Product, Image, Attribute, SaleProd};
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('products')->truncate();
        // Thời gian bắt đầu và kết thúc của khoảng thời gian (ví dụ: từ 1/1/2023 đến 1/1/2024)
        $startTime = Carbon::create(2023, 1, 1, 0, 0, 0, 'Asia/Ho_Chi_Minh');
        $endTime = Carbon::now('Asia/Ho_Chi_Minh');

        // Mảng chứa tất cả JSON
        $jsons = [
            'tulanh.json',
            // 'maylanh.json',
            // 'maygiat.json'
        ];
        // Mảng kết quả merge
        $products = [];

        // Hợp nhất từng mảng JSON vào mảng kết quả
        foreach ($jsons as $json) {
            $array = json_decode(File::get(database_path('json/product/'.$json)), true);
            $products = array_merge($products, $array);
        }

        foreach($products as $keyProd => $item){
            // Lấy một thời gian ngẫu nhiên trong khoảng thời gian đã cho
            $currentTime = Carbon::createFromTimestamp(mt_rand($startTime->timestamp, $endTime->timestamp));
            Product::create([
                'id' => $keyProd+1,
                'prod_name' => $item['prod_name'],
                'prod_model'=> $item['prod_model'],
                'prod_slug' => Str::slug($item['prod_name'])."-".Str::slug($item['prod_model']),

                'prod_price' => $item['prod_price'],
                'prod_stock' => rand(10, 100),
                'prod_description'=>$item['prod_description'],
                'origin_country' => $item['origin_country'],
                'guarantee_period' => collect([12, 24])->random(),

                'brand_id' => $item['brand_id'],
                'cat_id' => $item['cat_id'],
                'isActive' => 1,

                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ]);
            // Thêm 1 giây cho thời gian hiện tại
            $currentTime->addSeconds(1);

            // Update Sale percent cho sản phẩm
            SaleProd::create([
                'product_id'=>$keyProd+1,
                'percent'=>$item['sale_percent']
            ]);

            // Thêm url ảnh product
            // Lấy đường dẫn folder ảnh
            $folderPath = storage_path('app/public/uploads/Product/'.$keyProd+1);
            // Lấy danh sách các file ảnh có đuôi "*.jpg", "*.jpeg", "*.png", etc.
            $imageFiles = glob($folderPath . '/*.jpg') + glob($folderPath . '/*.jpeg') + glob($folderPath . '/*.png') + glob($folderPath . '/*.gif');
            // Đếm số lượng file ảnh
            $numImageFiles = count($imageFiles);
            for($i=1;$i<=$numImageFiles;$i++){
                Image::create([
                    'prod_id'=>$keyProd+1,
                    'image'=>$i.'.jpg'
                ]);
            }

            // thêm thông số kỹ thuật cho sản phẩm
            if($item['attributes'] != null){
                // Lặp qua các thuộc tính của sản phẩm và lưu vào bảng pivot
                foreach ($item['attributes'] as $attributeName => $attributeValue) {
                    $attribute = Attribute::where('key',$attributeName)->first();
                    
                    // Liên kết sản phẩm với thuộc tính thông qua bảng pivot
                    DB::table('prod_attr_value')->insert([
                        'product_id' => $keyProd+1,
                        'attribute_id' => $attribute->id,
                        'value' => $attributeValue,
                    ]);
                }
            }

        }

    }
}
