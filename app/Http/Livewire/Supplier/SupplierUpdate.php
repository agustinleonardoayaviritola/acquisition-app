<?php

namespace App\Http\Livewire\Supplier;

use Livewire\Component;
use App\Models\SupplierCategory;
use App\Models\Supplier;
use App\Models\Person;
use App\Models\Telephone;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class SupplierUpdate extends Component
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
    public $slug;

    public $supplier;
    public $person;
    public $telephone;
    public $suppliercategories;

    public function render()
    {
        return view('livewire.supplier.supplier-update');
    }

    public function mount($slug)
    {
        $this->suppliercategories = SupplierCategory::all();

        $this->supplier = Supplier::where('slug', $slug)->firstOrFail();
        $this->person = Person::where('id', $this->supplier->person_id)->firstOrFail();
        $this->telephone = Telephone::where('person_id', $this->person->id)->firstOrFail();

        if ($this->supplier) {
            $this->supplier_category_id = $this->supplier->supplier_category_id;
            $this->name = $this->person->name;
            $this->lastname = $this->person->lastname;
            $this->number = $this->telephone->number;
            $this->name_supplier = $this->supplier->name;
            $this->email = $this->supplier->email;
            $this->address = $this->supplier->address;
            $this->state = $this->supplier->state;
        }
    }
    //reglas para validacion
    protected $rules = [
        'supplier_category_id' => 'required',
        'number' => 'required',
        'name' => 'required',
        'lastname' => 'required',
        'name_supplier' => 'required',
        'email' => 'required',
        'address' => 'required',
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

        $this->supplier->update([
            'person_id' => $this->person->id,
            'supplier_category_id' => $this->supplier_category_id,
            'name' => $this->name_supplier,
            'email' => $this->email,
            'address' => $this->address,
            'state' => $this->state,
        ]);
        
         //Llamando Alerta
         $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);
        
    }

    public function onChangeSelectSupplierCategories()
    {
        $this->suppliercategories = SupplierCategory::all();
    }

    protected $listeners = [
        'confirmed',
    ];
}
