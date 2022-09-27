<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subgovernment;
use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Str;

class SubgovernmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //// SUB GOBERNACIÓN CERCADO
        $PERSON_CERCADO = new Person();
        $PERSON_CERCADO->name = 'nombre cercado';
        $PERSON_CERCADO->lastname = 'nombre cercado';
        $PERSON_CERCADO->save();


        $USER_CERCADO = new User();
        $USER_CERCADO->person_id = $PERSON_CERCADO->id;
        $USER_CERCADO->email = 'usuario@cercado.com';
        $USER_CERCADO->email_verified_at = now();
        $USER_CERCADO->password = bcrypt('admin');
        $USER_CERCADO->remember_token = Str::random(10);
        $USER_CERCADO->slug = Str::uuid();
        $USER_CERCADO->state = 'ACTIVE';
        $USER_CERCADO->save();

        $USER_CERCADO->roles()->attach(4);

        $SUB_GOBERNACIÓN_CERCADO = new Subgovernment(); 
        $SUB_GOBERNACIÓN_CERCADO->user_id = $USER_CERCADO->id;
        $SUB_GOBERNACIÓN_CERCADO->name = 'SUB GOBERNACIÓN CERCADO';
        $SUB_GOBERNACIÓN_CERCADO->municipality_id = 1; 
        $SUB_GOBERNACIÓN_CERCADO->description = 'SUB GOBERNACIÓN CERCADO'; 
        $SUB_GOBERNACIÓN_CERCADO->state = 'ACTIVE'; 
        $SUB_GOBERNACIÓN_CERCADO->slug = 'f6734450-80aa-454f-9aa5-465465523d36';
        $SUB_GOBERNACIÓN_CERCADO->save();

        $USER_CERCADO->subgovernment_code = $SUB_GOBERNACIÓN_CERCADO->slug;
        $USER_CERCADO->update();


        /// SUB GOBERNACIÓN BERMEJO
        $PERSON_BERMEJO = new Person();
        $PERSON_BERMEJO->name = 'Victor';
        $PERSON_BERMEJO->lastname = 'Valverde Tito';
        $PERSON_BERMEJO->save();


        $USER_BERMEJO = new User();
        $USER_BERMEJO->person_id = $PERSON_BERMEJO->id;
        $USER_BERMEJO->email = 'victor@bermejo.com';
        $USER_BERMEJO->email_verified_at = now();
        $USER_BERMEJO->password = bcrypt('57k7jMJf#16z');
        $USER_BERMEJO->remember_token = Str::random(10);
        $USER_BERMEJO->slug = Str::uuid();
        $USER_BERMEJO->state = 'ACTIVE';
        $USER_BERMEJO->save();

        $USER_BERMEJO->roles()->attach(4);

        $SUB_GOBERNACIÓN_BERMEJO = new Subgovernment(); 
        $SUB_GOBERNACIÓN_BERMEJO->user_id = $USER_BERMEJO->id;
        $SUB_GOBERNACIÓN_BERMEJO->name = 'SUB GOBERNACIÓN BERMEJO';
        $SUB_GOBERNACIÓN_BERMEJO->municipality_id = 11; 
        $SUB_GOBERNACIÓN_BERMEJO->description = 'SUB GOBERNACIÓN BERMEJO'; 
        $SUB_GOBERNACIÓN_BERMEJO->state = 'ACTIVE'; 
        $SUB_GOBERNACIÓN_BERMEJO->slug = 'bf4d54a5-ce78-467f-9764-b0271ea46e6f'; 
        $SUB_GOBERNACIÓN_BERMEJO->save();

        $USER_BERMEJO->subgovernment_code = $SUB_GOBERNACIÓN_BERMEJO->slug;
        $USER_BERMEJO->update();



        /// SUB GOBERNACIÓN EL PUENTE 
        $PERSON_PUENTE = new Person();
        $PERSON_PUENTE->name = 'nombre puente';
        $PERSON_PUENTE->lastname = 'nombre puente';
        $PERSON_PUENTE->save();


        $USER_PUENTE = new User();
        $USER_PUENTE->person_id = $PERSON_PUENTE->id;
        $USER_PUENTE->email = 'usuario@puente.com';
        $USER_PUENTE->email_verified_at = now();
        $USER_PUENTE->password = bcrypt('admin');
        $USER_PUENTE->remember_token = Str::random(10);
        $USER_PUENTE->slug = Str::uuid();
        $USER_PUENTE->state = 'ACTIVE';
        $USER_PUENTE->save();

        $USER_PUENTE->roles()->attach(4);

        $SUB_GOBERNACIÓN_PUENTE = new Subgovernment(); 
        $SUB_GOBERNACIÓN_PUENTE->user_id = $USER_PUENTE->id;
        $SUB_GOBERNACIÓN_PUENTE->name = 'SUB GOBERNACIÓN EL PUENTE';
        $SUB_GOBERNACIÓN_PUENTE->municipality_id = 3; 
        $SUB_GOBERNACIÓN_PUENTE->description = 'SUB GOBERNACIÓN EL PUENTE'; 
        $SUB_GOBERNACIÓN_PUENTE->state = 'ACTIVE'; 
        $SUB_GOBERNACIÓN_PUENTE->slug = 'd2e878d1-3118-4c27-a030-cd30b681cc01'; 
        $SUB_GOBERNACIÓN_PUENTE->save();

        $USER_PUENTE->subgovernment_code = $SUB_GOBERNACIÓN_PUENTE->slug;
        $USER_PUENTE->update();



        ///SUB GOBERNACIÓN SAN LORENZO
        $PERSON_LORENZO = new Person();
        $PERSON_LORENZO->name = 'Mirian';
        $PERSON_LORENZO->lastname = 'Velázquez Mendoza';
        $PERSON_LORENZO->save();


        $USER_LORENZO = new User();
        $USER_LORENZO->person_id = $PERSON_LORENZO->id;
        $USER_LORENZO->email = 'mirian@sanlorenzo.com';
        $USER_LORENZO->email_verified_at = now();
        $USER_LORENZO->password = bcrypt('C4BcA5e@8eMB');
        $USER_LORENZO->remember_token = Str::random(10);
        $USER_LORENZO->slug = Str::uuid();
        $USER_LORENZO->state = 'ACTIVE';
        $USER_LORENZO->save();

        $USER_LORENZO->roles()->attach(4);

        $SUB_GOBERNACIÓN_LORENZO = new Subgovernment(); 
        $SUB_GOBERNACIÓN_LORENZO->user_id = $USER_LORENZO->id;
        $SUB_GOBERNACIÓN_LORENZO->name = 'SUB GOBERNACIÓN SAN LORENZO';
        $SUB_GOBERNACIÓN_LORENZO->municipality_id = 2; 
        $SUB_GOBERNACIÓN_LORENZO->description = 'SUB GOBERNACIÓN SAN LORENZO'; 
        $SUB_GOBERNACIÓN_LORENZO->state = 'ACTIVE'; 
        $SUB_GOBERNACIÓN_LORENZO->slug = '96b0e2aa-199b-4036-8524-0090316068d2';
        $SUB_GOBERNACIÓN_LORENZO->save();

        $USER_LORENZO->subgovernment_code = $SUB_GOBERNACIÓN_LORENZO->slug;
        $USER_LORENZO->update();



        ///SUB GOBERNACIÓN ENTRE RIOS
        $PERSON_RIOS = new Person();
        $PERSON_RIOS->name = 'nombre entre rios';
        $PERSON_RIOS->lastname = 'nombre entre rios';
        $PERSON_RIOS->save();


        $USER_RIOS = new User();
        $USER_RIOS->person_id = $PERSON_RIOS->id;
        $USER_RIOS->email = 'usuario@entrerios.com';
        $USER_RIOS->email_verified_at = now();
        $USER_RIOS->password = bcrypt('admin');
        $USER_RIOS->remember_token = Str::random(10);
        $USER_RIOS->slug = Str::uuid();
        $USER_RIOS->state = 'ACTIVE';
        $USER_RIOS->save();

        $USER_RIOS->roles()->attach(4);

        $SUB_GOBERNACIÓN_RIOS = new Subgovernment(); 
        $SUB_GOBERNACIÓN_RIOS->user_id = $USER_RIOS->id;
        $SUB_GOBERNACIÓN_RIOS->name = 'SUB GOBERNACIÓN ENTRE RIOS';
        $SUB_GOBERNACIÓN_RIOS->municipality_id = 4; 
        $SUB_GOBERNACIÓN_RIOS->description = 'SUB GOBERNACIÓN ENTRE RIOS'; 
        $SUB_GOBERNACIÓN_RIOS->state = 'ACTIVE'; 
        $SUB_GOBERNACIÓN_RIOS->slug = 'c6e09bef-bd81-4821-9f5e-453f1fde70ab'; 
        $SUB_GOBERNACIÓN_RIOS->save();

        $USER_RIOS->subgovernment_code = $SUB_GOBERNACIÓN_RIOS->slug;
        $USER_RIOS->update();



        ///SUB GOBERNACIÓN URIONDO
        $PERSON_URIONDO = new Person();
        $PERSON_URIONDO->name = 'nombre uriondo';
        $PERSON_URIONDO->lastname = 'nombre uriondo';
        $PERSON_URIONDO->save();


        $USER_URIONDO = new User();
        $USER_URIONDO->person_id = $PERSON_URIONDO->id;
        $USER_URIONDO->email = 'usuario@uriondo.com';
        $USER_URIONDO->email_verified_at = now();
        $USER_URIONDO->password = bcrypt('admin');
        $USER_URIONDO->remember_token = Str::random(10);
        $USER_URIONDO->slug = Str::uuid();
        $USER_URIONDO->state = 'ACTIVE';
        $USER_URIONDO->save();

        $USER_URIONDO->roles()->attach(4);

        $SUB_GOBERNACIÓN_URIONDO = new Subgovernment(); 
        $SUB_GOBERNACIÓN_URIONDO->user_id = $USER_URIONDO->id;
        $SUB_GOBERNACIÓN_URIONDO->name = 'SUB GOBERNACIÓN URIONDO';
        $SUB_GOBERNACIÓN_URIONDO->municipality_id = 8; 
        $SUB_GOBERNACIÓN_URIONDO->description = 'SUB GOBERNACIÓN URIONDO'; 
        $SUB_GOBERNACIÓN_URIONDO->state = 'ACTIVE'; 
        $SUB_GOBERNACIÓN_URIONDO->slug = '24dd3f69-5246-45dc-86d8-2a265b9cb259'; 
        $SUB_GOBERNACIÓN_URIONDO->save();

        $USER_URIONDO->subgovernment_code = $SUB_GOBERNACIÓN_URIONDO->slug;
        $USER_URIONDO->update();


        ///SUB GOBERNACIÓN PADCAYA
        $PERSON_PADCAYA = new Person();
        $PERSON_PADCAYA->name = 'nombre padcaya';
        $PERSON_PADCAYA->lastname = 'nombre padcaya';
        $PERSON_PADCAYA->save();


        $USER_PADCAYA = new User();
        $USER_PADCAYA->person_id = $PERSON_PADCAYA->id;
        $USER_PADCAYA->email = 'usuario@padcaya.com';
        $USER_PADCAYA->email_verified_at = now();
        $USER_PADCAYA->password = bcrypt('admin');
        $USER_PADCAYA->remember_token = Str::random(10);
        $USER_PADCAYA->slug = Str::uuid();
        $USER_PADCAYA->state = 'ACTIVE';
        $USER_PADCAYA->save();

        $USER_PADCAYA->roles()->attach(4);

        $SUB_GOBERNACIÓN_PADCAYA = new Subgovernment(); 
        $SUB_GOBERNACIÓN_PADCAYA->user_id = $USER_PADCAYA->id;
        $SUB_GOBERNACIÓN_PADCAYA->name = 'SUB GOBERNACIÓN PADCAYA';
        $SUB_GOBERNACIÓN_PADCAYA->municipality_id = 10; 
        $SUB_GOBERNACIÓN_PADCAYA->description = 'SUB GOBERNACIÓN PADCAYA'; 
        $SUB_GOBERNACIÓN_PADCAYA->state = 'ACTIVE'; 
        $SUB_GOBERNACIÓN_PADCAYA->slug = 'abb9d2dd-d9f0-4a92-90fa-9b4e988d0203';
        $SUB_GOBERNACIÓN_PADCAYA->save();

        $USER_PADCAYA->subgovernment_code = $SUB_GOBERNACIÓN_PADCAYA->slug;
        $USER_PADCAYA->update();


        ///SUB GOBERNACIÓN YUNCHARA
        $PERSON_YUNCHARA = new Person();
        $PERSON_YUNCHARA->name = 'nombre yunchara';
        $PERSON_YUNCHARA->lastname = 'nombre yunchara';
        $PERSON_YUNCHARA->save();


        $USER_YUNCHARA = new User();
        $USER_YUNCHARA->person_id = $PERSON_YUNCHARA->id;
        $USER_YUNCHARA->email = 'usuario@yunchara.com';
        $USER_YUNCHARA->email_verified_at = now();
        $USER_YUNCHARA->password = bcrypt('admin');
        $USER_YUNCHARA->remember_token = Str::random(10);
        $USER_YUNCHARA->slug = Str::uuid();
        $USER_YUNCHARA->state = 'ACTIVE';
        $USER_YUNCHARA->save();

        $USER_YUNCHARA->roles()->attach(4);

        $SUB_GOBERNACIÓN_YUNCHARA = new Subgovernment(); 
        $SUB_GOBERNACIÓN_YUNCHARA->user_id = $USER_YUNCHARA->id;
        $SUB_GOBERNACIÓN_YUNCHARA->name = 'SUB GOBERNACIÓN YUNCHARA';
        $SUB_GOBERNACIÓN_YUNCHARA->municipality_id = 9; 
        $SUB_GOBERNACIÓN_YUNCHARA->description = 'SUB GOBERNACIÓN YUNCHARA'; 
        $SUB_GOBERNACIÓN_YUNCHARA->state = 'ACTIVE'; 
        $SUB_GOBERNACIÓN_YUNCHARA->slug = '00681ae2-17ff-419d-a79f-70ab42a6ff0b'; 
        $SUB_GOBERNACIÓN_YUNCHARA->save();

        $USER_YUNCHARA->subgovernment_code = $SUB_GOBERNACIÓN_YUNCHARA->slug;
        $USER_YUNCHARA->update();
      

    }
}
