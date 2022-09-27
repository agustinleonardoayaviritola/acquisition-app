<?php

namespace App\Http\Livewire\Basket;

use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\Product;
use App\Models\Municipality;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BasketDataTable extends LivewireDatatable
{
    //Using de alert
    use LivewireAlert;

    public $exportable = true;
    public $model = Basket::class;
   

    public function builder()
    {
       return (Basket::query()
       ->where('baskets.state', '!=', 'DELETED')
       ->join('municipalities', function ($join) {
        $join->on('municipalities.id', '=', 'baskets.municipality_id');
        })
        ->join('users', function ($join) {
            $join->on('users.id', '=', 'baskets.user_id');
        })
        ->join('people as peopleuser', function ($join) {
            $join->on('peopleuser.id', '=', 'users.person_id');
        })
            
    
        );


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
                return view('livewire.basket.product-detail-data-table', ['BasketProducts' => $BasketProducts]);
                })
                ->label('Cantidad | Producto'),


            Column::name('municipalities.name')
                ->filterable($this->municipalities)->alignRight()
                ->label('Sub Gobernación'),

            Column::callback(['peopleuser.name', 'peopleuser.lastname'], function ($name, $lastname) {
                    return $name.' '.$lastname;
                })
                ->label('Ultima vez modificado por'),

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
                return view('livewire.basket.basket-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }

    public $BasketDeleted;
    public function toastConfirmDelet($slug)
    {
        $this->BasketDeleted = Basket::where('slug', $slug)->first();
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  $this->BasketDeleted->code,
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
        $BasketProduct->delete();
    }
    protected $listeners = [
        'confirmed',
    ];
    public function confirmed()
    {
        if ($this->BasketDeleted) {
            $this->BasketDeleted->state = "DELETED";
            $this->BasketDeleted->update();
        }
    }
    public function getMunicipalitiesProperty()
    {
        return Municipality::pluck('name');
    }
}
