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
use \Numbers_Words;
class OrderPrint extends Component
{
    public $orden;
    public $literal;

    public $orden_type;
    public $user;
    public $peson_user;
    public $applicant;
    public $unit_applicant;
    public $supplier;
    public $person;
    public $telephone;
    public $orden_detail;
    //////

    public $integer_words;
    public $decimal;
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

        $this->applicant = RequestingUnit::where('id', $this->orden->requesting_unit_id)->firstOrFail();
        $this->unit_applicant = RequestingUnit::where('id', $this->orden->requesting_unit_id)->firstOrFail();

        $this->supplier = Supplier::where('id', $this->orden->supplier_id)->firstOrFail();
        $this->person = Person::where('id', $this->supplier->person_id)->firstOrFail();

        $this->orden_detail = OrderDetail::join('units', 'order_details.unit_id', '=', 'units.id')
        ->where('order_id', $this->orden->id)
        ->get(['order_details.quantity AS cantidad', 'units.name AS unidad','order_details.description AS descripcion', 'order_details.price AS precio', 'order_details.subtotal AS subtotal']);
        ////
        $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        $formatted_number = number_format($this->orden->total, 2,'.',',');
        list($integer, $this->decimal) = explode('.', $formatted_number);
        $num=str_replace(',','',$integer);
        $this->integer_words = $formatterES->format($num);
    }


}
