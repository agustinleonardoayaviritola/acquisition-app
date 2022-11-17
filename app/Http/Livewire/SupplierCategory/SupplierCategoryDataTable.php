<?php

namespace App\Http\Livewire\SupplierCategory;

use App\Models\SupplierCategory;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Livewire\Component;

class SupplierCategoryDataTable extends LivewireDatatable

{
       //Using de alert
       use LivewireAlert;
       public $model = Unit::class;
       
   
       public function builder()
       {
           return SupplierCategory::query()->where('state', '!=', 'DELETED');
       }
       public function columns()
       {
           return [
   
               Column::name('name')
                   ->searchable()
                  ->label('Nombre'),      

                Column::name('description')
                  ->searchable()
                 ->label('Descripcion'),

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
                   return view('livewire.supplier-category.supplier-category-table-actions', ['slug' => $slug]);
               })->label('Opciones')
                   ->excludeFromExport()
           ];
       }
   
       public $unitDeleted;
       public function toastConfirmDelet($slug)
       {
           $this->unitDeleted = SupplierCategory::where('slug', $slug)->first();
           $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
               'icon' => 'warning',
               'position' =>  'center',
               'toast' =>  false,
               'text' =>  $this->unitDeleted->name,
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
           if ($this->unitDeleted) {
               //Asignando estado DELETED
               $this->unitDeleted->state = "DELETED";
               //Guardando el registro
               $this->unitDeleted->update();
           }
       }
}
