<?php

namespace App\Http\Livewire\BeneficiaryState;

use Livewire\Component;
use App\Models\BeneficiaryState;
use App\Models\User;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BeneficiaryStateUpdate extends Component
{
    use LivewireAlert; 


    public function render()
    {
        return view('livewire.beneficiary-state.beneficiary-state-update');
    }

    public function mount($slug)
    {
        $this->BeneficiaryState = BeneficiaryState::where('slug', $slug)->firstOrFail();
        if ($this->BeneficiaryState) {
            $this->name = $this->BeneficiaryState->name;
            $this->description = $this->BeneficiaryState->description;
            $this->state = $this->BeneficiaryState->state;
        }
    }
    protected $rules = [
        'name' => 'required|max:100|min:2|unique:beneficiary_states,name',
        'state' => 'required',
    ];
    public function submit()
    {

        //Funcion para validar mediante las reglas
        $this->rules['name'] = 'required|unique:beneficiary_states,name,' . $this->BeneficiaryState->id;
        $this->validate();

        //Actualizar registro
        $this->BeneficiaryState->update([
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

