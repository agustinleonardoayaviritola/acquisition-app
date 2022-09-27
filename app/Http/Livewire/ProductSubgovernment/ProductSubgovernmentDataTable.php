<?php

namespace App\Http\Livewire\ProductSubgovernment;

use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductSubgovernmentDataTable extends LivewireDatatable
{
    use LivewireAlert;
    public $exportable = true;
    
    public function builder()
    {

        return (Product::query()
            ->where('state', '!=', 'DELETED')
            ->where('subgovernment_code', '=', auth()->user()->subgovernment_code));
        
    }
    public function columns()
    {
        return [
            Column::name('name')
                ->searchable()
                ->label('Nombre')
                ->alignRight(),

            Column::name('description')
                ->label('Descripción')
                ->alignRight(),

             Column::callback(['state'], function ($state) {
                    return view('components.datatables.state-data-table', ['state' => $state]);
                })
                    ->label('Estado')
                    ->filterable([
                        'ACTIVE',
                        'INACTIVE'
                    ]),

            Column::callback(['slug'], function ($slug) {
                return view('livewire.product-subgovernment.product-subgovernment-table-actions', ['slug' => $slug]);
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

}
