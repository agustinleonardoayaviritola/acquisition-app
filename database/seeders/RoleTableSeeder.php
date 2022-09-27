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
        ///Setting
        $Setting = new Setting();
        $Setting->deliveries = 'ACTIVE';
        $Setting->records = 'ACTIVE';
        $Setting->updates = 'ACTIVE';
        $Setting->slug = '5db32257-0105-46f6-8519-9759ea997cde';
        $Setting->save();
        //ROLES
        //SUPER ADMINISTRADOR
        $rol_superadmin = new Role();
        $rol_superadmin->name = 'superadmin';
        $rol_superadmin->description = 'Super Administrator';
        $rol_superadmin->save();

        /// ADMIN
        $rol_admin = new Role();
        $rol_admin->name = 'admin';
        $rol_admin->description = 'Administrator General';
        $rol_admin->save();


        //USER GENERAL
        $rol_user = new Role();
        $rol_user->name = 'user';
        $rol_user->description = 'Usuario general';
        $rol_user->save();
        
        
        //ADMIN -SUB GOBERNACIÓN 
        $rol_admin_subgobernacion = new Role();
        $rol_admin_subgobernacion->name = 'subgobernacionadmin';
        $rol_admin_subgobernacion->description = 'Administrador de subgobernacion';
        $rol_admin_subgobernacion->save();


        //User -SUB GOBERNACIÓN 
        $user_subgobernacion = new Role();
        $user_subgobernacion->name = 'subgobernacionuser';
        $user_subgobernacion->description = 'Usuario general';
        $user_subgobernacion->save();



        //CREDENCIALES PARA DESARROLLADORES
        $persona = Person::create([
            'name' => 'Agustin Leonardo',
            'lastname' => 'Ayaviri Tolaba'  
        ]);

        $Admin = User::create([
            'person_id' => $persona->id,
            'email' => 'agustin@canasta.com',
            'state' => 'ACTIVE',
            'email_verified_at' => now(),
            'slug' => Str::uuid(),
            'password' => bcrypt('tTj5V1o#VBg1'),
            'remember_token' => Str::random(10),
        ]);
        $Admin->roles()->attach($rol_superadmin);

        //// Javier
        $persona2 = Person::create([
            'name' => 'Luis Javier', 
            'lastname' => 'Gutierrez' 
        ]);

        $Admin2 = User::create([
            'person_id' => $persona2->id,
            'email' => 'javier@canasta.com',
            'state' => 'ACTIVE',
            'email_verified_at' => now(),
            'slug' => Str::uuid(),
            'password' => bcrypt('@2v7F435P2Jm'),
            'remember_token' => Str::random(10),
        ]);
        $Admin2->roles()->attach($rol_admin);
        
        //// Mauricio
        $persona3 = Person::create([
            'name' => 'Mauricio',
            'lastname' => 'Aramayo' 
        ]);

        $Admin3 = User::create([
            'person_id' => $persona3->id,
            'email' => 'mauricio@canasta.com',
            'state' => 'ACTIVE',
            'email_verified_at' => now(),
            'slug' => Str::uuid(),
            'password' => bcrypt('Xz39sz7TV7%p'),
            'remember_token' => Str::random(10),
        ]);
        $Admin3->roles()->attach($rol_admin);

        ///// Oscar
        $persona4 = Person::create([
            'name' => 'Oscar',
            'lastname' => 'Quevedo Beramendi' 
        ]);

        $Admin4 = User::create([
            'person_id' => $persona4->id,
            'email' => 'oscar@canasta.com',
            'state' => 'ACTIVE',
            'email_verified_at' => now(),
            'slug' => Str::uuid(),
            'password' => bcrypt('jhPMv79p1YX%'),
            'remember_token' => Str::random(10),
        ]);
        $Admin4->roles()->attach($rol_admin);

        //// Horacio
        $persona5 = Person::create([
            'name' => 'Horacio Daniel',
            'lastname' => 'Poveda' 
        ]);

        $Admin5 = User::create([
            'person_id' => $persona5->id,
            'email' => 'horacio@canasta.com',
            'state' => 'ACTIVE',
            'email_verified_at' => now(),
            'slug' => Str::uuid(),
            'password' => bcrypt('5iBh$31QEV9*'),
            'remember_token' => Str::random(10),
        ]);
        $Admin5->roles()->attach($rol_user);
    }
}
