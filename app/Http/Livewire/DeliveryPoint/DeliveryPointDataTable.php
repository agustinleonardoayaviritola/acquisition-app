<?php

namespace App\Http\Livewire\DeliveryPoint;

use Livewire\Component;
use App\Models\DeliveryPoint;
use App\Models\Municipality;
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

class DeliveryPointDataTable extends LivewireDatatable
{

//Using de alert
use LivewireAlert;

public $exportable = true;


    public function builder()
    {
        return (DeliveryPoint::query()
        ->where('delivery_points.state', '!=', 'DELETED')
        ->join('municipalities', function ($join) {
            $join->on('municipalities.id', '=', 'delivery_points.municipality_id');
        })
        ->join('users', function ($join) {
            $join->on('users.id', '=', 'delivery_points.user_id');
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
                ->label('Nombre'),

            Column::name('municipalities.name')
                ->filterable($this->municipalities)->alignRight()
                ->label('Sub Gobernación'),

            Column::name('description')
                ->label('Descripción'),

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
                return view('livewire.delivery-point.delivery-point-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }

    public $DeliveryPoint;
    public function toastConfirmDelet($slug)
    {
        $this->DeliveryPointForDeleted = DeliveryPoint::where('slug', $slug)->first();
        $this->confirm(__('¿Estas seguro que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  $this->DeliveryPointForDeleted->name,
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
        if ($this->DeliveryPointForDeleted) {
            $this->DeliveryPointForDeleted->state = "DELETED";
            $this->DeliveryPointForDeleted->update();
        }
    }
    public function getMunicipalitiesProperty()
    {
        return Municipality::pluck('name');
    }
}
