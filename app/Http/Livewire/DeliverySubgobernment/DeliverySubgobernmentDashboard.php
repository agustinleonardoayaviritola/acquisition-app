<?php

namespace App\Http\Livewire\DeliverySubgobernment;

use Livewire\Component;
use App\Models\MunicipalityBasket;
use App\Models\Subgovernment;
use App\Models\Delivery;

class DeliverySubgobernmentDashboard extends Component
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
        return view('livewire.delivery-subgobernment.delivery-subgobernment-dashboard');
    }
}
