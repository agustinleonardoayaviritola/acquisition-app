<?php

namespace App\Http\Livewire\ProductSubgovernment;

use Livewire\Component;
use App\Models\Product;
use App\Models\Subgovernment;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductSubgovernmentCreate extends Component
{
    use LivewireAlert;
    public $name;
    public $amount;
    public $description;
    public $state = 'ACTIVE';

    public function render()
    {
        return view('livewire.product-subgovernment.product-subgovernment-create');
    }
    protected $rules = [
        'name' => 'required|max:255|min:5',
        'description' => 'nullable',
        'state' => 'required',

    ];
    public function submit()
    {
        $this->validate();
        $this->DataPoint = Subgovernment::where('slug', auth()->user()->subgovernment_code)->first();
        $Product = Product::create([
            'user_id' => Auth()->User()->id,
            'name' => $this->name,
            'amount' => $this->amount,
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
    }
    protected $listeners = [
        'confirmed',
    ];
    public function confirmed()
    {
        return redirect()->route('product-subgovernment.dashboard');
    }
}
