<?php

namespace Database\Seeders;

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
        $this->call(RoleTableSeeder::class);
        $this->call(OrdenTypeSeeder::class);
        $this->call(OrderCodeSeeder::class);
        $this->call(RequestingUnitSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(SupplierSeeder::class);

    }
}
