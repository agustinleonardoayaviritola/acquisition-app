<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\Subgovernment;
use App\Models\Delivery;
use App\Models\User;
use App\Models\Person;
use App\Models\DeliveryPoint;
use App\Models\DeliveryBasket;
use App\Models\MunicipalityBasket;
use DB;
use Carbon\Carbon;


class ReportByUser extends Component
{
    public $start_date;
    public $end_date;
    public $subgovernment_id;
    public $management;
    public $delivery_id;
    ///
    public $deliverydetails;
    public $datadelliverybaskets;
    public $datasubgoverment;
    ///
    public $start;
    public $end;
    public $total;
    public function render()
    {
        return view('livewire.report.report-by-user');
    }
    public function mount()
    {
        $this->subgovernments = Subgovernment::all();
        $this->getDeliveryDetails();
        
    }
    public function updatedmanagement()
    {
        $this->getDeliveryDetails();
    }
    public function getDeliveryDetails()
    {        
        if($this->management != '') {
            if( $this->subgovernment_id != '') {
                $this->datasubgoverment = Subgovernment::where('id', $this->subgovernment_id)->firstOrFail();
                $this->deliverydetails = MunicipalityBasket::where('management', $this->management)->where('subgovernment_code', $this->datasubgoverment->slug)->get();

            }
            else {

            }
        } else {

        }
    }
    protected $rules = [
        'subgovernment_id' => 'required',
        'management' => 'required',
        'delivery_id' => 'required',
    ];
    protected $messages = [
        'subgovernment_id.required' => 'El campo Sub gobernación es obligatorio.',
        'management.required' => 'El campo Gestión es obligatorio.',
        'delivery_id.required' => 'El campo Entrega es obligatorio.',
    ];
    public function submit()
    {
        $this->validate();
        $this->start = Carbon::createFromFormat('Y-m-d\TH:i',$this->start_date);
        $this->end = Carbon::createFromFormat('Y-m-d\TH:i',$this->end_date);
        $this->subgoverment = Subgovernment::where('id', $this->subgovernment_id)->firstOrFail();
        $this->dataMunicipalityBasket =MunicipalityBasket::where('management', $this->management)->where('subgovernment_code', $this->datasubgoverment->slug)->firstOrFail();
        $this->datadelivery = Delivery::where('municipality_basket_id', $this->delivery_id)->firstOrFail();
        $this->datadelliverybaskets = DeliveryBasket::where('delivery_id', $this->datadelivery->id)->whereBetween('delivery_baskets.created_at', [$this->start_date, $this->end_date])->get();
        $this->usersdata = Person::join('users', 'people.id', '=', 'users.person_id')
        ->join('delivery_baskets', 'users.id', '=', 'delivery_baskets.user_id')
        ->join('delivery_points', 'delivery_baskets.delivery_point_id', '=', 'delivery_points.id')
        ->where('users.state', 'ACTIVE')
        ->where('delivery_baskets.delivery_id', $this->datadelivery->id)
        ->whereBetween('delivery_baskets.created_at', [$this->start_date, $this->end_date])
        ->where('users.subgovernment_code', $this->datasubgoverment->slug)
        ->groupBy('people.id', 'delivery_points.name')
        ->get(['people.name','people.lastname AS beneficiary_surname', 'delivery_points.name AS collection_point', DB::raw('COUNT(delivery_baskets.user_id) as baskets_delivered')]);   
        $this->total = $this->datadelliverybaskets->count();     
    }
    public function onChangeSelectSubgovernment()
    {
        $this->subgovernments = Subgovernment::all();
    }
}
