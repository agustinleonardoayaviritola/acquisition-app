<?php

namespace App\Http\Livewire\Applicant;

use Livewire\Component;
use App\Models\Person;
use App\Models\Applicant;
use App\Models\RequestingUnit;
use App\Models\Telephone;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ApplicantCreate extends Component
{
    use LivewireAlert;

    //persona
    public $name;
    public $lastname;

    //theleponao
    public $number;
    public $person_id;

    //supplier
    public $requesting_unit_id;
    public $name_supplier;
    public $email;
    public $address;
    public $state = "ACTIVO";
    public $slug;

    public $person;
    public $telephone;
    public $requestingunits;

    public function mount()
    {
        $this->requestingunits = RequestingUnit::all()->where('state', 'ACTIVO');
    }
 
    //reglas para validacion
    protected $rules = [
        'requesting_unit_id' => 'required',
        'number' => 'required',
        'name' => 'required',
        'lastname' => 'required',
        'state' => 'required',

    ];

    //Metodo que llama el formulario
    public function submit()
    {

        //Funcion para validar mediante las reglas
        $this->validate();
        //Creando registro
        $this->person = Person::create([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'state' => 'ACTIVO',
            //generar slug
            'slug' => Str::uuid(),
        ]);
        $this->telephone = Telephone::create([
            'person_id' => $this->person->id,
            'number' => $this->number,
            'state' => 'ACTIVO',
        ]);
        Applicant::create([
            'person_id' => $this->person->id,
            'requesting_unit_id' => $this->requesting_unit_id,
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
        $this->lastname = "";
        $this->person_id = "";
        $this->requesting_unit_id = "";
    }

    public function onChangeSelectRequistinUnit()
    {
        $this->requestingunits = RequestingUnit::all();
    }

    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    public function render()
    {
        return view('livewire.applicant.applicant-create');
    }
    public function confirmed()
    {
        return redirect()->route('applicant.dashboard');
    }
}
