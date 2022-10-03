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




        //CREDENCIALES PARA DESARROLLADORES
        $persona = Person::create([
            'name' => 'Alessandro',
            'lastname' => 'Dominguez Selaes'  
        ]);

        $Admin = User::create([
            'person_id' => $persona->id,
            'email' => 'ales13@gmail.com',
            'state' => 'ACTIVE',
            'email_verified_at' => now(),
            'slug' => Str::uuid(),
            'password' => bcrypt('1234'),
            'remember_token' => Str::random(10),
        ]);
        $Admin->roles()->attach($rol_superadmin);
    }
}
