<?php

namespace App\Http\Livewire\BasketSubgobernment;

use Livewire\Component;
use App\Models\Basket;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class BasketSubgobernmentUpdate extends Component
{
    
    use LivewireAlert; 

    public function render()
    {
        return view('livewire.basket-subgobernment.basket-subgobernment-update');
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
        
        'state' => 'required',
        'name' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->validate();

        //Actualizar registro
        $this->basket->update([
            'user_id' => Auth()->User()->id,
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


    
}
