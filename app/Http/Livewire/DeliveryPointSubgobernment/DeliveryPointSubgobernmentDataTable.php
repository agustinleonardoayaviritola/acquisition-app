<?php

namespace App\Http\Livewire\DeliveryPointSubgobernment;

use Livewire\Component;
use App\Models\DeliveryPoint;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DeliveryPointSubgobernmentDataTable extends LivewireDatatable
{
    
//Using de alert
use LivewireAlert;

public $exportable = true;





    public function builder()
    {
        return (DeliveryPoint::query()
        ->where('state', '!=', 'DELETED')
        ->where('subgovernment_code', '=', auth()->user()->subgovernment_code));
    }

    public function columns()
    {
        return [

            Column::name('name')
                ->searchable()
                ->label('Nombre'),

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
                return view('livewire.delivery-point-subgobernment.delivery-point-subgobernment-table-actions', ['slug' => $slug]);
             })->label('Opciones')
                ->excludeFromExport()
        ];
    }

    public $DeliveryPointSubgobernmaent;
    //Funcion para preguntar la eliminacion, muestra alerta
    public function toastConfirmDelet($slug)
    {
        $this->DeliveryPointSubgobernmaent = DeliveryPoint::where('slug', $slug)->first();
        $this->confirm(__('¿Estas seguro que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  $this->DeliveryPointSubgobernmaent->name,
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
        if ($this->DeliveryPointSubgobernmaent) {
            //Asignando estado DELETED
            $this->DeliveryPointSubgobernmaent->state = "DELETED";
            //Guardando el registro
            $this->DeliveryPointSubgobernmaent->update();
        }
    }


}
