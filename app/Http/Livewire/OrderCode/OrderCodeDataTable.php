<?php

namespace App\Http\Livewire\OrderCode;

use App\Models\OrderCode;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OrderCodeDataTable extends LivewireDatatable
{

          use LivewireAlert;
          public $exportable = true;
          public $model = Unit::class;

          public function builder()
          {
              return OrderCode::query()->where('state', '!=', 'ELIMINADO');
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
                          $state == 'ACTIVO' ? $state = 'ACTIVO' : $state = 'INACTIVO';
                          return (string) $state;
                      })
                      ->label('Estado')
                      ->filterable([
                          'ACTIVO',
                          'INACTIVO'
                      ]),

                  Column::callback(['slug'], function ($slug) {
                      return view('livewire.order-code.order-code-table-actions', ['slug' => $slug]);
                  })->label('Opciones')
                      ->excludeFromExport()
              ];
          }

          public $unitDeleted;
          public function toastConfirmDelet($slug)
          {
              $this->unitDeleted = OrderCode::where('slug', $slug)->first();
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
          protected $listeners = [
              'confirmed',
          ];
          public function confirmed()
          {
              if ($this->unitDeleted) {
                  $this->unitDeleted->state = "ELIMINADO";
                  $this->unitDeleted->update();
              }
          }
}
