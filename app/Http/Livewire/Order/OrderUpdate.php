<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\Applicant;
use App\Models\OrderType;
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
    public function mount($slug)
    {
        $this->order = Order::where('slug', $slug)->firstOrFail();
        if ($this->order) {
            $this->supplier_id =$this->order->supplier_id ;
            $this->order_type_id =$this->order->order_type_id;
            $this->code =$this->order->code;
            $this->applicant_id =$this->order->applicant_id;
            $this->application_number =$this->order->application_number;
            $this->issue_date =$this->order->issue_date;
            $this->delivery_time =$this->order->delivery_time;
            $this->observation =$this->order->observation;
            $this->state = $this->order->state;
            $this->suppliers = Supplier::all()->where('state', 'ACTIVE');
            $this->order_types = OrderType::all()->where('state', 'ACTIVE');
            $this->applicants = Applicant::all()->where('state', 'ACTIVE');
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


        //Actualizar registro
        $this->order->update([
            'supplier_id' => $this->supplier_id,
            'order_type_id' => $this->order_type_id,
            'code' => $this->code,
            'applicant_id' => $this->applicant_id,
            'application_number' => $this->application_number,
            'issue_date' => $this->issue_date,
            'delivery_time' => $this->delivery_time,
            'observation' => $this->observation,
            'state' => $this->state,
        ]);
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
        $this->applicants = Applicant::all();
    }
}
