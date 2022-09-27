<?php

namespace App\Http\Livewire\MunicipalityBasket;

use Livewire\Component;
use App\Models\BasketManagement;
use App\Models\MunicipalityBasket;
use App\Models\Subgovernment;
use App\Models\Delivery;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MunicipalityBasketCreate extends Component
{
   
    use LivewireAlert; 
    public $number_baskets;
    public $name;
    public $management;
    public $description;
    public $start_date;
    public $end_date;
    public $state = "ACTIVE";
    public $slug;
    public $basket_management_id;
    public $subgovernment_id;
    ///
    public $amount;

    public function mount()
    {   
        $this->subgovernments = Subgovernment::all();
    }
    public function render()
    {
        return view('livewire.municipality-basket.municipality-basket-create');
    }
    protected $rules = [
        'subgovernment_id' => 'required',
        'description' => 'required',
        'start_date'=> 'required',
        'end_date'=> 'required',
        'number_baskets' => 'required',
        'state' => 'required',
    ];
        public function submit()
        {
            $this->validate();
            $this->subgovernment = Subgovernment::where('id', '=', $this->subgovernment_id)->firstOrFail();
            
            $MunicipalityBasket = MunicipalityBasket::create([
                'user_id' => Auth()->User()->id,
                'subgovernment_id' => $this->subgovernment_id,
                'subgovernment_code' => $this->subgovernment->slug,
                'name' => $this->name,
                'description' => $this->description,
                'management' => $this->management,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'number_baskets' => $this->number_baskets,
                'number_baskets_total' => $this->number_baskets,
                'number_baskets_delivered' => 0,
                //generar slug
                'state' => $this->state,
                'slug' => Str::uuid(),
            ]);

/*             $this->basketManagement=BasketManagement::where('id', $this->basket_management_id)->firstOrFail();
            $amount = $this->basketManagement->number_baskets;

            $this->basketManagement->update([
                'number_baskets'=> $amount - $this->number_baskets,
            ]); */
            
            Delivery::create([
                'user_id' => Auth()->User()->id,
                'municipality_basket_id' => $MunicipalityBasket->id,
                'description' => $this->description,
                'subgovernment_code' => $this->subgovernment->slug,
                'number_baskets' => $this->number_baskets,
                'number_baskets_total' => $this->number_baskets,
                'number_baskets_delivered' => 0,
                'end_date' => $this->end_date,
                'start_date' => $this->start_date,
                //generar slug
                'state' => $this->state,
                'slug' => Str::uuid(),
    
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

    public function cleanInputs()
    {
        $this->number_baskets = "";
        $this->description = "";
        
    }
    public function onChangeSelectSubgovernment()
    {
        $this->subgovernments = Subgovernment::all();
    }
    protected $listeners = [
        'confirmed',
    ];
     public function confirmed()
     {
         return redirect()->route('municipality-basket.dashboard');
     }
}

