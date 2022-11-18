<?php

namespace App\Http\Livewire\Applicant;

use Livewire\Component;
use App\Models\RequestingUnit;
use App\Models\Applicant;
use App\Models\Person;
use App\Models\Telephone;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class ApplicantUpdate extends Component
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
    public $slug;

    public $supplier;
    public $person;
    public $telephone;
    public $requestingunits;

    public function render()
    {
        return view('livewire.applicant.applicant-update');
    }

    public function mount($slug)
    {
        $this->requestingunits = RequestingUnit::all();

        $this->applicant = Applicant::where('slug', $slug)->firstOrFail();
        $this->person = Person::where('id', $this->applicant->person_id)->firstOrFail();
        $this->telephone = Telephone::where('person_id', $this->person->id)->firstOrFail();

        if ($this->applicant) {
            $this->requesting_unit_id = $this->applicant->requesting_unit_id;
            $this->name = $this->person->name;
            $this->lastname = $this->person->lastname;
            $this->number = $this->telephone->number;
            $this->state = $this->applicant->state;
        }
    }
    //reglas para validacion
    protected $rules = [
        'requesting_unit_id' => 'required',
        'number' => 'required',
        'name' => 'required',
        'lastname' => 'required',
        'state' => 'required',

    ];

    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->validate();

        $this->person->update([
            'name' => $this->name,
            'lastname' => $this->lastname,
        ]);

        $this->telephone->update([
            'person_id' => $this->person->id,
            'number' => $this->number,
        ]);

        $this->applicant->update([
            'person_id' => $this->person->id,
            'requesting_unit_id' => $this->requesting_unit_id,
            'state' => $this->state,
        ]);
        
         //Llamando Alerta
         $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);
        
    }

    public function onChangeSelectRequistinUnit()
    {
        $this->requestingunits = RequestingUnit::all();
    }

    protected $listeners = [
        'confirmed',
    ];
}
