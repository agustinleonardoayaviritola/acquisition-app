<?php

namespace App\Http\Livewire\RequestingUnit;

use Livewire\Component;
use App\Models\RequestingUnit;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RequestingUnitUpdate extends Component
{
    use LivewireAlert; 
    public function render()
    {
        return view('livewire.requesting-unit.requesting-unit-update');
    }

    public function mount($slug)
    {
        $this->requestingunit = RequestingUnit::where('slug', $slug)->firstOrFail();
        if ($this->requestingunit) {
            $this->name = $this->requestingunit->name;
            $this->state = $this->requestingunit->state;
        }
    }
  
    protected $rules = [
        'name' => 'required|max:100|min:2|unique:requesting_units,name',
        //'description' => 'nullable|max:100|min:2',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['name'] = 'required|unique:requesting_units,name,' . $this->requestingunit->id;
        $this->validate();

        //Actualizar registro
        $this->requestingunit->update([
            'name' => $this->name,
           // 'description' => $this->description,
            'state' => $this->state,
        ]);
        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);
    }
}
