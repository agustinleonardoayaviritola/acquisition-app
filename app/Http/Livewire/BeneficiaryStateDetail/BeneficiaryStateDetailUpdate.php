<?php

namespace App\Http\Livewire\BeneficiaryStateDetail;

use Livewire\Component;
use App\Models\BeneficiaryStateDetail;
use App\Models\User;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BeneficiaryStateDetailUpdate extends Component
{
    use LivewireAlert; 

    public $description;
    public $state;
    public $slug;

    public function render()
    {
        return view('livewire.beneficiary-state-detail.beneficiary-state-detail-update');
    }

    public function mount($slug)
    {
        $this->BeneficiaryStateDetail = BeneficiaryStateDetail::where('slug', $slug)->firstOrFail();
        if ($this->BeneficiaryStateDetail) {
            $this->description = $this->BeneficiaryStateDetail->description;
            $this->state = $this->BeneficiaryStateDetail->state;
        }
    }
  
    protected $rules = [

        'description' => 'nullable|max:100|min:2|unique:beneficiary_state_details,description',
        'state' => 'required',
    ];
    public function submit()
    {
        $this->rules['description'] = 'required|unique:beneficiary_state_details,description,' . $this->BeneficiaryStateDetail->id;
        $this->validate();

        //Actualizar registro
        $this->BeneficiaryStateDetail->update([
            'user_id' => Auth()->User()->id,
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
