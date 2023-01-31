<?php

namespace App\Http\Livewire\Order;

use App\Models\OrderType;
use App\Models\RequestingUnit;
use App\Models\Person;
use App\Models\Supplier;
use Livewire\Component;
use App\Models\Order;
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
        'code' => 'required|max:100|min:2',
        'application_number' => 'required|max:100|min:2|unique:orders,application_number',
        'state' => 'required',
    ];
    //Metodo que llama el formulario
    public function submit()
    {

        $this->validate();
        $this->order = Order::create([
            'supplier_id' => $this->supplier_id,
            'order_type_id' => $this->order_type_id,
            'user_id' => Auth()->User()->id,
            'code' =>  $this->code,
            'requesting_unit_id' => $this->requestingunit_id,
            'application_number' => $this->application_number,
            'issue_date' => $this->issue_date,
            'delivery_time' => $this->delivery_time,
            'observation' => $this->observation,
            'state' => $this->state,
            'total' => 0,
            'slug' => Str::uuid(),
            'state' => 'PENDIENTE',
        ]);

        //Llamando a funcion para limpiar inputs
        $this->cleanInputs();

        //Mostrar alerta de registro
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

    //Funcion para limpiar imputs
    public function cleanInputs()
    {
        $this->total = "";
    }

    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    //Funcion que llama la alerta para redigir al dashboar
    public function confirmed()
    {
        return redirect()->route('order.dashboard');
    }
/*     public function showInfoSupplier()
    {
        $this->suppliers = Supplier::all();
    } */
    public function onChangeSelectOrderTypes()
    {
        $this->order_types = OrderType::all();
    }
/*     public function onChangeSelectApplicants()
    {
        $this->applicants = Applicant::all();
    } */
}
