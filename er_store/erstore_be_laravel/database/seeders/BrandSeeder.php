<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh');
        // Đọc dữ liệu từ các tập tin JSON
        $brands = json_decode(File::get(database_path('json/brands.json')), true);

        foreach($brands as $key => $brand){
            Brand::create([
                'id' => $key+1,
                'brand_name' => $brand,
                'brand_slug' => Str::slug($brand),
                'isActive' => 1,
                'thumnail' => $brand.'.png',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ]);
            // Thêm 1 giây cho thời gian hiện tại
            $currentTime->addSeconds(1);
        }

    }
}
