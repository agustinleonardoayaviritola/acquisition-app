<?php

namespace App\Http\Livewire\BasketSubgobernment;

use Livewire\Component;
use App\Models\Basket;
use App\Models\Product;
use App\Models\BasketProduct;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BasketSubgobernmentAddProduct extends Component
{
    

    use LivewireAlert;

    public $amount;
    public $product_id;
    public $basket_id;
    
    public $state = "ACTIVE";
    public $slug;
    public $basket;
    ///
    public $price_amount_;

    public function mount()
   {
    $this->basket = Basket::where('slug', $this->slug)->firstOrFail();
    $this->products = Product::all()->where('state', '=', 'ACTIVE')->where('subgovernment_code', '=', auth()->user()->subgovernment_code);
    
   }

   public function render()
    {
        return view('livewire.basket-subgobernment.basket-subgobernment-add-product');
    }

    protected $rules = [
        'product_id' => 'required',
        'amount' => 'required',

    ];

    public function submit()
    {

        $this->validate();


        BasketProduct::create([
            'user_id' => Auth()->User()->id,
            'product_id' => $this->product_id,
            'amount' => $this->amount,
            'basket_id'=> $this->basket->id,
            'subgovernment_code' => auth()->user()->subgovernment_code,
            'state' => $this->state,
            'slug' => Str::uuid(),
        ]);
        
        $this->productdata = Product::where('id', $this->product_id)->firstOrFail();

       // $this->price_amount_ = number_format($this->basket->price_amount + $this->productdata->amount,2);
        $this->price_amount_ = $this->basket->price_amount + ($this->productdata->amount * $this->amount);
        
        $this->basket->update([
            'price_amount' => $this->price_amount_,
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
    public function onChangeSelectProduct()
    {
        $this->products = Product::all()->where('state', '=', 'ACTIVE')->where('subgovernment_code', '=', auth()->user()->subgovernment_code);

    }
    public function cleanInputs()
    {
        $this->product_id = "";
        $this->amount = "";
    }
    protected $listeners = [
        'confirmed',
    ];
    public function confirmed()
    {
        return redirect()->route('basket-subgobernment.dashboard');
    }
}
