<?php

namespace App\Http\Livewire\Profession;

use Livewire\Component;
use App\Models\Profession;
use Illuminate\Support\Str;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProfessionUpdate extends Component
{
    use LivewireAlert;
    //profession
    public $name;
    public $description;
    public $state;

    public function mount($slug)
    {
        
        $this->profession = Profession::where('slug', $slug)->firstOrFail();
        if ($this->profession) {
            //cargando datos del profession
            $this->name = $this->profession->name;
            $this->description = $this->profession->description;
            $this->state = $this->profession->state;
        }
    }
    public function render()
    {
        return view('livewire.profession.profession-update');
    }
    protected $rules = [
        //restriccion profession
        'name' => 'required|max:255|min:2|unique:professions,name',
        'description' => 'nullable',
        'state' =>'required',

    ];
    public function submit()
    {
        $this->rules['name'] = 'required|unique:professions,name,' . $this->profession->id;
        $this->validate();

        $this->profession->update([
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
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];
    //Funcion que llama la alerta para redigir al dashboar
    public function confirmed()
    {
        return redirect()->route('profession.dashboard');
    }


}
