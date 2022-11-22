<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;
use App\Models\Order;
use App\Models\Person;
use App\Models\Supplier;
use App\Models\Telephone;
use App\Models\OrderDetail;
use App\Models\Applicant;
use App\Models\Unit;
use App\Models\User;
use App\Models\RequestingUnit;
use App\Models\OrderType;
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
        $this->orden_type = OrderType::where('id', $this->orden->order_type_id)->firstOrFail();

        $this->user = User::where('id', $this->orden->user_id)->firstOrFail();
        $this->peson_user = Person::where('id', $this->user->person_id)->firstOrFail();

        $this->applicant = Applicant::where('id', $this->orden->applicant_id)->firstOrFail();
        $this->peson_applicant = Person::where('id', $this->applicant->person_id)->firstOrFail();
        $this->unit_applicant = RequestingUnit::where('id', $this->applicant->requesting_unit_id)->firstOrFail();
        $this->applicant_telephone = Telephone::where('person_id', $this->peson_applicant->id)->firstOrFail();

        $this->supplier = Supplier::where('id', $this->orden->supplier_id)->firstOrFail();
        $this->person = Person::where('id', $this->supplier->person_id)->firstOrFail();
        $this->telephone = Telephone::where('person_id', $this->person->id)->firstOrFail();

        $this->orden_detail = OrderDetail::join('units', 'order_details.unit_id', '=', 'units.id')
        ->where('order_id', $this->orden->id)
        ->get(['order_details.quantity AS cantidad', 'units.name AS unidad', 'order_details.name AS nombre', 'order_details.description AS descripcion', 'order_details.price AS precio', 'order_details.subtotal AS subtotal']);
        $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        $this->literal = $formatterES->format($this->orden->total);

    }


}
