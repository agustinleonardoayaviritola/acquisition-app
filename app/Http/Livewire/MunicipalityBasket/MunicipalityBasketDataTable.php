<?php

namespace App\Http\Livewire\MunicipalityBasket;

use Livewire\Component;
use App\Models\MunicipalityBasket;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MunicipalityBasketDataTable extends LivewireDatatable
{
   

    use LivewireAlert;

    public $exportable = true;
    public $model = MunicipalityBasket::class;
    

    public function builder()
    {
        return MunicipalityBasket::query()->where('municipality_baskets.state', '!=', 'DELETED')
            ->join('subgovernments as subgovernment', function($join) {
                $join->on('subgovernment.id', '=', 'municipality_baskets.subgovernment_id');
            });
    }
    public function columns()
    {
        return [

            Column::name('subgovernment.name')
                ->searchable()
                ->label('Sub gobernación'),

            Column::name('management')
                ->filterable([
                    '2022',
                    '2023',
                    '2024',
                    '2025',
                    '2026',
                    '2027',
                    '2028',
                    '2029',
                    '2030'
                ])
                ->label('Gestion'),

            Column::name('name')
               ->label('Nombre de la canasta'),

            Column::name('description')
               ->label('Descripción'),

            Column::name('start_date')
                ->label('Fecha Inicio'),  
            
            Column::name('end_date')
              ->label('Fecha Finalización'), 


            Column::name('number_baskets_total')
              ->label('Número de canastas total asignadas')
              ->alignRight(),

            Column::name('number_baskets')
              ->label('Número de canastas restantes'),
            
            Column::name('number_baskets_delivered')
              ->label('Número de canastas entregadas'), 


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
                return view('livewire.municipality-basket.municipality-basket-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }
    public $MunicipalityBasketDeleted;
    public function toastConfirmDelet($slug)
    {
        $this->MunicipalityBasketDeleted = MunicipalityBasket::where('slug', $slug)->first();
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  $this->MunicipalityBasketDeleted->name,
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
        if ($this->MunicipalityBasketDeleted) {
            $this->MunicipalityBasketDeleted->state = "DELETED";
            $this->MunicipalityBasketDeleted->update();
        }
    }
    public function getMunicipalityBasketsProperty()
    {
        return MunicipalityBasket::pluck('management');
    }

}
