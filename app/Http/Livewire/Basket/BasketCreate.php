<?php

namespace App\Http\Livewire\Basket;
use Livewire\Component;
use App\Models\Basket;
use App\Models\Product;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BasketCreate extends Component
{
    use LivewireAlert; 
    //varibles para propiedades
    public $code;
    public $description;
    public $name;
    public $state = "ACTIVE";
    
    public function render()
    {
        return view('livewire.basket.basket-create');
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
        Basket::create([
            'user_id' => Auth()->User()->id,
            'code' => Str::uuid(),            
            'name' => $this->name,
            'description' => $this->description,
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

    //Funcion para limpiar campos
    public function cleanInputs()
    {
        
        $this->description = "";
        $this->name = "";
        $this->state = "ACTIVE";

    }
    
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    //Funcion que llama la alerta para redigir al dashboard
    public function confirmed()
    {
        return redirect()->route('basket.dashboard');
    }





}
