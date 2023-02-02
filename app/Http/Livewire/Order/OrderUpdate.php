<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\Person;
use App\Models\OrderType;
use App\Models\RequestingUnit;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OrderUpdate extends Component
{
    use LivewireAlert;
    public $order;
    public $application_number;
    public $issue_date;
    public $delivery_time;
    public $observation;
    public $slug;
    public $state;
    public $total;

    public $suppliers;
    public $supplier_id;
    public $supplier;

    public $order_types;
    public $order_type_id;
    public $order_type;

    public $code;

    public $applicants;
    public $applicant_id;
    public $requesting_unit;

    public $requestingunit_id;
    public $requestingunits;
    public function mount($slug)
    {
        $this->suppliers = Supplier::all()->where('state', 'ACTIVO');
        $this->order_types = OrderType::all()->where('state', 'ACTIVO');
        $this->requestingunits = RequestingUnit::all()->where('state', 'ACTIVO');

        $this->order = Order::where('slug', $slug)->firstOrFail();
        if ($this->order) {
            $this->supplier_id =$this->order->supplier_id ;
            $this->order_type_id =$this->order->order_type_id;
            $this->code =$this->order->code;
            $this->issue_date =$this->order->issue_date;
            $this->delivery_time =$this->order->delivery_time;
            $this->observation =$this->order->observation;
            $this->state = $this->order->state;
            $this->suppliers = Supplier::all()->where('state', 'ACTIVO');
            $this->order_types = OrderType::all()->where('state', 'ACTIVO');
            $this->requestingunit_id =$this->order->requesting_unit_id;
            $this->application_number =$this->order->application_number;
        }
    }
    protected $rules = [
        'code' => 'required|max:15|min:4|unique:orders,code',
        'state' => 'required',
    ];
    public function submit()
    {
        $this->rules['code'] = 'required|unique:orders,code,' . $this->order->id;
        $this->validate();

        if($this->delivery_time == 0) {

            $this->order->update([
                'supplier_id' => $this->supplier_id,
                'order_type_id' => $this->order_type_id,
                'requesting_unit_id' => $this->requestingunit_id,
                'user_id' => Auth()->User()->id,
                'code' =>  $this->code,
                'application_number' => $this->application_number,
                'issue_date' => $this->issue_date,
                'delivery_time' => 'INMEDIATA',
                'observation' => $this->observation,
                'state' => $this->state,
                'total' => 0,
                'slug' => Str::uuid(),
                'state' => 'PENDIENTE',
            ]);
        }
        else {

            $this->order->update([
                'supplier_id' => $this->supplier_id,
                'order_type_id' => $this->order_type_id,
                'requesting_unit_id' => $this->requestingunit_id,
                'user_id' => Auth()->User()->id,
                'code' =>  $this->code,
                'application_number' => $this->application_number,
                'issue_date' => $this->issue_date,
                'delivery_time' => $this->delivery_time,
                'observation' => $this->observation,
                'state' => $this->state,
                'total' => 0,
                'slug' => Str::uuid(),
                'state' => 'PENDIENTE',
            ]);
        }

        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);
    }
    public function render()
    {
        return view('livewire.order.order-update');
    }
    public function showInfoSupplier()
    {
        $this->suppliers = Supplier::all();
    }
    public function onChangeSelectOrderTypes()
    {
        $this->order_types = OrderType::all();
    }
    public function onChangeSelectApplicants()
    {
        $this->applicants = Person::join('applicants', 'people.id', '=', 'applicants.person_id')
        ->where('applicants.state', 'ACTIVO')->get();
    }
}
