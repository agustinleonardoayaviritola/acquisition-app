<?php

namespace App\Http\Livewire\CantonDistrict;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\CantonDistrict;
use App\Models\Municipality;


use Livewire\Component;

class CantonDistrictCreate extends Component
{
    use LivewireAlert; 
    //varibles para propiedades
    public $name;
    public $type;
    public $description;
    public $municipality_id;
    
    public $state = "ACTIVE";
    public $slug;

    public function mount()
    {
        $this->municipalities = Municipality::all();
        
    }

    public function render()
    {
        return view('livewire.canton-district.canton-district-create');
    }
    protected $rules = [
        'name' => 'required|max:100|min:2|unique:canton_districts,name',
        'state' => 'required',
        'type' => 'required'
    ];

    //Metodo que llama el formulario
    public function submit()
    {

        //Funcion para validar mediante las reglas
        $this->validate();

        //Creando registro
        CantonDistrict::create([
            'municipality_id' => $this->municipality_id,
            'type'=> $this->type,
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
        $this-> municipality_id= "";
        $this->description = "";
    }
    
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    public function onChangeSelectMunicipality()
    {
        $this->municipalities = Municipality::all();
        
    }

    //Funcion que llama la alerta para redigir al dashboard
    public function confirmed()
    {
        return redirect()->route('canton-district.dashboard');
    }

}

