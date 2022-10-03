<?php

namespace App\Http\Livewire\Unit;

use App\Models\Unit;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UnitUpdate extends Component
{
    use LivewireAlert; 
    public function render()
    {
        return view('livewire.unit.unit-update');
    }

    public function mount($slug)
    {
        $this->unit = Unit::where('slug', $slug)->firstOrFail();
        if ($this->unit) {
            $this->name = $this->unit->name;
           // $this->description = $this->unit->description;
            $this->state = $this->unit->state;
        }
    }
  
    protected $rules = [
        'name' => 'required|max:100|min:2|unique:units,name',
        //'description' => 'nullable|max:100|min:2',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['name'] = 'required|unique:units,name,' . $this->unit->id;
        $this->validate();

        //Actualizar registro
        $this->unit->update([
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
