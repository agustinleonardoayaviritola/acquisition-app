<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Person;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //SUPER ADMINISTRADOR
        $rol_superadmin = new Role();
        $rol_superadmin->name = 'superadmin';
        $rol_superadmin->description = 'Administrator de todo el sistema';
        $rol_superadmin->save();

        /// USER
        $rol_admin = new Role();
        $rol_admin->name = 'admin';
        $rol_admin->description = 'Usuario';
        $rol_admin->save();

        //ADMIN
        $admin = new Role();
        $admin->name = 'lector';
        $admin->description = 'Usuario visualizador';
        $admin->save();


        //CREDENCIALES PARA DESARROLLADORES

        $agustin = Person::create([
            'name' => 'Agustin',
            'lastname' => 'Ayaviri Tolaba'
        ]);

        $Admin2 = User::create([
            'person_id' => $agustin->id,
            'email' => 'agustin@adquisicion.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'slug' => Str::uuid(),
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ]);
        $Admin2->roles()->attach($rol_superadmin);



        $Adalid = Person::create([
            'name' => 'Adalid',
            'lastname' => 'Arias Martinez'
        ]);

        $Admin2 = User::create([
            'person_id' => $Adalid->id,
            'email' => 'adalid@adquisicion.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'slug' => Str::uuid(),
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ]);
        $Admin2->roles()->attach($rol_superadmin);

        $Roger = Person::create([
            'name' => 'Eddy Roger',
            'lastname' => 'Calderon Caquiva'
        ]);

        $Admin2 = User::create([
            'person_id' => $Roger->id,
            'email' => 'roger@adquisicion.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'slug' => Str::uuid(),
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ]);
        $Admin2->roles()->attach($rol_superadmin);


        //CREDENCIALES PARA USUARIOS FINALES
        $persona1 = Person::create([
            'name' => 'Shirley Joana',
            'lastname' => 'Cadena Fernandez'
        ]);

        $usuario1 = User::create([
            'person_id' => $persona1->id,
            'email' => 'shirleycadena@adquisicion.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'slug' => Str::uuid(),
            'password' => bcrypt('shjocafe'),
            'remember_token' => Str::random(10),
        ]);
        $usuario1->roles()->attach($rol_admin);

        $persona2 = Person::create([
            'name' => 'Christian Gonzalo',
            'lastname' => 'Frontanilla Aviles'
        ]);

        $usuario2 = User::create([
            'person_id' => $persona2->id,
            'email' => 'christianfrontanilla@adquisicion.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'slug' => Str::uuid(),
            'password' => bcrypt('chgofrav'),
            'remember_token' => Str::random(10),
        ]);
        $usuario2->roles()->attach($rol_admin);

        $persona3 = Person::create([
            'name' => 'Antonio Marcelo',
            'lastname' => 'Casso Nieva'
        ]);

        $usuario3 = User::create([
            'person_id' => $persona3->id,
            'email' => 'antonioCasso@adquisicion.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'slug' => Str::uuid(),
            'password' => bcrypt('anmacani'),
            'remember_token' => Str::random(10),
        ]);
        $usuario3->roles()->attach($rol_admin);

        $persona4 = Person::create([
            'name' => 'Miriam Janice',
            'lastname' => 'Palacios Benites'
        ]);

        $usuario4 = User::create([
            'person_id' => $persona4->id,
            'email' => 'miriampalacios@adquisicion.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'slug' => Str::uuid(),
            'password' => bcrypt('mijapabe'),
            'remember_token' => Str::random(10),
        ]);
        $usuario4->roles()->attach($rol_admin);
    }
}
