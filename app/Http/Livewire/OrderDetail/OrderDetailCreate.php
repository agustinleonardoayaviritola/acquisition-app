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
    public $state = 'ACTIVO';
    public $slug;
    public $orderdetails;
    public function mount($slug)
    {
        $this->order = Order::where('slug', $slug)->firstOrFail();
        $this->units = Unit::all()->where('state', 'ACTIVO');
    }
    public function render()
    {
        return view('livewire.order-detail.order-detail-create');
    }
    protected $rules = [
        'unit_id' => 'required',
        'quantity' => 'required',
        'price' => 'required',
        'subtotal' => 'required',
        'description' => 'required',
        'state' => 'required',
        'slug' => 'required',
    ];
    public function submit()
    {

        $this->subtotal = $this->price*$this->quantity;
        $this->validate();
        $this->order->update([
            'total' => $this->order->total + $this->subtotal,
        ]);
        OrderDetail::create([
            'order_id' =>  $this->order->id,
            'unit_id' => $this->unit_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'subtotal' => $this->subtotal,
            'description' => $this->description,
            'state' => $this->state,
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
    public function cleanInputs()
    {

        $this->unit_id = '';
        $this->name = '';
        $this->quantity = '';
        $this->price = '';
        $this->subtotal = '';
        $this->description = '';

    }
    protected $listeners = [
        'confirmed',
    ];

    public function showInfoUnit()
    {
        $this->units = Unit::all();
    }
    public function confirmed()
    {
        return redirect()->route('order-detail.dashboard', [$this->order->slug]);
    }
}
