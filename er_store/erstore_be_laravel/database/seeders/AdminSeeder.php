<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name'=>'Quản trị viên',
            'email'=>'admin@admin.com',
            'phone'=>'0912345678',
            'password'=>Hash::make('123456789'),
            'email_verified_at'=> Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
    }
}
