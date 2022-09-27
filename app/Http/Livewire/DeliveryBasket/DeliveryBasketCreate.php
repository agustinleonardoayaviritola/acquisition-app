<?php

namespace App\Http\Livewire\DeliveryBasket;

use App\Models\DeliveryBasket;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DeliveryBasketCreate extends Component
{
//Using de alert
use LivewireAlert;

//varibles para propiedades
public $management;
public $mounth;
public $slug;
public $state = "ACTIVE";
public $user_id;
 
public function mount()
    {
        $this->user_id = Auth()->User()->id;
        //dd($this->user_id);
    }

public function render()
{
    return view('livewire.delivery-basket.delivery-basket-create');
}
//reglas para validacion
protected $rules = [
    'user_id' => 'required',
    'management' => 'required',
    'mounth' => 'nullable|max:100|min:2',
    'state' => 'required',
];

//Metodo que llama el formulario
public function submit()
{
    //Funcion para validar mediante las reglas
    $this->validate();

    //Creando registro
    DeliveryBasket::create([
        'user_id' => $this->user_id,
        'management' => $this->management,
        'mounth' => $this->mounth,
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
    $this->management = "";
    $this->mounth= "";
    $this->state = "ACTIVE";
}

//Escuchadores para botones de alertas
protected $listeners = [
    'confirmed',
];

//Funcion que llama la alerta para redigir al dashboard
public function confirmed()
{
    return redirect()->route('delivery-basket.dashboard');
}

   
}
