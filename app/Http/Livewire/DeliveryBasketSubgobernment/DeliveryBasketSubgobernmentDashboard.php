<?php

namespace App\Http\Livewire\DeliveryBasketSubgobernment;

use Livewire\Component;
use App\Models\MunicipalityBasket;
use App\Models\Subgovernment;
use App\Models\Delivery;


class DeliveryBasketSubgobernmentDashboard extends Component
{
    public $deliverysubgobernment;
    public function mount()
    {
        

        $this->subgovernment = Subgovernment::where('slug', '=', auth()->user()->subgovernment_code)->firstOrFail();
        try {
            $this->deliverysubgobernment = MunicipalityBasket::where('subgovernment_code', '=', auth()->user()->subgovernment_code)->where('state', '=', 'ACTIVE')->firstOrFail();
        }
        catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function render()
    {
        return view('livewire.delivery-basket-subgobernment.delivery-basket-subgobernment-dashboard');
    }
}
