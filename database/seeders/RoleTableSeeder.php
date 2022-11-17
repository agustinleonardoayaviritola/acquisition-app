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
      
        
        /// ADMIN
        $rol_admin = new Role();
        $rol_admin->name = 'admin';
        $rol_admin->description = 'Usuario';
        $rol_admin->save();

        
        
 



        //CREDENCIALES PARA DESARROLLADORES
        $persona = Person::create([
            'name' => 'Admnistrador',
            'lastname' => 'Administrador'  
        ]);

        $Admin = User::create([
            'person_id' => $persona->id,
            'email' => 'administrador@adquisicion.com',
            'state' => 'ACTIVE',
            'email_verified_at' => now(),
            'slug' => Str::uuid(),
            'password' => bcrypt('4dm1n1str4d0r'),
            'remember_token' => Str::random(10),
        ]);
        $Admin->roles()->attach($rol_admin);
    }
}
