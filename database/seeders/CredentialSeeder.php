<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Person;
use App\Models\Beneficiary;

use Illuminate\Support\Str;

class CredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SAN LORENZO
        ///usuario 1
        $PERSON_LORENZO1 = new Person();
        $PERSON_LORENZO1->name = 'Elsa';
        $PERSON_LORENZO1->lastname = 'Ayarde Choque';
        $PERSON_LORENZO1->save();

        $USER_LORENZO1 = new User();
        $USER_LORENZO1->person_id = $PERSON_LORENZO1->id;
        $USER_LORENZO1->email = 'elsa@sanlorenzo.com';
        $USER_LORENZO1->email_verified_at = now();
        $USER_LORENZO1->password = bcrypt('ddp7NW9f14*@');
        $USER_LORENZO1->remember_token = Str::random(10);
        $USER_LORENZO1->slug = Str::uuid();
        $USER_LORENZO1->state = 'ACTIVE';
        $USER_LORENZO1->subgovernment_code ='96b0e2aa-199b-4036-8524-0090316068d2';
        $USER_LORENZO1->save();

        $USER_LORENZO1->roles()->attach(5);

        // BERMEJO

        ///usuario 1
        $PERSON_BERMEJO1 = new Person();
        $PERSON_BERMEJO1->name = 'Aidee Hilaria';
        $PERSON_BERMEJO1->lastname = 'Ortega Mogro';
        $PERSON_BERMEJO1->save();

        $USER_BERMEJO1 = new User();
        $USER_BERMEJO1->person_id = $PERSON_BERMEJO1->id;
        $USER_BERMEJO1->email = 'aidee@bermejo.com';
        $USER_BERMEJO1->email_verified_at = now();
        $USER_BERMEJO1->password = bcrypt('eVbva4Q4B36%');
        $USER_BERMEJO1->remember_token = Str::random(10);
        $USER_BERMEJO1->slug = Str::uuid();
        $USER_BERMEJO1->state = 'ACTIVE';
        $USER_BERMEJO1->subgovernment_code ='bf4d54a5-ce78-467f-9764-b0271ea46e6f';
        $USER_BERMEJO1->save();

        $USER_BERMEJO1->roles()->attach(5);

        ///usuario 2
        $PERSON_BERMEJO2 = new Person();
        $PERSON_BERMEJO2->name = 'Walter Armando';
        $PERSON_BERMEJO2->lastname = 'Ruiz Tejerina';
        $PERSON_BERMEJO2->save();

        $USER_BERMEJO2 = new User();
        $USER_BERMEJO2->person_id = $PERSON_BERMEJO2->id;
        $USER_BERMEJO2->email = 'walter@bermejo.com';
        $USER_BERMEJO2->email_verified_at = now();
        $USER_BERMEJO2->password = bcrypt('s52HI6044jh@');
        $USER_BERMEJO2->remember_token = Str::random(10);
        $USER_BERMEJO2->slug = Str::uuid();
        $USER_BERMEJO2->state = 'ACTIVE';
        $USER_BERMEJO2->subgovernment_code ='bf4d54a5-ce78-467f-9764-b0271ea46e6f';
        $USER_BERMEJO2->save();

        $USER_BERMEJO2->roles()->attach(5);

        ///usuario 3

        $PERSON_BERMEJO3 = new Person();
        $PERSON_BERMEJO3->name = 'Yamil Jorge';
        $PERSON_BERMEJO3->lastname = 'Bejarano Parra';
        $PERSON_BERMEJO3->save();

        $USER_BERMEJO3 = new User();
        $USER_BERMEJO3->person_id = $PERSON_BERMEJO3->id;
        $USER_BERMEJO3->email = 'yamil@bermejo.com';
        $USER_BERMEJO3->email_verified_at = now();
        $USER_BERMEJO3->password = bcrypt('pee885lL7%x9');
        $USER_BERMEJO3->remember_token = Str::random(10);
        $USER_BERMEJO3->slug = Str::uuid();
        $USER_BERMEJO3->state = 'ACTIVE';
        $USER_BERMEJO3->subgovernment_code ='bf4d54a5-ce78-467f-9764-b0271ea46e6f';
        $USER_BERMEJO3->save();

        $USER_BERMEJO3->roles()->attach(5);



        /// usuario 4

        $PERSON_BERMEJO4 = new Person();
        $PERSON_BERMEJO4->name = 'Fabián';
        $PERSON_BERMEJO4->lastname = 'Palacios López';
        $PERSON_BERMEJO4->save();

        $USER_BERMEJO4 = new User();
        $USER_BERMEJO4->person_id = $PERSON_BERMEJO4->id;
        $USER_BERMEJO4->email = 'fabian@bermejo.com';
        $USER_BERMEJO4->email_verified_at = now();
        $USER_BERMEJO4->password = bcrypt('TonWjAS$W939');
        $USER_BERMEJO4->remember_token = Str::random(10);
        $USER_BERMEJO4->slug = Str::uuid();
        $USER_BERMEJO4->state = 'ACTIVE';
        $USER_BERMEJO4->subgovernment_code ='bf4d54a5-ce78-467f-9764-b0271ea46e6f';
        $USER_BERMEJO4->save();

        $USER_BERMEJO4->roles()->attach(5);

        $data = Beneficiary::all();
        foreach ($data as $i) {
            $i->update([
                'user_id' => 1,
            ]);
        }



    }
}
