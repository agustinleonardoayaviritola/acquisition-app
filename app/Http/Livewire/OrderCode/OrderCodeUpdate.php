<?php

namespace App\Http\Livewire\OrderCode;

use Livewire\Component;
use App\Models\OrderCode;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OrderCodeUpdate extends Component
{
    use LivewireAlert; 
    public function render()
    {
        return view('livewire.order-code.order-code-update');
    }

    public function mount($slug)
    {
        $this->ordercode = OrderCode::where('slug', $slug)->firstOrFail();
        if ($this->ordercode) {
            $this->name = $this->ordercode->name;
           // $this->description = $this->unit->description;
            $this->state = $this->ordercode->state;
        }
    }
  
    protected $rules = [
        'name' => 'required|max:100|min:2|unique:order_codes,name',
        //'description' => 'nullable|max:100|min:2',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['name'] = 'required|unique:order_codes,name,' . $this->ordercode->id;
        $this->validate();

        //Actualizar registro
        $this->ordercode->update([
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
