<?php

namespace Database\Seeders;

use App\Models\Address;
use Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            AddressSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            AttributeSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
