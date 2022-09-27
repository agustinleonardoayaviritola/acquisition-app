<?php

namespace App\Http\Livewire\BeneficiarySubgobernment;

use Livewire\Component;
use App\Models\MunicipalityBasket;
use App\Models\Subgovernment;
use App\Models\Delivery;
use App\Models\Setting;

class BeneficiarySubgobernmentDashboard extends Component
{
    public $deliverysubgobernment;
    public $slug_setting = '5db32257-0105-46f6-8519-9759ea997cde';
    public function mount()
    {
        $this->setting = Setting::where('slug', $this->slug_setting)->first();
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
        return view('livewire.beneficiary-subgobernment.beneficiary-subgobernment-dashboard');
    }
}
