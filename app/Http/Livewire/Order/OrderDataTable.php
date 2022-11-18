<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OrderDataTable extends LivewireDatatable
{
    //Using de alert
    use LivewireAlert;
    public $model = Unit::class;


    public function builder()
    {
        return Order::query()
            ->where('orders.state', '!=', 'DELETED')
            ->join('applicants', function ($join) {
                $join->on('applicants.id', '=', 'orders.applicant_id');
            })
            ->join('suppliers', function ($join) {
                $join->on('suppliers.id', '=', 'orders.supplier_id');
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'orders.user_id');
            })
            ->join('order_types', function ($join) {
                $join->on('order_types.id', '=', 'orders.order_type_id');
            })
            ->join('people as user', function ($join) {
                $join->on('user.id', '=', 'users.person_id');
            })
            ->join('people', function ($join) {
                $join->on('people.id', '=', 'suppliers.person_id');
            })
            ->join('people as person', function ($join) {
                $join->on('person.id', '=', 'applicants.person_id');
            });
    }
    public function columns()
    {
        return [

            Column::callback(['person.name', 'person.lastname'], function ($name, $lastname) {
                return $name . ' ' . $lastname;
            })
                ->label('Solicitante'),

            Column::name('application_number')
                ->searchable()
                ->label('Nº Prenumerado'),

            Column::name('order_types.name')
                ->label('Tipo'),   
                
            Column::name('code')
                ->searchable()
                ->label('Nº de Solicitud'),

            Column::callback(['people.name', 'people.lastname'], function ($name, $lastname) {
                return $name . ' ' . $lastname;
            })
                ->label('Proveedor'),

            Column::callback(['user.name', 'user.lastname'], function ($name, $lastname) {
                    return $name . ' ' . $lastname;
                })
                    ->label('Usuario'),

            Column::name('total')
                ->label('Total'),

            Column::name('observation')
                ->label('Observación'),

            Column::callback(['state'], function ($state) {
                return view('components.datatables.state-data-table', ['state' => $state]);
            })
                ->exportCallback(function ($state) {
                    $state == 'PENDIENTE' ? $state = 'PENDIENTE' : $state = 'ENTREGADO';
                    return (string) $state;
                })
                ->label('Estado')
                ->filterable([
                    'PENDIENTE',
                    'ENTREGADO'
                ]),
            DateColumn::name('orders.created_at')
                ->filterable()
                ->label('Fecha de registro')
                
                ->format('d/m/Y'),
            Column::callback(['slug'], function ($slug) {
                return view('livewire.order.order-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }

    public $unitDeleted;
    public function toastConfirmDelet($slug)
    {
        $this->unitDeleted = Order::where('slug', $slug)->first();
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
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
