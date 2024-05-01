<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Address;
use App\Models\User;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Đọc dữ liệu từ các tập tin JSON
        $cities = json_decode(File::get(database_path('address_json/cities-KG.json')), true);
        $districts = json_decode(File::get(database_path('address_json/districts-KG.json')), true);
        $wards = json_decode(File::get(database_path('address_json/wards-KG.json')), true);

        // Tạo địa chỉ ngẫu nhiên cho mỗi user
        $users = User::all();
        $faker = \Faker\Factory::create();
        foreach ($users as $user) {
            $num = rand(1,2);
            for($i=0;$i<$num;$i++){
                Address::create([
                    'user_id' => $user->id,
                    'number' => rand(1, 100),
                    'street' => $faker->streetName(),
                    'city' => $cities[array_rand($cities)]['name_with_type'],
                    'district' => $districts[array_rand($districts)]['name_with_type'],
                    'ward' => $wards[array_rand($wards)]['name_with_type'],
                ]);
            }
        }
    }
}
