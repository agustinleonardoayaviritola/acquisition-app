<?php

namespace App\Http\Livewire\DeliveryBasketDetail;

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
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DeliveryBasketDetailAdminDataTable extends LivewireDatatable
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
            ->where('delivery_baskets.state', '!=', 'DELETED')
            //->where('delivery_baskets.subgovernment_code', '=', auth()->user()->subgovernment_code)
            ->join('beneficiaries', function ($join) {
                $join->on('beneficiaries.id', '=', 'delivery_baskets.beneficiary_id');
            })
            ->join('neighborhood_communities as neighborhood_community', function($join) {
                $join->on('neighborhood_community.id', '=', 'beneficiaries.neighborhood_community_id');        
            })
            ->join('people as person', function($join) {
                $join->on('person.id', '=', 'beneficiaries.person_id');        
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
/*             ->join('basket_products as basket_product', function($join) {
                $join->on('basket_product.id', '=', 'bastek.product_id');        
            }) */
            ->join('users as user', function($join) {
                $join->on('user.id', '=', 'delivery_baskets.user_id');        
            })
        );
    }
    public function columns()
    {
        return [
            Column::name('date_delivery')
            ->label('Fecha de entrega'),

            Column::name('user.email')
            ->label('Usuario'),

            Column::callback(['person.name', 'person.lastname'], function ($name, $lastname) {
                return $name.' '.$lastname;
            })
            ->searchable()
            ->alignRight()
            ->label('Beneficiario'),

            Column::name('neighborhood_community.name')
            ->label('Comunidad/Barrio'),

            Column::name('delivery_point.name')
            ->label('Punto de entrega'),

            Column::name('delivery.description')
            ->label('Version de entrega'),

/*             Column::name('bastek.name')
            ->label('Canasta'), */

            Column::callback(['bastek.id'], function ($id) {
                $BasketProducts=BasketProduct::where('basket_id', $id)->get();
                $Amounts = BasketProduct::where('basket_id', $id)->get();
                return view('livewire.delivery-basket-detail.delivery-product-detail-admin-data-table', ['BasketProducts' => $BasketProducts]);
                })
                ->label('Productos'),

                
            Column::callback(['slug'], function ($slug) {
                return view('livewire.delivery-basket-detail.delivery-basket-detail-admin-data-table-actions', ['slug' => $slug]);
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
            //Asignando estado DELETED
            $this->DeliveryDeleted->state = "DELETED";
            //Guardando el registro
            $this->DeliveryDeleted->update();

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
        }
    }

}
