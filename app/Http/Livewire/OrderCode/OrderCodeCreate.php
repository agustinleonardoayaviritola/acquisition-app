<?php

namespace App\Http\Livewire\OrderCode;

use Livewire\Component;
use App\Models\OrderCode;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OrderCodeCreate extends Component
{
    use LivewireAlert;
    public $name;
    public $description;
    public $state = "ACTIVO";
    public $slug;
    public function render()
    {
        return view('livewire.order-code.order-code-create');
    }
    protected $rules = [
        'name' => 'required|max:100|min:2|unique:supplier_categories,name',
        'state' => 'required',
    ];

    public function submit()
    {
        $this->validate();
        OrderCode::create([
            'user_id' => Auth()->User()->id,
            'name' => $this->name,
            'description' => $this->description,
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
        $this->name = "";
        $this->description = "";
    }
    protected $listeners = [
        'confirmed',
    ];
    public function confirmed()
    {
        return redirect()->route('order-code.dashboard');
    }
}
