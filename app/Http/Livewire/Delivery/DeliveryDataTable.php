<?php

namespace App\Http\Livewire\Delivery;

use Livewire\Component;
use App\Models\Delivery;
use App\Models\Basket;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DeliveryDataTable extends LivewireDatatable
{
    

    //Using de alert
    use LivewireAlert;

    public $exportable = true;
    public $model = Delivery::class;
    


    public function builder()
    {
        return (Delivery::query()
            ->where('deliveries.state', '!=', 'DELETED')
            ->join('baskets as basket', function($join) {
                $join->on('basket.id', '=', 'deliveries.basket_id');
            })
        );
    }
    public function columns()
    {
        return [

            Column::name('description')
                ->searchable()
                ->label('Descripción'),

            Column::name('basket.name')
                ->searchable()
                ->label('Canasta'),  

            Column::name('start_date')
                ->label('Fecha Inicio'),

            Column::name('end_date')
                ->label('Fecha Fin'),  

            Column::name('number_baskets_total')
                ->label('Número de canastas restantes')
                ->alignRight(),
               
            Column::name('number_baskets')
                ->label('Número de Canastas'), 

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
                return view('livewire.delivery.delivery-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }

    public $DeliveryDeleted;
    public function toastConfirmDelet($slug)
    {
        $this->DeliveryDeleted = Delivery::where('slug', $slug)->first();
        $this->confirm(__('¿Estas seguro que seas eliminar el registro?'), [
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
        }
    }
}
