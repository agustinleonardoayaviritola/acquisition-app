<?php

namespace App\Http\Livewire\OrderCode;

use Livewire\Component;
use App\Models\OrderCode;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OrderCodeCreate extends Component
{
    use LivewireAlert; 
    //varibles para propiedades
    public $name;
    public $state = "ACTIVE";
    public $slug;
    public function render()
    {
        return view('livewire.order-code.order-code-create');
    }
    //reglas para validacion
    protected $rules = [
        'name' => 'required|max:100|min:2|unique:order_codes,name',
        'state' => 'required',
    ];

    //Metodo que llama el formulario
    public function submit()
    {

        //Funcion para validar mediante las reglas
        $this->validate();

        //Creando registro
        OrderCode::create([
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
        return redirect()->route('order-code.dashboard');
    }
}
