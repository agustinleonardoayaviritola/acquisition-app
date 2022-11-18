<?php

namespace App\Http\Livewire\Order;

use App\Models\OrderType;
use App\Models\OrderCode;
use App\Models\RequestingUnit;
use App\Models\Supplier;
use Livewire\Component;
use App\Models\Order;
use App\Models\OrderDetail;
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
    public $state = "ACTIVE";
    public $total;

    public $suppliers;
    public $supplier_id;
    public $supplier;

    public $order_types;
    public $order_type_id;
    public $order_type;

    public $order_codes;
    public $order_code_id;
    public $order_code;

    public $requesting_units;
    public $requesting_unit_id;
    public $requesting_unit;

    public $cart;

    public $cart_session_ = [];

    public function mount()
    {
        $this->suppliers = Supplier::all()->where('state', 'ACTIVE');
        $this->order_types = OrderType::all()->where('state', 'ACTIVE');
        $this->order_codes = OrderCode::all()->where('state', 'ACTIVE');
        $this->requesting_units = RequestingUnit::all()->where('state', 'ACTIVE');
        //Limpiando carrito
        session()->forget('cart');

        //$this->cart_session_ = session()->get('cart');
    }
    public function render()
    {
        return view('livewire.order.order-create');
    }
    protected $rules = [
        'state' => 'required',
    ];
    //Metodo que llama el formulario
    public function submit()
    {

        //Funcion para validar mediante las reglas
        $this->validate();
        $this->order = Order::create([
            'supplier_id' => $this->supplier_id,
            'order_type_id' => $this->order_type_id,
            'order_code_id' => $this->order_code_id,
            'requesting_unit_id' => $this->requesting_unit_id,
            'application_number' => $this->application_number,
            'issue_date' => $this->issue_date,
            'delivery_time' => $this->delivery_time,
            'observation' => $this->observation,
            'state' => $this->state,
            'total' => 0,
            'slug' => Str::uuid(),
            'state' => 'ACTIVE',
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
    public function showInfoSupplier()
    {
        $this->suppliers = Supplier::all();
    }
    public function onChangeSelectOrderTypes()
    {
        $this->order_types = OrderType::all();
    }
    public function onChangeSelectOrderCodes()
    {
        $this->order_codes = OrderCode::all();
    }
    public function onChangeSelectRequestingUnits()
    {
        $this->requesting_units = RequestingUnit::all();
    }
}
