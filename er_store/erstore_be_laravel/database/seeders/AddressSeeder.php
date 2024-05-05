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
            $num = rand(1, 2);
            for ($i = 0; $i < $num; $i++) {
                //chọn random thành phố city from json file
                $city = $cities[array_rand($cities)];

                //chọn random quận district from json file -> district phải có parent_code = code của city
                $city_Districts = array_filter($districts, function ($district) use ($city) {
                    return $district['parent_code'] == $city['code'];
                });
                $district = $city_Districts[array_rand($city_Districts)];

                //chọn random phường ward from json file -> ward phải có parent_code = code của district
                $districtWards = array_filter($wards, function ($ward) use ($district) {
                    return $ward['parent_code'] == $district['code'];
                });
                $ward = $districtWards[array_rand($districtWards)];

                Address::create([
                    'user_id' => $user->id,
                    'number' => rand(1, 100),
                    'street' => $faker->streetName(),
                    'city' => $city['name_with_type'],
                    'district' => $district['name_with_type'],
                    'ward' => $ward['name_with_type'],
                ]);
            }
        }
    }
}
