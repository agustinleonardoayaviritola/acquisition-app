<?php

namespace App\Http\Livewire\Municipality;

use Livewire\Component;
use App\Models\Province;
use App\Models\Municipality;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MunicipalityCreate extends Component
{
    use LivewireAlert; 
    //varibles para propiedades
    public $name;
    public $description;
    public $state = "ACTIVE";
    public $slug;
    public $province_id;
    public function mount()
    {
        $this->provinces = Province::all();
    }
    public function render()
    {
        return view('livewire.municipality.municipality-create');
    }
    protected $rules = [
        'province_id' => 'required',
        'name' => 'required|max:100|min:2|unique:districts,name',
        'state' => 'required',
    ];

        //Metodo que llama el formulario
        public function submit()
        {
    
            //Funcion para validar mediante las reglas
            $this->validate();
    
            //Creando registro
            Municipality::create([
                'province_id' => $this->province_id,
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
        $this->province_id = "";
    }
    public function onChangeSelectProvince()
    {
        $this->provinces = Province::all();
    }
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];
    
     //Funcion que llama la alerta para redigir al dashboard
     public function confirmed()
     {
         return redirect()->route('municipality.dashboard');
     }
}
