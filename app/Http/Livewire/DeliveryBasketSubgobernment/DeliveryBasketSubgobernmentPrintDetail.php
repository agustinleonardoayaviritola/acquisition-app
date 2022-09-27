<?php

namespace App\Http\Livewire\DeliveryBasketSubgobernment;


use App\Models\Beneficiary;
use App\Models\User;
use App\Models\Person;
use App\Models\DocumentPerson;
use App\Models\DeliveryPoint;
use App\Models\Delivery;
use App\Models\Basket;
use App\Models\Product;
use App\Models\BasketProduct;
use App\Models\DeliveryBasket;
use App\Models\Subgovernment;
use App\Models\NeighborhoodCommunity;
use App\Models\CantonDistrict;

use Livewire\Component;

class DeliveryBasketSubgobernmentPrintDetail extends Component
{
    public function render()
    {
        return view('livewire.delivery-basket-subgobernment.delivery-basket-subgobernment-print-detail');
    }
    public function mount($slug)
    {
        $this->current_date = date('m-d-Y', time());
        $this->deliverybasket = DeliveryBasket::where('slug', $slug)->firstOrFail();
        $this->subgovernment = Subgovernment::where('slug', $this->deliverybasket->subgovernment_code)->firstOrFail();
        $this->beneficiary = Beneficiary::where('id', $this->deliverybasket->beneficiary_id)->firstOrFail();
        $this->neighborhoodcommunity = NeighborhoodCommunity::where('id', $this->beneficiary->neighborhood_community_id)->firstOrFail();
        $this->cantondistrict = CantonDistrict::where('id', $this->neighborhoodcommunity->canton_district_id)->firstOrFail();
        $this->person = Person::where('id', $this->beneficiary->person_id)->firstOrFail();
        $this->user = User::where('id', $this->deliverybasket->user_id)->firstOrFail();
        $this->userperson = Person::where('id', $this->user->person_id)->firstOrFail(); 
        $this->documentperson = DocumentPerson::where('person_id', $this->person->id)->firstOrFail();
        $this->deliverypoints = DeliveryPoint::all()->where('state', '!=', 'DELETED')->where('subgovernment_code', '=', auth()->user()->subgovernment_code);
        $this->delivery = Delivery::where('id',$this->deliverybasket->delivery_id)->firstOrFail();
        $this->basket = Basket::where('id', $this->delivery->basket_id)->firstOrFail();
        $this->basketproducts = BasketProduct::all()->where('basket_id', $this->basket->id);
        
    }
    public function ReturnDeliveryBeneficiary()
    {
        return redirect()->route('delivery-basket-subgobernment.dashboard');
    }

}
