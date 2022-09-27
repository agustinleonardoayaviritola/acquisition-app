<?php

namespace App\Http\Livewire\Basket;

use Livewire\Component;
use App\Models\Basket;
use App\Models\Product;
use App\Models\BasketProduct;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BasketAddProduct extends Component
{
    use LivewireAlert;

//varibles para propiedades
    public $amount;
    public $product_id;
    public $basket_id;
    public $state = "ACTIVE";
    public $slug;
    public $basket;


    //inicilaizador del controlador
    public function mount()
   {
    $this->basket = Basket::where('slug', $this->slug)->firstOrFail();
    $this->products = Product::all();
    
   }

   public function render()
    {
        return view('livewire.basket.basket-add-product');
    }

    protected $rules = [
        'product_id' => 'required',
        'amount' => 'required',
    ];

    public function submit()
    {
       
        //Funcion para validar mediante las reglas
        $this->validate();

        //Creando registro
        BasketProduct::create([
            'user_id' => Auth()->User()->id,
            'product_id' => $this->product_id,
            'amount' => $this->amount,
            'basket_id'=> $this->basket->id,
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

//funcion para el select
    public function onChangeSelectProduct()
    {
        $this->products = Product::all();
    }

    //Funcion para limpiar campos
    public function cleanInputs()
    {
        
        $this->product_id = "";
        $this->amount = "";
        

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
