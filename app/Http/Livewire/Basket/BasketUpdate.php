<?php

namespace App\Http\Livewire\Basket;

use App\Models\Basket;
use App\Models\Product;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BasketUpdate extends Component
{
    use LivewireAlert; 
    public function render()
    {
        return view('livewire.basket.basket-update');
    }

    public function mount($slug)
    {
        $this->basket = Basket::where('slug', $slug)->firstOrFail();
        if ($this->basket) {
            $this->name = $this->basket->name;
            $this->description = $this->basket->description;
            $this->state = $this->basket->state;
        }
    }
  
    protected $rules = [
        'code' => 'required|max:100|min:2|unique:baskets,code',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['code'] = 'required|unique:baskets,code,' . $this->basket->id;
        $this->validate();

        //Actualizar registro
        $this->basket->update([
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state,
        ]);
        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);
    }
    protected $listeners = [
        'confirmed',
    ];



}
