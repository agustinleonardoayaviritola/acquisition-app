<?php

namespace App\Http\Livewire\NeighborhoodCommunity;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\NeighborhoodCommunity;
use App\Models\CantonDistrict;

use Livewire\Component;

class NeighborhoodCommunityCreate extends Component
{
    use LivewireAlert; 
    //varibles para propiedades
    public $name;
    public $type;
    public $description;
    public $canton_district_id;
    public $state = "ACTIVE";
    public $slug;
    public $cantondistricts;
    


    public function mount()
    {
        $this->cantondistricts = CantonDistrict::where('slug', $this->slug)->firstOrFail();
        //$this->CantonDistrict = CantonDistrict::all();
    }
    public function render()
    {
        return view('livewire.neighborhood-community.neighborhood-community-create');
    }

    protected $rules = [
        //'canton_district_id'=>'required',
        'name' => 'required|max:100|min:2|unique:canton_districts,name',
        //'description' => 'required|max:100|min:2|unique:neighborhood_communities,description',
        'state' => 'required',
        'type' => 'required',
    ];

    //Metodo que llama el formulario
    public function submit()
    {

        //Funcion para validar mediante las reglas
        $this->validate();

        //Creando registro
        NeighborhoodCommunity::create([
            'canton_district_id' => $this->cantondistricts->id,
            'name' => $this->name,
            'type' => $this->type,
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
        //$this->name = "";
        $this->canton_district_id = "";
        $this->description = "";
    }

   
    
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    public function onChangeSelectCantonDistrict()
    {
        $this->CantonDistricts = CantonDistrict::all();
    }

    //Funcion que llama la alerta para redigir al dashboard
    public function confirmed()
    {
        return redirect()->route('canton-district.dashboard');
    }




}
