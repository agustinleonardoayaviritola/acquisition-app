<?php

namespace App\Http\Livewire\Order;

use App\Models\OrderType;
use App\Models\RequestingUnit;
use App\Models\Person;
use App\Models\Supplier;
use Livewire\Component;
use App\Models\Order;
use App\Models\OrderCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OrderCreate extends Component
{
    use LivewireAlert;

    public $order;
    public $application_number;
    public $issue_date;
    public $delivery_time;
    public $observation;
    public $slug;
    public $state = "PENDIENTE";
    public $total;

    public $suppliers;
    public $supplier_id;
    public $supplier;

    public $order_types;
    public $order_type_id;
    public $order_type;

    public $code;

    public $requestingunits;
    public $requestingunit_id;
    public $requesting_unit;

    public $order_codes;
    public $order_code_id = 2;

    public function mount()
    {
        $this->suppliers = Supplier::all()->where('state', 'ACTIVO');
        $this->order_types = OrderType::all()->where('state', 'ACTIVO');
        $this->requestingunits = RequestingUnit::all()->where('state', 'ACTIVO');

    }
    public function render()
    {
        return view('livewire.order.order-create');
    }
    protected $rules = [
        'code' => 'required',
        'order_code_id' => 'required',
        'state' => 'required',
    ];
    public function submit()
    {
        $this->validate();


        if($this->delivery_time == 0) {
            $this->order = Order::create([
                'supplier_id' => $this->supplier_id,
                'order_type_id' => $this->order_type_id,
                'order_code_id' => $this->order_code_id,
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
            $this->order = Order::create([
                'supplier_id' => $this->supplier_id,
                'order_type_id' => $this->order_type_id,
                'order_code_id' => $this->order_code_id,
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
        $this->total = "";
    }
    protected $listeners = [
        'confirmed',
    ];
    public function confirmed()
    {
        return redirect()->route('order.dashboard');
    }
    public function onChangeSelectOrderTypes()
    {
        $this->order_types = OrderType::all()->where('state', 'ACTIVO');
    }


}
