<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Carbon;
use App\Models\Municipality;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductDataTable extends LivewireDatatable
{
    use LivewireAlert;
    public $exportable = true;
    
    public function builder()
    {

        return (Product::query()
        ->where('products.state', '!=', 'DELETED')
        ->join('municipalities', function ($join) {
            $join->on('municipalities.id', '=', 'products.municipality_id');
        })
        ->join('users', function ($join) {
            $join->on('users.id', '=', 'products.user_id');
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
                ->label('Nombre')
                ->alignRight(),

            Column::name('municipalities.name')
                ->filterable($this->municipalities)->alignRight()
                ->label('Sub Gobernación'),

            Column::name('description')
                ->label('Descripción')
                ->alignRight(),
            
            Column::callback(['peopleuser.name', 'peopleuser.lastname'], function ($name, $lastname) {
                    return $name.' '.$lastname;
                })
                ->label('Ultima vez modificado por'),

             Column::callback(['state'], function ($state) {
                    return view('components.datatables.state-data-table', ['state' => $state]);
                })
                    ->label('Estado')
                    ->filterable([
                        'ACTIVE',
                        'INACTIVE'
                    ]),

            Column::callback(['slug'], function ($slug) {
                return view('livewire.product.product-table-actions', ['slug' => $slug]);
            })->label('Opciones')
            ->excludeFromExport()


        ];
    }
    public $idDelet;
    public function toastConfirmDelet($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $this->idDelet = $product->id;
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  'El Producto: '.$product->name,
            'confirmButtonText' =>  'Si',
            'showConfirmButton' =>  true,
            'showCancelButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonColor' => '#A5DC86',
        ]);
    }
    protected $listeners = [
        'confirmed',
    ];
    public function confirmed()
    {
        if ($this->idDelet) {
            $Product = Product::find($this->idDelet);
            $Product->state = "DELETED";
            $Product->update();
        }
    }
    public function getMunicipalitiesProperty()
    {
        return Municipality::pluck('name');
    }
}
