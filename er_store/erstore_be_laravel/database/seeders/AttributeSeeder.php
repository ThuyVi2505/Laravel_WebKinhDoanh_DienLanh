<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Attribute;
use Illuminate\Support\Facades\File;

class AttributeSeeder extends Seeder
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
        $attributes = json_decode(File::get(database_path('json/attributes.json')), true);

        foreach($attributes as $key => $item){
            Attribute::create([
                'id' => $key+1,
                'key' => $item,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ]);
            // Thêm 1 giây cho thời gian hiện tại
            $currentTime->addSeconds(1);
        }
    }
}
