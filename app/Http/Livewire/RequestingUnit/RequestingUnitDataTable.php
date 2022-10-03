<?php

namespace App\Http\Livewire\RequestingUnit;

use App\Models\RequestingUnit;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class RequestingUnitDataTable extends LivewireDatatable
{
     //Using de alert
     use LivewireAlert;

     public $exportable = true;
     public $model = Unit::class;
     
 
     public function builder()
     {
         return RequestingUnit::query()->where('state', '!=', 'DELETED');
     }
     public function columns()
     {
         return [
 
             Column::name('name')
                 ->searchable()
                ->label('Nombre'),      
 
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
                 return view('livewire.requesting-unit.requesting-unit-table-actions', ['slug' => $slug]);
             })->label('Opciones')
                 ->excludeFromExport()
         ];
     }
 
     public $idDelet;
     public function toastConfirmDelet($slug)
     {
        $requestingunit = RequestingUnit::where('slug', $slug)->firstOrFail();
        $this->idDelet = $requestingunit->id;
         $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  'Usuario '.$requestingunit->name,
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
        if ($this->idDelet) {
            $RequestingUnit = RequestingUnit::find($this->idDelet);
            $RequestingUnit->state = "DELETED";
            $RequestingUnit->update();
        }
     }
}
