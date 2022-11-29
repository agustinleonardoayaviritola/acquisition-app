<?php

namespace App\Http\Livewire\Supplier;

use Livewire\Component;
use App\Models\Person;
use App\Models\Supplier;
use App\Models\SupplierCategory;
use App\Models\Telephone;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SupplierCreate extends Component
{
    use LivewireAlert;

    //persona
    public $name;
    public $lastname;

    //theleponao
    public $number;
    public $person_id;

    //supplier
    public $supplier_category_id;
    public $name_supplier;
    public $email;
    public $address;
    public $state = "ACTIVO";
    public $slug;

    public $person;
    public $telephone;
    public $suppliercategories;

    public function mount()
    {
        $this->suppliercategories = SupplierCategory::all()->where('state', 'ACTIVO');
    }

    public function render()
    {
        return view('livewire.supplier.supplier-create');
    }
 
    //reglas para validacion
    protected $rules = [
        'supplier_category_id' => 'required',
        'number' => 'required',
        'name' => 'required|max:100|min:2|unique:suppliers,name',
        'lastname' => 'required',
        'name_supplier' => 'required',
        'address' => 'required',
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
        Supplier::create([
            'person_id' => $this->person->id,
            'supplier_category_id' => $this->supplier_category_id,
            'name' => $this->name_supplier,
            'email' => $this->email,
            'address' => $this->address,
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
        $this->number = "";
        $this->person_id = "";
        $this->supplier_category_id = "";
        $this->name_supplier = "";
        $this->email = "";
        $this->address = "";
    }

    public function onChangeSelectSupplierCategories()
    {
        $this->suppliercategories = SupplierCategory::all();
    }

    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    //Funcion que llama la alerta para redigir al dashboard
    public function confirmed()
    {
        return redirect()->route('supplier.dashboard');
    }
}
