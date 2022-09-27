<?php

namespace App\Http\Livewire\DeliveryBasketDetailSubgobernment;

use Livewire\Component;
use App\Models\DeliveryBasket;
use App\Models\MunicipalityBasket;
use App\Models\User;
use App\Models\DocumentPerson;
use App\Models\BasketProduct;
use App\Models\Person;
use App\Models\Beneficiary;
use App\Models\DeliveryPoint;
use App\Models\Delivery;
use App\Models\Basket;
use App\Models\Product;
use App\Models\BeneficiaryState;
use App\Models\CantonDistrict;
use App\Models\NeighborhoodCommunity;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class DeliveryBasketDetailDataTable extends LivewireDatatable
{
    use LivewireAlert;
    public $itemDeleted;
    public $exportable = true;
    public $model = DeliveryBasket::class;
    ///
    public $number_baskets_;
    public $negative_baskets;
    
    public function builder()
    {
            return (DeliveryBasket::query()
            ->where('delivery_baskets.state', '=', 'ACTIVE')
            ->where('delivery_baskets.subgovernment_code', '=', auth()->user()->subgovernment_code)
            ->join('beneficiaries', function ($join) {
                $join->on('beneficiaries.id', '=', 'delivery_baskets.beneficiary_id');
            })
            ->join('neighborhood_communities as neighborhood_communitie', function($join) {
                $join->on('neighborhood_communitie.id', '=', 'beneficiaries.neighborhood_community_id');        
            })
            ->join('canton_districts', function($join) {
                $join->on('canton_districts.id', '=', 'neighborhood_communitie.canton_district_id');        
            })
            ->join('people as person', function($join) {
                $join->on('person.id', '=', 'beneficiaries.person_id');        
            })
            ->join('document_people', function ($join) {
                $join->on('document_people.person_id', '=', 'person.id');
            })
            ->join('delivery_points as delivery_point', function($join) {
                $join->on('delivery_point.id', '=', 'delivery_baskets.delivery_point_id');        
            })
            ->join('deliveries as delivery', function($join) {
                $join->on('delivery.id', '=', 'delivery_baskets.delivery_id');        
            })
            ->join('baskets as bastek', function($join) {
                $join->on('bastek.id', '=', 'delivery.basket_id');        
            })
            ->join('users', function($join) {
                $join->on('users.id', '=', 'delivery_baskets.user_id');        
            })->orderBy('neighborhood_communitie.name', 'DESC')
        );
    }
    public function columns()
    {
        return [
            Column::index($this),

            Column::name('date_delivery')
            ->label('Fecha de entrega'),

            Column::name('users.email')
            ->label('Entregado por')
            ->filterable($this->users)->alignRight(),

            Column::callback(['person.name', 'person.lastname'], function ($name, $lastname) {
                return $name.' '.$lastname;
            })
            ->searchable()
            ->alignRight()
            ->label('Nombre Completo'),


            Column::callback(['document_people.document_number', 'document_people.document_supplement'], function ($document_number, $document_supplement) {
                return $document_number.''.$document_supplement;
            })
            ->searchable()
            ->label('CI'),

            Column::name('canton_districts.name')
            ->label('Distrito/Canton')
            ->filterable($this->canton_districts)->alignRight(),    

            Column::name('neighborhood_communitie.name')
            ->label('Comunidad/Barrio')
            ->filterable($this->neighborhood_communities)->alignRight(),    


            Column::name('delivery_point.name')
            ->label('Punto de entrega'),

            Column::name('delivery.description')
            ->label('Version de entrega'),

/* 
            Column::callback(['bastek.id'], function ($id) {
                $BasketProducts=BasketProduct::where('basket_id', $id)->get();
                $Amounts = BasketProduct::where('basket_id', $id)->get();
                return view('livewire.delivery-basket-detail-subgobernment.delivery-product-detail-data-table', ['BasketProducts' => $BasketProducts]);
                })
                ->label('Productos'), */

                
            Column::callback(['slug'], function ($slug) {
                return view('livewire.delivery-basket-detail-subgobernment.delivery-basket-detail-subgobernment-data-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }
    public $DeliveryDeleted;
    public function toastConfirmDelet($slug)
    {
        $this->DeliveryDeleted = DeliveryBasket::where('slug', $slug)->first();

        
        $this->confirm(__('¿Estas seguro que deseas eliminar el registro?'), 
        [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  $this->DeliveryDeleted->name,
            'confirmButtonText' =>  'Si',
            'showConfirmButton' =>  true,
            'showCancelButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonColor' => '#A5DC86',
        ]);
    }
    // Listener para eliminar
    protected $listeners = [
        'confirmed',
    ];
    //Funcion para confirmar la eliminacion
    public function confirmed()
    {

        if ($this->DeliveryDeleted) {
        
            $this->Delivery = Delivery::where('id', $this->DeliveryDeleted->delivery_id)->first();
            $this->municipalitybasket = MunicipalityBasket::where('id', $this->Delivery->municipality_basket_id)->firstOrFail();
    
            $this->number_baskets_ = $this->Delivery->number_baskets;
            $this->negative_baskets = $this->Delivery->number_baskets_delivered;
    
            //Actualizar las cantidades
            $this->Delivery->update([
                'number_baskets' => $this->number_baskets_ + 1,
                'number_baskets_delivered'=> $this-> negative_baskets - 1,
            ]);
            $this->municipalitybasket->update([
                'number_baskets'=> $this->number_baskets_ + 1,
                'number_baskets_delivered'=> $this-> negative_baskets - 1,
            ]);

            $this->DeliveryDeleted->delete();
        }   
    }
    public function getNeighborhoodCommunitiesProperty()
    {
        return NeighborhoodCommunity::where('subgovernment_code','=',auth()->user()->subgovernment_code)->pluck('name');
    }
    public function getCantonDistrictsProperty()
    {
        return CantonDistrict::where('subgovernment_code','=',auth()->user()->subgovernment_code)->pluck('name');
    }
    public function getUsersProperty()
    {
        return User::where('subgovernment_code','=',auth()->user()->subgovernment_code)->pluck('email');
    }
}
