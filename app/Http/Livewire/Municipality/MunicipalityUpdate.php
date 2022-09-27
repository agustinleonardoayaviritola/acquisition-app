<?php

namespace App\Http\Livewire\Municipality;

use Livewire\Component;
use App\Models\Province;
use App\Models\Municipality;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MunicipalityUpdate extends Component
{
    use LivewireAlert; 
    public function render()
    {
        return view('livewire.municipality.municipality-update');
    }
    public function mount($slug)
    {
        $this->provinces = Province::all();
        $this->Municipality = Municipality::where('slug', $slug)->firstOrFail();
        if ($this->Municipality) {
            $this->province_id = $this->Municipality->province_id;
            $this->name = $this->Municipality->name;
            $this->description = $this->Municipality->description;
            $this->state = $this->Municipality->state;
        }
    }
    protected $rules = [

        'name' => 'required|max:100|min:2|unique:municipalities,name',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['name'] = 'required|unique:districts,name,' . $this->Municipality->id;
        $this->validate();

        //Actualizar registro
        $this->Municipality->update([
            'name' => $this->name,
            'province_id' => $this->province_id,
            'description' => $this->description,
            'state' => $this->state,
        ]);
        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);
         
    }
    public function onChangeSelectProvince()
    {
        $this->provinces = Province::all();
    }
    protected $listeners = [
        'confirmed',
    ];

}
