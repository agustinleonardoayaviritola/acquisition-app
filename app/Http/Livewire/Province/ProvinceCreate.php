<?php

namespace App\Http\Livewire\Province;

use Livewire\Component;
use App\Models\Province;
use App\Models\Department;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProvinceCreate extends Component
{
    use LivewireAlert;
    //province
    public $name;
    public $description;
    public $state = 'ACTIVE';
    public $department_id;
    public function mount()
    {
        $this->departments = Department::all();
    }

    public function render()
    {
        return view('livewire.province.province-create');
    }
    protected $rules = [
        //restriccion province
        'name' => 'required|max:255|min:2|unique:professions,name',
        'description' => 'nullable',
        'state' => 'required',

    ];
    //Metodo que llama el formulario
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->validate();

        $Province = Province::create([
            'name' => strtoupper($this->name),
            'department_id' => $this->department_id,
            'description' => $this->description,
            //encriptando slug
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
    //Funcion para limpiar imputs
    public function cleanInputs()
    {
        $this->name = "";
        $this->description = "";
        $this->department_id="";
    }
    public function onChangeSelectDepartment()
    {
        $this->departments = Department::all();
    }
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];
    //Funcion que llama la alerta para redigir al dashboar
    public function confirmed()
    {
        return redirect()->route('province.dashboard');
    }
}

