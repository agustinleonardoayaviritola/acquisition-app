<?php

namespace App\Http\Livewire\BasketSubgobernment;

use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BasketSubgobernmentDataTable extends LivewireDatatable
{
    //Using de alert
    use LivewireAlert;

    public $exportable = true;
    public $model = Basket::class;
    public $price_amount_;
    

    public function builder()
    {
       return (Basket::query()
       ->where('baskets.state', '!=', 'DELETED')
       ->where('subgovernment_code', '=', auth()->user()->subgovernment_code));


    }
    public function columns()
    {
        return [
            Column::name('name')
                ->searchable()
                ->label('Nombre de la Canasta'),

            Column::callback(['id'], function ($id) {
                $BasketProducts=BasketProduct::where('basket_id', $id)->get();
                $Amounts = BasketProduct::where('basket_id', $id)->get();
                return view('livewire.basket-subgobernment.product-detail-data-table', ['BasketProducts' => $BasketProducts]);
                })
                ->label('Cantidad | Producto'),

            Column::callback(['state'], function ($state) {
                return view('components.datatables.state-data-table', ['state' => $state]);
            })
                ->exportCallback(function ($state) {
                    $state == 'ACTIVE' ? $state = 'ACTIVO' : $state = 'INACTIVO';
                    return (string) $state;
                })
                ->label('Estado')
                ->filterable([
                    'ACTIVE',
                    'INACTIVE'
                ]),

            Column::callback(['slug'], function ($slug) {
                return view('livewire.basket-subgobernment.basket-subgobernment-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }

    public $BasketSubgobernmentDeleted;
    public $Basket;
    public function toastConfirmDelet($slug)
    {
        $this->BasketSubgobernmentDeleted = Basket::where('slug', $slug)->first();
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  $this->BasketSubgobernmentDeleted->name,
            'confirmButtonText' =>  'Si',
            'showConfirmButton' =>  true,
            'showCancelButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonColor' => '#A5DC86',
        ]);
    }
    public function deleteProduct($slug)
    {
        
        $BasketProduct = BasketProduct::where('slug', $slug)->firstOrFail();
        $data = Product::where('id', $BasketProduct->product_id)->firstOrFail();
        $this->basket = Basket::where('id', $BasketProduct->basket_id)->firstOrFail();
        $amount_total = $data->amount * $BasketProduct->amount;
        $this->price_amount_ = $this->basket->price_amount - $amount_total;
        $this->basket->update([
            'price_amount' => $this->price_amount_,
        ]);
        $BasketProduct->delete();
    }
    // Listener para eliminar
    protected $listeners = [
        'confirmed',
    ];
    //Funcion para confirmar la eliminacion
    public function confirmed()
    {
        if ($this->BasketSubgobernmentDeleted) {
            //Asignando estado DELETED
            $this->BasketSubgobernmentDeleted->state = "DELETED";
            //Guardando el registro
            $this->BasketSubgobernmentDeleted->update();
        }
    }
}
