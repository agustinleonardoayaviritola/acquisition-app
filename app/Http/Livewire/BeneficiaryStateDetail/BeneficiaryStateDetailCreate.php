<?php

namespace App\Http\Livewire\BeneficiaryStateDetail;

use Livewire\Component;
use App\Models\BeneficiaryStateDetail;
use App\Models\BeneficiaryState;
use App\Models\User;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BeneficiaryStateDetailCreate extends Component
{
    use LivewireAlert; 
    //varibles para propiedades
    public $description;
    public $state = "ACTIVE";
    public $beneficiary_state_id;
    public $BeneficiaryState;

    public function mount()
    {

        $this->BeneficiaryState = BeneficiaryState::where('slug', $this->slug)->firstOrFail();
        $this->beneficiarystates = BeneficiaryState::all();
    }
    public function render()
    {
        return view('livewire.beneficiary-state-detail.beneficiary-state-detail-create');
    }

    protected $rules = [
        'description' => 'required|max:100|min:2|unique:beneficiary_state_details,description',
        'state' => 'required',
    ];

    //Metodo que llama el formulario
    public function submit()
    {

        //Funcion para validar mediante las reglas
        $this->validate();

        //Creando registro
        BeneficiaryStateDetail::create([
            'user_id' => Auth()->User()->id,
            'beneficiary_state_id' => $this->BeneficiaryState->id,
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
        $this->beneficiary_state_id = "";
        $this->description = "";
    }
    
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    public function onChangeSelectBeneficiaryState()
    {
        $this->beneficiarystates = BeneficiaryState::all();
    }

    //Funcion que llama la alerta para redigir al dashboard
    public function confirmed()
    {
        return redirect()->route('beneficiary-state.dashboard');
    }




}
