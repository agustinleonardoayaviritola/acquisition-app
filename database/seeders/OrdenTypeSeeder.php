<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\OrderType;

class OrdenTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo1 = OrderType::create([
            'name' => 'COMPRA',
            'description' => 'Habiéndose adjudicado los ítems citados en la descripción, agradecemos a Uds. enviarnos a nuestro Almacén en el plazo de entrega ofertado.
                              La factura deberá detallar los ítems adjudicados y el número de la presente Orden de Compra; al NIT del Gobierno Autónomo Departamental de Tarija # 178928029',
            'state' => 'ACTIVO',
            'slug' => Str::uuid(),
        ]);

        $tipo2 = OrderType::create([
            'name' => 'TRABAJO',
            'description' => 'Habiéndose adjudicado las Obras o Servicios citados en la descripcion, agradecemos a Uds. Ejecutar la misma y coordinar la recepcion y conformidad con el area de Servicios Generales.
                                La factura que deberá detallar los ítems adjudicados y el número de la presente Orden de Trabajo, al NIT del Gobierno Autonomo  Departamental de Tarija # 178928029',
            'state' => 'ACTIVO',
            'slug' => Str::uuid(),
        ]);

    }
}
