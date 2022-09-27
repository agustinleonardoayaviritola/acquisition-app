<?php

namespace App\Http\Livewire\MunicipalityBasket;

use Livewire\Component;
use App\Models\BasketManagement;
use App\Models\MunicipalityBasket;
use App\Models\Subgovernment;
use App\Models\Delivery;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MunicipalityBasketUpdate extends Component
{
  

    use LivewireAlert;
     ///
    public $amount;
    public function render()
    {
        return view('livewire.municipality-basket.municipality-basket-update');
    }
    public function mount($slug)
    {
        $this->subgovernments = Subgovernment::all();
        $this->MunicipalityBasket = MunicipalityBasket::where('slug', $slug)->firstOrFail();
        $this->delivery = Delivery::where('municipality_basket_id', $this->MunicipalityBasket->id)->firstOrFail();
        if ($this->MunicipalityBasket) {
            $this->subgovernment_id = $this->MunicipalityBasket->subgovernment_id;
            $this->management = $this->MunicipalityBasket->management;
            $this->name = $this->MunicipalityBasket->name;
            $this->description = $this->MunicipalityBasket->description;
            $this->start_date = $this->MunicipalityBasket->start_date;
            $this->end_date = $this->MunicipalityBasket->end_date;
            $this->number_baskets = $this->MunicipalityBasket->number_baskets;
            $this->state = $this->MunicipalityBasket->state;
        }
    }
    protected $rules = [

        'description' => 'required',
        'number_baskets' => 'required',
        'state' => 'required',
    ];
    public function submit()
    {
        $this->validate();



        $this->MunicipalityBasket->update([
            'user_id' => Auth()->User()->id,
            'name' => $this->name,
            'description' => $this->description,
            'management' => $this->management,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'number_baskets' => $this->number_baskets,
            'number_baskets_total' => $this->number_baskets,
            'state' => $this->state,
        ]);

        $this->delivery->update([

            'number_baskets' => $this->number_baskets,
            'number_baskets_total' => $this->number_baskets,
        ]);





        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);     
    }
    public function onChangeSelectSubgovernment()
    {
        $this->subgovernments = Subgovernment::all();
    }
    protected $listeners = [
        'confirmed',
    ];
}
