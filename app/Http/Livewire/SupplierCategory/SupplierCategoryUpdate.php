<?php

namespace App\Http\Livewire\SupplierCategory;

use Livewire\Component;
use App\Models\BeneficiaryState;
use App\Models\SupplierCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SupplierCategoryUpdate extends Component
{
    use LivewireAlert;
    public $Suppliercategory;
    public $name;
    public $description;
    public $state;

    public function render()
    {
        return view('livewire.supplier-category.supplier-category-update');
    }

    public function mount($slug)
    {
        $this->Suppliercategory = SupplierCategory::where('slug', $slug)->firstOrFail();
        if ($this->Suppliercategory) {
            $this->name = $this->Suppliercategory->name;
            $this->description = $this->Suppliercategory->description;
            $this->state = $this->Suppliercategory->state;
        }
    }
    protected $rules = [
        'name' => 'required|max:100|min:2|unique:supplier_categories,name',
        'state' => 'required',
    ];
    public function submit()
    {

        //Funcion para validar mediante las reglas
        $this->rules['name'] = 'required|unique:supplier_categories,name,' . $this->Suppliercategory->id;
        $this->validate();

        //Actualizar registro
        $this->Suppliercategory->update([
            'user_id' => Auth()->User()->id,
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state,
        ]);
        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);


    }
}
