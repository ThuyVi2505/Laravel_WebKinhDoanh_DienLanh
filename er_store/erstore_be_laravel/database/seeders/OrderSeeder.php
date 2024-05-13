<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\{User, Address, Order};

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Thời gian bắt đầu và kết thúc của khoảng thời gian (ví dụ: từ 1/1/2023 đến 1/1/2024)
        $startTime = Carbon::create(2023, 1, 1, 0, 0, 0, 'Asia/Ho_Chi_Minh');
        $endTime = Carbon::now('Asia/Ho_Chi_Minh');

        $users = User::all();
        foreach($users as $user){
            $num = rand(0,30);
            for ($i = 0; $i < $num; $i++) {
                // $fake data
                $faker = \Faker\Factory::create();
                // Lấy một thời gian ngẫu nhiên trong khoảng thời gian đã cho
                $currentTime = Carbon::createFromTimestamp(mt_rand($startTime->timestamp, $endTime->timestamp));
                //render code
                $code = 'HD' . $currentTime->format('Hisdmy') . $faker->randomNumber(5);
                // địa chỉ ship random tương ứng với của user
                $address=Address::where('user_id',$user->id)->inRandomOrder()->first();
                $address_ship=$address->number.' '.$address->street.', '.$address->ward.', '.$address->district.', '.$address->city.'.';
                Order::create([
                    'user_id'=>$user->id,
                    'code'=>$code,
                    'total_amount'=>0,
                    'address_ship'=>$address_ship,
                    'created_at'=>$currentTime
                ]);
            }
        }
    }
}
