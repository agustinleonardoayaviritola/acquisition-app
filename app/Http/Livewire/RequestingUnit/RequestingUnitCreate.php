<?php

namespace App\Http\Livewire\RequestingUnit;

use Livewire\Component;
use App\Models\RequestingUnit;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RequestingUnitCreate extends Component
{
    use LivewireAlert; 
    //varibles para propiedades
    public $name;
    public $state = "ACTIVO";
    public $slug;

    public function render()
    {
        return view('livewire.requesting-unit.requesting-unit-create');
    }
    //reglas para validacion
    protected $rules = [
        'name' => 'required|max:100|min:2|unique:requesting_units,name',
        'state' => 'required',
    ];

    //Metodo que llama el formulario
    public function submit()
    {

        //Funcion para validar mediante las reglas
        $this->validate();

        //Creando registro
        RequestingUnit::create([
            'name' => $this->name,
            //generar slug
            'state' => $this->state,
            'slug' => Str::uuid(),
        ]);


        //Llamando a funcion para limpiar inputs
        $this->cleanInputs();

        //Mostrar alerta de registro
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
    }

    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    //Funcion que llama la alerta para redigir al dashboard
    public function confirmed()
    {
        return redirect()->route('requesting-unit.dashboard');
    }
}
