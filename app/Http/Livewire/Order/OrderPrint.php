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
        $this->user = User::where('id', $this->orden->user_id)->firstOrFail();
        $this->peson_user = Person::where('id', $this->user->person_id)->firstOrFail();

        $this->applicant = Applicant::where('id', $this->orden->applicant_id)->firstOrFail();
        $this->peson_applicant = Person::where('id', $this->applicant->person_id)->firstOrFail();
        $this->unit_applicant = RequestingUnit::where('id', $this->applicant->requesting_unit_id)->firstOrFail();
        $this->applicant_telephone = Telephone::where('person_id', $this->peson_applicant->id)->firstOrFail();

        $this->supplier = Supplier::where('id', $this->orden->supplier_id)->firstOrFail();
        $this->person = Person::where('id', $this->supplier->person_id)->firstOrFail();
        $this->telephone = Telephone::where('person_id', $this->person->id)->firstOrFail();
        $this->orden_detail = OrderDetail::where('order_id', $this->orden->id)->get();
        
        if($this->orden_detail->isNotEmpty())
        {
            $this->unidad = Unit::where('id', $this->orden_detail[0]->unit_id)->firstOrFail();
        }
        else{
            $this->unidad = 'sin datos';
        }
        $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        $this->literal = $formatterES->format($this->orden->total);
        
    }


}
