<?php

namespace App\Http\Livewire\DeliveryPoint;

use App\Models\DeliveryPoint;
use app\Models\User;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;


class DeliveryPointCreate extends Component
{
    //Using de alert
    use LivewireAlert;

    //varibles para propiedades
    public $name;
    public $description;
    public $state = 'ACTIVE';
    public function render()
    {
        return view('livewire.delivery-point.delivery-point-create');
    }
    //reglas para validacion
    protected $rules = [
        
        'name' => 'required',
        'state' => 'required',
    ];

    //Metodo que llama el formulario
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->validate();

        //Creando registro
        DeliveryPoint::create([
            'user_id' => Auth()->User()->id,
            'name' => $this->name,
            'description' => $this->description,
            //generar slug
            'slug' => Str::uuid(),
            'state' => $this->state,
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
        $this->description = "";
        $this->state = "ACTIVE";
    }

    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    //Funcion que llama la alerta para redigir al dashboard
    public function confirmed()
    {
        return redirect()->route('delivery-point.dashboard');
    }





}
