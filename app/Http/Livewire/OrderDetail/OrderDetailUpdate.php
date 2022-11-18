<?php

namespace App\Http\Livewire\OrderDetail;

use Livewire\Component;
use App\Models\Unit;
use App\Models\OrderDetail;
use App\Models\Order;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OrderDetailUpdate extends Component
{
    use LivewireAlert; 
    public $units;
    public $unit_id;
    public $quantity;
    public $price;
    public $subtotal;
    public $description;
    public $order;
    public $orderdetails;

    public function mount($slug)
    {
        $this->units = Unit::all()->where('state', 'ACTIVE');
        $this->orderdetail = OrderDetail::where('slug', $slug)->firstOrFail();
        if ($this->orderdetail) {
            $this->unit_id = $this->orderdetail->unit_id;
            $this->quantity = $this->orderdetail->quantity;
            $this->price = $this->orderdetail->price;
            $this->description = $this->orderdetail->description;
            $this->state = $this->orderdetail->state;
        }
    }
    
    protected $rules = [
        'state' => 'required',
    ];
    public function submit()
    {
        $this->validate();

        //calcular subtotal
        $this->subtotal = $this->price * $this->quantity;
        
        //Actualizar registro
        $this->orderdetail->update([
            'unit_id' => $this->unit_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'subtotal' => $this->subtotal,
            'description' => $this->description,
            'state' => $this->state,
        ]);
        
        $this->updatetotal($this->orderdetail->order_id);
        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);
    }
    public function updatetotal($order_id){
        //dd($order_id);
        $this->order = Order::where('id', $order_id)->firstOrFail();
        //dd($this->order);
        $this->orderdetails = OrderDetail::all()->where('order_id', $this->order->id);
        //dd($this->orderdetails);
        $this->order->total = 0;
        foreach ($this->orderdetails  as $valor) {
            //dd($valor);
            if ($valor->state == 'ACTIVE') {
                $this->order->total = $this->order->total + $valor->subtotal;
            }
        }
        $this->order->update([
            'total' => $this->order->total,
        ]);
    }
    public function showInfoUnit()
    {
        $this->units = Unit::all();
    }
}
