<?php

namespace App\Http\Livewire\OrderCode;

use Livewire\Component;
use App\Models\OrderCode;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OrderCodeUpdate extends Component
{
    use LivewireAlert;
    public $ordercode;
    public $name;
    public $description;
    public $state;
    public function render()
    {
        return view('livewire.order-code.order-code-update');
    }
    public function mount($slug)
    {
        $this->ordercode = OrderCode::where('slug', $slug)->firstOrFail();
        if ($this->ordercode) {
            $this->name = $this->ordercode->name;
            $this->description = $this->ordercode->description;
            $this->state = $this->ordercode->state;
        }
    }
    protected $rules = [
        'name' => 'required|max:100|min:2|unique:supplier_categories,name',
        'state' => 'required',
    ];
    public function submit()
    {
        $this->rules['name'] = 'required|unique:supplier_categories,name,' . $this->Suppliercategory->id;
        $this->validate();

        $this->Suppliercategory->update([
            'user_id' => Auth()->User()->id,
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state,
        ]);
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);
    }
}
