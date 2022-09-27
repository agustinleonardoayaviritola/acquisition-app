<?php

namespace App\Http\Livewire\Basket;

use Livewire\Component;
use App\Models\Basket;
use App\Models\Product;
use App\Models\BasketProduct;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BasketAddProductUpdate extends Component
{
    use LivewireAlert;

    public $amount;
    public $product_id;
    public $basket_id;
    public $slug;
    public $basket;
    public function mount()
    {
     $this->basketproduct = BasketProduct::where('slug', $this->slug)->firstOrFail();
     if ($this->basketproduct) {
        $this->product_id =$this->basketproduct->product_id;
        $this->amount = $this->basketproduct->amount;
        $this->basket_id = $this->basketproduct->basket_id;
     }
     $this->products = Product::all();
     
    }
    protected $rules = [
        'product_id' => 'required',
        'amount' => 'required',

    ];
    public function render()
    {
        return view('livewire.basket.basket-add-product-update');
    }
    public function submit()
    {
        
        $this->validate();

        //Actualizar registro
        $this->basketproduct->update([
            'user_id' => Auth()->User()->id,
            'product_id' => $this->product_id,
            'amount' => $this->amount,
        ]);
        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);
    }
    public function onChangeSelectProduct()
    {
        $this->products = Product::all();
    }
}
