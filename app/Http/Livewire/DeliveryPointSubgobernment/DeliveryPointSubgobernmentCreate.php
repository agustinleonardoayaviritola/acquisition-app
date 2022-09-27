<?php

namespace App\Http\Livewire\DeliveryPointSubgobernment;

use App\Models\DeliveryPoint;
use App\Models\User;
use App\Models\Subgovernment;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class DeliveryPointSubgobernmentCreate extends Component
{
    
    //Using de alert
    use LivewireAlert;

    //varibles para propiedades
    public $name;
    public $description;
    public $slug;
    public $state = "ACTIVE";

    public function render()
    {
        return view('livewire.delivery-point-subgobernment.delivery-point-subgobernment-create');
    }
    //reglas para validacion
    protected $rules = [
        'name' => 'required',     
        'state' => 'required',
    ];

    public $DataPoint;
    public function submit()
    {
        $this->validate();
        
        $this->DataPoint = Subgovernment::where('slug', auth()->user()->subgovernment_code)->first();

        DeliveryPoint::create([
            'user_id' => auth()->user()->id,
            'name' => $this->name,
            'description' => $this->description,
            'subgovernment_code' => auth()->user()->subgovernment_code,
            'municipality_id' => $this->DataPoint->municipality_id,
            'slug' => Str::uuid(),
            'state' => $this->state,
        ]);

        $this->cleanInputs();

        $this->confirm('Registro creado correctamente', [
            'icon' => 'success',
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'showCancelButton' => false,
            'cancelButtonText' => 'Cancelar',
            'confirmButtonText' => 'Aceptar',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function cleanInputs()
    {
        $this->name = "";
        $this->description = "";
        $this->state = "ACTIVE";
    }

    protected $listeners = [
        'confirmed',
    ];

    public function confirmed()
    {
        return redirect()->route('delivery-point-subgobernment.dashboard');
    }

}
