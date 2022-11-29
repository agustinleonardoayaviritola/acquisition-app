<?php

namespace App\Http\Livewire\SupplierCategory;

use Livewire\Component;
use App\Models\BeneficiaryState;
use App\Models\SupplierCategory;

use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SupplierCategoryCreate extends Component
{
    use LivewireAlert; 
    //varibles para propiedades
    public $name;
    public $description;
    public $state = "ACTIVO";
    public $slug;


    public function render()
    {
        return view('livewire.supplier-category.supplier-category-create');
    }
    protected $rules = [
        'name' => 'required|max:100|min:2|unique:supplier_categories,name',
        'state' => 'required',
    ];

    //Metodo que llama el formulario
    public function submit()
    {

        //Funcion para validar mediante las reglas
        $this->validate();

        //Creando registro
        SupplierCategory::create([
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
        return redirect()->route('supplier-category.dashboard');
    }
}
