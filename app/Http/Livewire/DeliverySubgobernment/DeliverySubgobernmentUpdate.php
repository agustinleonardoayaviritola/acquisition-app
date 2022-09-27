<?php

namespace App\Http\Livewire\DeliverySubgobernment;

use App\Models\BasketManagement;
use App\Models\MunicipalityBasket;
use App\Models\Basket;
use App\Models\Delivery;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DeliverySubgobernmentUpdate extends Component
{
    use LivewireAlert;
    ///
    public $amount;
    public $amount_;
    public function render()
    {
        return view('livewire.delivery-subgobernment.delivery-subgobernment-update');
    }
    public function mount($slug)
    {
        $this->baskets = Basket::where('subgovernment_code', '=', auth()->user()->subgovernment_code)->where('state', 'ACTIVE')->get();

        $this->delivery = Delivery::where('slug', $slug)->firstOrFail();
        if ($this->delivery) {
            $this->municipality_basket_id = $this->delivery->municipality_basket_id;
            $this->basket_id = $this->delivery->basket_id;
            $this->description = $this->delivery->description;
            $this->month = $this->delivery->month;
            $this->number_baskets = $this->delivery->number_baskets;
            $this->end_date = $this->delivery->end_date;
            $this->start_date = $this->delivery->start_date;
            $this->state = $this->delivery->state;
        }
    }
    protected $rules = [
        
        'description' =>'required',
        'number_baskets' =>'required',
        'end_date' =>'required',
        'start_date' =>'required',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->validate();

        $this->basketmunicipality=MunicipalityBasket::where('id', $this->municipality_basket_id)->firstOrFail();
        
        $amount = $this->basketmunicipality->number_baskets;
        $amount_ = $amount + $this->delivery->number_baskets;

        if ($this->number_baskets > $amount_) {

            $this->confirm('La cantidad de canastas asignadas, no pude ser mayor a las que hay para la Gestión.', [
                'icon' => 'warning',
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'showCancelButton' => false,
                'confirmButtonText' => 'Aceptar',
            ]);
        }
        else {

            //Actualizar registro
            $this->delivery->update([
                'user_id' => Auth()->User()->id,
                'basket_id' => $this->basket_id,
                //'municipality_basket_id' => $this->municipality_basket_id,
                'description' => $this->description,
                'month' => $this->month,
                //'number_baskets' => $this->number_baskets,
                //'number_baskets_total' => $this->number_baskets,
                'end_date' => $this->end_date,
                'start_date' => $this->start_date,
                'state' => $this->state,
            ]);

            $amount_ = $amount_ - $this->number_baskets;
            $this->basketmunicipality->update([
                'number_baskets'=> $amount_,
            ]);
            //Llamando Alerta
            $this->alert('success', 'Registro actualizado correctamente', [
                'toast' => true,
                'position' => 'top-end',
            ]);

        }
    }

    public function onChangeSelectBasket()
    {
        $this->baskets = Basket::where('subgovernment_code', '=', auth()->user()->subgovernment_code)->where('state', 'ACTIVE')->get();
    }
    protected $listeners = [
        'confirmed',
    ];
}
