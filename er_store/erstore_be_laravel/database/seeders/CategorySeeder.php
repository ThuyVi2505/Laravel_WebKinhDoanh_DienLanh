<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
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
        $categories = json_decode(File::get(database_path('json/categories.json')), true);

        foreach($categories as $key => $item){
            Category::create([
                'id' => $key+1,
                'cat_name' => $item['cat_name'],
                'cat_slug' => Str::slug($item['cat_name']),
                'isActive' => 1,
                'parent_id' => $item['parent_id'],
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ]);
            // Thêm 1 giây cho thời gian hiện tại
            $currentTime->addSeconds(1);
        }
    }
}
