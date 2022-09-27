<?php

namespace App\Http\Livewire\DeliveryBasket;

use Livewire\Component;
use App\Models\DeliveryBasket;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DeliveryBasketUpdate extends Component
{

    //Using de alert
    use LivewireAlert; 

    //varibles para propiedades
    public $management;
    public $mounth;
    public $state;
    public $user_id;

    public function render()
    {
        return view('livewire.delivery-basket.delivery-basket-update');
    }

    public function mount($slug)
    {
        $this-> DeliveryBasket = DeliveryBasket::where('slug', $slug)->firstOrFail();
        if ($this->DeliveryBasket) 
        {
            $this->user_id = $this-> DeliveryBasket->user_id;
            $this->management = $this->DeliveryBasket->management;
            $this->mounth = $this->DeliveryBasket->mounth;
            
            $this->state = $this->DeliveryBasket->state;
        }
    }
  
    protected $rules = [
        'user_id' => 'required',
        'management' => 'required',
        'mounth' => 'nullable|max:100|min:2',
        'state' => 'required',
    ];
    public function submit()
    {
        $this->user_id = Auth()->User()->id;

        //Funcion para validar mediante las reglas
        $this->rules['management'] = 'required|unique:delivery_baskets,management,' . $this->DeliveryBasket->id;
        $this->validate();

        //Actualizar registro
        $this->DeliveryBasket->update([
            'user_id' => $this->user_id,
            'management' => $this->management,
           'mounth' => $this->mounth,
            'state' => $this->state,
        ]);
        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);
    }

    
}
