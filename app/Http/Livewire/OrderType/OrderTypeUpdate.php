<?php

namespace App\Http\Livewire\OrderType;

use App\Models\OrderType;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OrderTypeUpdate extends Component
{
    use LivewireAlert; 
    public function render()
    {
        return view('livewire.order-type.order-type-update');
    }

    public function mount($slug)
    {
        $this->ordertype = OrderType::where('slug', $slug)->firstOrFail();
        if ($this->ordertype) {
            $this->name = $this->ordertype->name;
           $this->description = $this->ordertype->description;
            $this->state = $this->ordertype->state;
        }
    }
  
    protected $rules = [
        'name' => 'required|max:100|min:2|unique:order_types,name',
        //'description' => 'nullable|max:100|min:2',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['name'] = 'required|unique:order_types,name,' . $this->ordertype->id;
        $this->validate();

        //Actualizar registro
        $this->ordertype->update([
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
