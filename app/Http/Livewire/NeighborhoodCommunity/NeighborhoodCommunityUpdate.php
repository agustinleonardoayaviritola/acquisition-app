<?php

namespace App\Http\Livewire\NeighborhoodCommunity;

use Livewire\Component;
use App\Models\NeighborhoodCommunity;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class NeighborhoodCommunityUpdate extends Component
{
    use LivewireAlert; 

    public $description;
    public $state;
    public $slug;

    public function render()
    {
        return view('livewire.neighborhood-community.neighborhood-community-update');
    }

    public function mount($slug)
    {
        $this->NeighborhoodCommunity = NeighborhoodCommunity::where('slug', $slug)->firstOrFail();
        if ($this->NeighborhoodCommunity) {
            $this->name = $this->NeighborhoodCommunity->name;
            $this->description = $this->NeighborhoodCommunity->description;
            $this->state = $this->NeighborhoodCommunity->state;
            $this->type = $this->NeighborhoodCommunity->type;
        }
    }
  
    protected $rules = [

   
        'description' => 'nullable|max:100|min:2|unique:neighborhood_communities,description',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['description'] = 'required|unique:neighborhood_communities,description,' . $this->NeighborhoodCommunity->id;
        $this->validate();

        //Actualizar registro
        $this->NeighborhoodCommunity->update([
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state,
            'type' => $this->type,
        ]);
        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);

         
    }
}
