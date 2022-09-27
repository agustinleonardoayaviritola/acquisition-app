<?php

namespace App\Http\Livewire\DeliveryPoint;

use App\Models\DeliveryPoint;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class DeliveryPointUpdate extends Component
{

    //Using de alert
    use LivewireAlert;

    //varibles para propiedades
    public $name;
    public $description;
    public $state;


    public function render()
    {
        return view('livewire.delivery-point.delivery-point-update');
    }

    public function mount($slug)
    {
        $this->DeliveryPoint = DeliveryPoint::where('slug', $slug)->firstOrFail();
        if ($this->DeliveryPoint) {
            $this->name = $this->DeliveryPoint->name;
            $this->description = $this->DeliveryPoint->description;
            $this->state = $this->DeliveryPoint->state;
        }
    }
  
    protected $rules = [
        'name' => 'required|max:100|min:2|unique:delivery_points,name',
        'description' => 'nullable|max:100|min:2',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['name'] = 'required|unique:delivery_points,name,' . $this->DeliveryPoint->id;
        $this->validate();

        //Actualizar registro
        $this->DeliveryPoint->update([
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
