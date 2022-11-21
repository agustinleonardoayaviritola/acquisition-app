<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;
use App\Models\Order;
use App\Models\Person;
use App\Models\Supplier;
use App\Models\Telephone;
use App\Models\OrderDetail;
use App\Models\Unit;
use \NumberFormatter;
class OrderPrint extends Component
{
    public $orden;
    public $literal;
    public function render()
    {
        return view('livewire.order.order-print');
    }
    public function mount($slug)
    {
        $this->orden = Order::where('slug', $slug)->firstOrFail();
        $this->supplier = Supplier::where('id', $this->orden->supplier_id)->firstOrFail();
        $this->person = Person::where('id', $this->supplier->person_id)->firstOrFail();
        $this->telephone = Telephone::where('person_id', $this->person->id)->firstOrFail();
        $this->orden_detail = OrderDetail::where('order_id', $this->orden->id)->get();
        $this->unidad = Unit::where('id', $this->orden_detail[0]->unit_id)->firstOrFail();
        $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        $this->literal = $formatterES->format($this->orden->total);
        
    }


}
