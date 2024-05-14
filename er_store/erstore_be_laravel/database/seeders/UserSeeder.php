<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->truncate();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            // $name = $faker->userName();
            $name = 'user'.($i+1);
            $email = str_replace('.', '_', strtolower($name)). '@gmail.com';
            // $name = explode('@', $email)[0];
            User::create([
                'id' =>$i+1,
                'name' => $name,
                'email' => $email,

                'phone'=>$faker->numerify('0#########'),
                'password'=>Hash::make('12345678'),
                'email_verified_at'=> Carbon::now('Asia/Ho_Chi_Minh'),
                'created_at'=> Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at'=> Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }

    }

}
