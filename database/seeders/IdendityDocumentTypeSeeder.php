<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IdentityDocumentType;
use Illuminate\Support\Str;
class IdendityDocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Create Identity Document Type C.I.
        IdentityDocumentType::create([
            'name' => 'C.I.',
            'description' => 'Cédula de Identidad',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //Create Identity Document Type Libreta Militar
        IdentityDocumentType::create([
            'name' => 'Libreta Militar',
            'description' => 'Libreta de Servicio Militar',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //Create Identity Document Type RUM
        IdentityDocumentType::create([
            'name' => 'RUM',
            'description' => 'Registro Único Nacional',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //Factory Identity Document Type
        //IdentityDocumentType::factory(1000)->create();
    }
}
