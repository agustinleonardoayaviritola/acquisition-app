<?php

namespace App\Http\Livewire\ProductSubgovernment;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductSubgovernmentUpdate extends Component
{
    use LivewireAlert;
    //product
    public $name;
    public $amount;
    public $description;
    public $state;
    //public $product;

    public function mount($slug)
    {

        $this->product = Product::where('slug', $slug)->firstOrFail();
        if ($this->product) {
            //cargando datos del profession
            $this->name = $this->product->name;
            $this->amount = $this->product->amount;
            $this->description = $this->product->description;
            $this->state = $this->product->state;
        }
    }
    public function render()
    {
        return view('livewire.product-subgovernment.product-subgovernment-update');
    }
    protected $rules = [
        //restriccion profession
        'name' => 'required|max:255|min:5',
        'description' => 'nullable',
        'state' =>'required',

    ];
    public function submit()
    {
        $this->validate();

        $this->product->update([
            'user_id' => Auth()->User()->id,
            'name' => $this->name,
            'amount' => $this->amount,
            'description' => $this->description,
            'state' => $this->state,
        ]);

        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',

        ]);
    }
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];
    //Funcion que llama la alerta para redigir al dashboar
    public function confirmed()
    {
        return redirect()->route('product-subgovernment.dashboard');
    }
}
