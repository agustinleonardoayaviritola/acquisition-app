<?php

namespace App\Http\Livewire\BasketSubgobernment;

use Livewire\Component;
use App\Models\Basket;
use App\Models\Product;
use App\Models\BasketProduct;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BasketSubgobernmentAddProductUpdate extends Component
{
    use LivewireAlert;

    public $amount;
    public $product_id;
    public $basket_id;
    public $slug;
    public $basket;
    public $price_amount_;
    public $price_amount_descount;
    public function mount()
    {
     $this->basketproduct = BasketProduct::where('slug', $this->slug)->firstOrFail();
     if ($this->basketproduct) {
        $this->product_id =$this->basketproduct->product_id;
        $this->amount = $this->basketproduct->amount;
        $this->basket_id = $this->basketproduct->basket_id;
     }
     $this->products = Product::all()->where('state', '!=', 'DELETED')->where('subgovernment_code', '=', auth()->user()->subgovernment_code);
     $this->basket = Basket::where('id', $this->basketproduct->basket_id)->firstOrFail();
    }
    protected $rules = [
        'product_id' => 'required',
        'amount' => 'required',

    ];
    public function render()
    {
        return view('livewire.basket-subgobernment.basket-subgobernment-add-product-update');
    }
    public function submit()
    {
        
        $this->validate();

        $this->productdatadescount = Product::where('id', $this->basketproduct->product_id)->firstOrFail();
        $this->price_amount_descount = $this->basket->price_amount - ($this->productdatadescount->amount * $this->basketproduct->amount);

        $this->basket->update([
            'price_amount' => $this->price_amount_descount,
        ]);

        $this->basketproduct->update([
            'user_id' => Auth()->User()->id,
            'product_id' => $this->product_id,
            'amount' => $this->amount,
        ]);

        $this->productdata = Product::where('id', $this->product_id)->firstOrFail();
        $this->price_amount_ = $this->basket->price_amount + ($this->productdata->amount * $this->amount);


        $this->basket->update([
            'price_amount' => $this->price_amount_,
        ]);
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);
    }
    public function onChangeSelectProduct()
    {
        $this->products = Product::all()->where('state', '!=', 'DELETED')->where('subgovernment_code', '=', auth()->user()->subgovernment_code);
    }
}
