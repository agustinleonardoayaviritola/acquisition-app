<?php

namespace App\Http\Livewire\BasketSubgobernment;

use Livewire\Component;
use App\Models\Basket;
use App\Models\Product;
use App\Models\Subgovernment;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BasketSubgobernmentCreate extends Component
{

    use LivewireAlert; 
    public $code;
    public $description;
    public $name;
    public $state = "ACTIVE";
    public $slug;
   
    public function render()
    {
        return view('livewire.basket-subgobernment.basket-subgobernment-create');
    }

    protected $rules = [
        'name' => 'required',
        'state' => 'required',
    ];

    public function submit()
    {

        $this->validate();
        $this->DataPoint = Subgovernment::where('slug', auth()->user()->subgovernment_code)->first();

        Basket::create([
            'user_id' => Auth()->User()->id,
            'code' => Str::uuid(),            
            'name' => $this->name,
            'description' => $this->description,
            'subgovernment_code' => auth()->user()->subgovernment_code,
            'municipality_id' => $this->DataPoint->municipality_id,
            'state' => $this->state,
            'slug' => Str::uuid(),
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
        
        $this->description = "";
        $this->name = "";

    }
    
    protected $listeners = [
        'confirmed',
    ];

    public function confirmed()
    {
        return redirect()->route('basket-subgobernment.dashboard');
    }

}
