<?php

namespace App\Http\Livewire\Profession;

use Livewire\Component;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProfessionCreate extends Component
{
    use LivewireAlert;
    //profession
    public $name;
    public $description;
    public $state = 'ACTIVE';
  
    public function render()
    {
        return view('livewire.profession.profession-create');
    }
    protected $rules = [
        //restriccion profession
        'name' => 'required|max:255|min:2|unique:professions,name',
        'description' => 'nullable',
        'state' => 'required',

    ];
    //Metodo que llama el formulario
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->validate();
               
        $Profession = Profession::create([
            'user_id' => Auth()->User()->id,
            'name' => $this->name,
            'description' => $this->description,
            //encriptando slug
            'slug' => Str::uuid(),
            'state' => $this->state,
        ]);

        $this->cleanInputs();

        $this->confirm('Registro creado correctamente', [
            'icon' => 'success',
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'showCancelButton' => false,
            'cancelButtonText' => 'Cancelar',
            'confirmButtonText' => 'Aceptar',
            'onConfirmed' => 'confirmed',
        ]);
    }
    //Funcion para limpiar imputs
    public function cleanInputs()
    {
        $this->name = "";
        $this->description = "";
    }
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];
    //Funcion que llama la alerta para redigir al dashboar
    public function confirmed()
    {
        return redirect()->route('profession.dashboard');
    }
}
