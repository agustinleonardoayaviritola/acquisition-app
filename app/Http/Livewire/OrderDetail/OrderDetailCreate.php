<?php

namespace App\Http\Livewire\OrderDetail;

use Livewire\Component;
use App\Models\OrderDetail;
use App\Models\Unit;
use App\Models\Order;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OrderDetailCreate extends Component
{
    use LivewireAlert; 
    public $order;

    public $units;
    public $unit_id;
    public $name;
    public $quantity;
    public $price;
    public $subtotal;
    public $description;
    public $state = 'ACTIVE';
    public $slug;
    public $orderdetails;
    public function mount($slug)
    {
        $this->order = Order::where('slug', $slug)->firstOrFail();
        $this->units = Unit::all()->where('state', 'ACTIVE');
    }
    public function render()
    {
        return view('livewire.order-detail.order-detail-create');
    }
    protected $rules = [
        'unit_id' => 'required', 
        'name' => 'required', 
        'quantity' => 'required', 
        'price' => 'required', 
        'subtotal' => 'required', 
        'description' => 'required', 
        'state' => 'required', 
        'slug' => 'required', 
    ];
    public function submit()
    {
        //calcular subtotal
        $this->subtotal = $this->price*$this->quantity;
        
        $this->validate();
        $this->order->update([
            'total' => $this->order->total + $this->subtotal,
        ]);
        //Creando registro
        OrderDetail::create([
            'order_id' =>  $this->order->id,
            'unit_id' => $this->unit_id,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'subtotal' => $this->subtotal,
            'description' => $this->description,
            'state' => $this->state,
            //encriptando slug
            'slug' =>  Str::uuid(),

            'state' => $this->state,
        ]);

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

    //Funcion para limpiar imputs
    public function cleanInputs()
    {
        $this->order_id = ''; 
        $this->unit_id = ''; 
        $this->name = ''; 
        $this->quantity = ''; 
        $this->price = ''; 
        $this->subtotal = ''; 
        $this->description = ''; 
       
    } 
    
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    public function showInfoUnit()
    {
        $this->units = Unit::all();
    }
    //Funcion que llama la alerta para redigir al dashboar
    public function confirmed()
    {
        return redirect()->route('order-detail.dashboard', [$this->order->slug]);
    }
}
