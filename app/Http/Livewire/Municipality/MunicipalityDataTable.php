<?php

namespace App\Http\Livewire\Municipality;

use Livewire\Component;
use App\Models\Municipality;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MunicipalityDataTable extends LivewireDatatable
{
    use LivewireAlert;

    public $exportable = true;
    public $model = Municipality::class;
    
    public function builder()
    {
        return (Municipality::query()
            ->where('municipalities.state', '!=', 'DELETED')
            ->join('provinces as province', function($join) {
                $join->on('province.id', '=', 'municipalities.province_id');
            })
        );
    }
    public function columns()
    {
        return [

            Column::name('name')
                ->searchable()
               ->label('Nombre'),

            Column::name('province.name')
                ->searchable()
                ->label('Provincia')
                ->alignRight(),    
            
            Column::name('description')
              ->label('Descripción'), 

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
                return view('livewire.municipality.municipality-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }
    public $MunicipalityDeleted;
    public function toastConfirmDelet($slug)
    {
        $this->MunicipalityDeleted = Municipality::where('slug', $slug)->first();
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  $this->MunicipalityDeleted->name,
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
        if ($this->MunicipalityDeleted) {
            //Asignando estado DELETED
            $this->MunicipalityDeleted->state = "DELETED";
            //Guardando el registro
            $this->MunicipalityDeleted->update();
        }
    }

}
