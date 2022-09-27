<?php

namespace App\Http\Livewire\CantonDistrict;
use App\Models\CantonDistrict;
use Illuminate\Support\Str;
use App\Models\Municipality;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CantonDistrictUpdate extends Component
{
    use LivewireAlert;
    public function render()
    {
        return view('livewire.canton-district.canton-district-update');
    }
    public function mount($slug)
    {
        $this->municipalities = Municipality::all();

        $this->CantonDistrict = CantonDistrict::where('slug', $slug)->firstOrFail();
        if ($this->CantonDistrict) {
            $this->municipality_id = $this->CantonDistrict->municipality_id;
            $this->name = $this->CantonDistrict->name;
            $this->type = $this->CantonDistrict->type;
            $this->description = $this->CantonDistrict->description;
            $this->state = $this->CantonDistrict->state;
        }
    }
  
    protected $rules = [

        'name' => 'required|max:100|min:2|unique:canton_districts,name',
        'description' => 'nullable|max:100|min:2',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['name'] = 'required|unique:canton_districts,name,' . $this->CantonDistrict->id;
        $this->validate();

        //Actualizar registro
        $this->CantonDistrict->update([
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'state' => $this->state,
        ]);
        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);

         
    }
    public function onChangeSelectMunicipality()
    {
        $this->municipalities = Municipality::all();
        
    }
}
