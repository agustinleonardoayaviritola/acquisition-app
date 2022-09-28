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
/*         \App\Models\Beneficiary::factory(7263)->update();
        \App\Models\Beneficiary::factory()->update([
             'user_id' => 1
        ]); */
/* 
        App\Models\Beneficiary::chunk(7263, function ($beneficiaries){
            foreach($beneficiaries as $beneficiary){
                $beneficiary->user_id = 1;
                $beneficiary->save();
            }
        }); */
    }
}
