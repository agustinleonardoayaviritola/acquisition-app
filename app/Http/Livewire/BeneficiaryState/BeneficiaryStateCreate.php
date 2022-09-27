<?php

namespace App\Http\Livewire\BeneficiaryState;

use Livewire\Component;
use App\Models\BeneficiaryState;
use App\Models\User;

use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class BeneficiaryStateCreate extends Component
{
    use LivewireAlert; 
    //varibles para propiedades
    public $name;
    public $description;
    public $state = "ACTIVE";
    public $slug;


    public function render()
    {
        return view('livewire.beneficiary-state.beneficiary-state-create');
    }
    protected $rules = [
        'name' => 'required|max:100|min:2|unique:beneficiary_states,name',
        'state' => 'required',
    ];

    //Metodo que llama el formulario
    public function submit()
    {

        //Funcion para validar mediante las reglas
        $this->validate();

        //Creando registro
        BeneficiaryState::create([
            'user_id' => Auth()->User()->id,
            'name' => $this->name,
            'description' => $this->description,
            //generar slug
            'state' => $this->state,
            'slug' => Str::uuid(),
        ]);


        //Llamando a funcion para limpiar inputs
        $this->cleanInputs();

        //Mostrar alerta de registro
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

    //Funcion para limpiar imputs
    public function cleanInputs()
    {
        $this->name = "";
        $this->description = "";
    }
    
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    //Funcion que llama la alerta para redigir al dashboard
    public function confirmed()
    {
        return redirect()->route('beneficiary-state.dashboard');
    }
}


