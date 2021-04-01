<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Gallery;
use App\Models\Gardner;
use App\Models\Item;
use App\Models\Role;
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
        $a_role = Role::create(['name' => 'admin']);
        $c_role = Role::create(['name' => 'customer']);
        $g_role = Role::create(['name' => 'gardner']);
        $admin = Admin::factory(1)->create([
            'email' => 'admin@admin.com'
        ]);
        $gardner = Gardner::factory(1)->create([
            'email' => 'gardner@gardner.com'
        ]);
        $customer = Customer::factory(1)->create([
            'email' => 'customer@customer.com'
        ]);
        Admin::find(1)->attachRole($a_role);
        Gallery::create([
            'name' => 'general gallery'
        ]);
    }
}
