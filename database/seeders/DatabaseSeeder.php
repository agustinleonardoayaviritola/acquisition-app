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

        $this->call(IdendityDocumentTypeSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(ProfessionSeeder::class);
        $this->call(BeneficiaryStateSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(SubgovernmentSeeder::class);
        $this->call(SanLorenzoSeeder::class);
        $this->call(BermejoSeeder::class);
        $this->call(BeneficiaryBermejoSeeder::class);
        $this->call(BeneficiarySanLorenzoSeeder::class);
        $this->call(CredentialSeeder::class);
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
