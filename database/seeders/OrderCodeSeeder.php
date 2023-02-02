<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderCode;
use Illuminate\Support\Str;
class OrderCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $OrderCode1 = OrderCode::create([
            'user_id' => 1,
            'name' => 'DA',
            'state' => 'ACTIVO',
            'slug' => Str::uuid(),
        ]);

        $OrderCode2 = OrderCode::create([
            'user_id' => 1,
            'name' => 'DF',
            'state' => 'ACTIVO',
            'slug' => Str::uuid(),
        ]);
    }
}
