<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Gardner;
use App\Models\Item;
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
        // \App\Models\User::factory(10)->create();
        Admin::factory(1)->create([
            'email'=>'admin@admin.com'
        ]);
        Gardner::factory(1)->create([
            'email'=>'gardner@gardner.com'
        ]);
        Customer::factory(1)->create([
            'email'=>'customer@customer.com'
        ]);
    }
}
