<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Person;
use App\Models\IdentityDocumentType;
use App\Models\DocumentPerson;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class UserUpdate extends Component
{
    use LivewireAlert;
    //person
    public $person;

    public $name;
    public $lastname;
    public $address;
    public $num_address;
    public $date_birth;

    //TypeDocument
    public $identitydocumenttype;

    //Document Person
    public $documentperson;
    public $document_number;
    public $document_issuance;
    public $document_supplement;
    //user
    public $user;
    public $email;
    public $password;
    public $state;
    public $slug;
    //Rol
    public $role;
    public $role_id;

    public function mount($slug)
    {
        //dd($slug);
        $this->user = User::where('slug', $slug)->firstOrFail();
    
        $this->person = Person::where('id', $this->user->person_id)->firstOrFail();
    
        $this->roles = Role::all();
        if ($this->user) {
            //cargando datos del usuario
            $this->person_id = $this->user->person_id;
            $this->email = $this->user->email;
            $this->state = $this->user->state;

            //Verificando rol
            $this->role_id = $this->user->roles->first()->id;
            $this->role = $this->user->roles->first()->id;

        }
        if ($this->person) {

            $this->name = $this->person->name;
            $this->lastname = $this->person->lastname;
        }
    }

    public function render()
    {
        return view('livewire.user.user-update');
    }
    protected $rules = [
        //restriccion person
        'name' => 'required|max:255|min:2',
        'lastname' => 'required|max:255|min:2',
        //restriccion user
        'email' => 'unique:users|email',
        'password' => 'nullable',
        'state' => 'required',

    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['slug'] = 'required|unique:users,slug,' . $this->user->id;
        $this->rules['email'] = 'required|unique:users,email,' . $this->user->id;
        $this->validate();
        if((int)$this->role_id <> $this->role){
            //Editando rol
            $this->user->roles()->detach($this->role);
            $this->user->roles()->attach($this->role_id);
        }
        if($this->password) {
            //Actualizando registro
            $this->user->update([
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'state' => $this->state,
            ]);
        } else {
            //Actualizando registro
            $this->user->update([
                'email' => $this->email,
                'state' => $this->state,
            ]);
        }
            $this->person->update([

                'name' => $this->name,
                'lastname' => $this->lastname,
            ]);

        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',

        ]);
    }
    public function onChangeSelectRole()
    {
        $this->roles = Role::all();
    }
}
