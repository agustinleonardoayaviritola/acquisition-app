<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BeneficiaryState;
use App\Models\BeneficiaryStateDetail;
use Illuminate\Support\Str;

class BeneficiaryStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $state1 = new BeneficiaryState();
        $state1->name = 'HABILITADO';
        $state1->description = 'beneficiario habilitado';
        $state1->state = 'ACTIVE';
        $state1->slug = Str::uuid();
        $state1->save();

        $state2 = new BeneficiaryState();
        $state2->name = 'PRE-INSCRIBIDO';
        $state2->description = 'Pre-Inscribido';
        $state2->state = 'ACTIVE';
        $state2->slug = Str::uuid();
        $state2->save();

        $state4 = new BeneficiaryState();
        $state4->name = 'OBSERVADO';
        $state4->description = 'Observado';
        $state4->state = 'ACTIVE';
        $state4->slug = Str::uuid();
        $state4->save();

        $state5 = new BeneficiaryState();
        $state5->name = 'SUSPENSIÓN TEMPORAL';
        $state5->description = 'suspendido temporal';
        $state5->state = 'ACTIVE';
        $state5->slug = Str::uuid();
        $state5->save();

        $state6 = new BeneficiaryState();
        $state6->name = 'EXTINGUIDO';
        $state6->description = 'extinguido';
        $state6->state = 'ACTIVE';
        $state6->slug = Str::uuid();
        $state6->save();

        //////////////////////////////////////////

        BeneficiaryStateDetail::create([
            'beneficiary_state_id' =>  $state1->id,
            'description' => 'REHABILITADO',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' =>  $state1->id,
            'description' => 'HABILITADO PARA LA ENTREGA',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        /////
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' =>  $state2->id,
            'description' => 'NUEVO BENEFICIARIO',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        //////
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' =>  $state4->id,
            'description' => 'CARNET DE IDENTIDAD - CADUCADO',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' =>  $state4->id,
            'description' => 'CARNET DE IDENTIDAD - FALTA ACTUALIZAR DIRECCIÓN',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' =>  $state4->id,
            'description' => 'CARNET DE IDENTIDAD - FALTA FOTOCOPIA',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' =>  $state4->id,
            'description' => 'CARNET DE IDENTIDAD - ILEGIBLE',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' =>  $state4->id,
            'description' => 'CERTIFICADO DE RESIDENCIA - DIRECCIÓN INCORRECTA',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' =>  $state4->id,
            'description' => 'CERTIFICADO DE RESIDENCIA - FALTA DE SELLO O FIRMA',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' =>  $state4->id,
            'description' => 'CERTIFICADO DE RESIDENCIA - NO CUMPLE LOS 5 AÑOS',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' =>  $state4->id,
            'description' => 'CERTIFICADO DE RESIDENCIA - NO PRESENTO',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' =>  $state4->id,
            'description' => 'NO PRESENTO DOCUMENTO PERMITIDO PARA REGISTRO',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' =>  $state4->id,
            'description' => 'OTRO',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        //////////


        BeneficiaryStateDetail::create([
            'beneficiary_state_id' => $state5->id,
            'description' => 'COMERCIALIZADO DE PRODUCTOS',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' => $state5->id,
            'description' => 'RETIRO MÁS DE UNA VEZ',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' => $state5->id,
            'description' => 'DOBLE REGISTRO',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        BeneficiaryStateDetail::create([
            'beneficiary_state_id' => $state5->id,
            'description' => 'ADULTERACIÓN DE DOCUMENTOS',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);
        ///////

        BeneficiaryStateDetail::create([
            'beneficiary_state_id' => $state6->id,
            'description' => 'POR MUERTE',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);

        BeneficiaryStateDetail::create([
            'beneficiary_state_id' => $state6->id,
            'description' => 'POR RENUNCIA',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);

        BeneficiaryStateDetail::create([
            'beneficiary_state_id' => $state6->id,
            'description' => 'POR CAMBIO DE RESIDENCIA',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);

        BeneficiaryStateDetail::create([
            'beneficiary_state_id' => $state6->id,
            'description' => 'POR SUSPENSIÓN DEFINITIVA',
            'state' => 'ACTIVE',
            'slug' => Str::uuid(),
        ]);





    }
}
