<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use App\Models\OrderDetail;
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
            ->where('orders.state', '!=', 'ELIMINADO')

            ->join('requesting_units', function ($join) {
                $join->on('requesting_units.id', '=', 'orders.requesting_unit_id');
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
/*             ->join('people as user', function ($join) {
                $join->on('user.id', '=', 'users.person_id');
            })->orderBy('orders.application_number', 'ASC'); */
            ->join('people as user', function ($join) {
                $join->on('user.id', '=', 'users.person_id');
            })->orderBy('orders.issue_date', 'DESC');
    }
    public function columns()
    {
        return [
/*             Column::name('application_number')
            ->searchable()
            ->label('Nº Prenumerado'), */

            Column::name('code')
            ->searchable()
            ->label('Nº de Solicitud'),

            Column::name('order_types.name')
            ->label('Tipo'),

            DateColumn::name('orders.issue_date')
            ->searchable()
            ->label('Fecha Emisión')
            ->format('d/m/Y'),

            Column::name('requesting_units.name')
            ->label('Unidad Solicitante'),

            Column::name('total')
            ->label('Costo Total'),

/*             Column::callback(['user.name', 'user.lastname'], function ($name, $lastname) {
                    return $name . ' ' . $lastname;
                })
                    ->label('Usuario'), */

/*             Column::callback(['state'], function ($state) {
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
                ]), */


            Column::callback(['slug'], function ($slug) {
                return view('livewire.order.order-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }

    public $unitDeleted;
    public $details;
    public function toastConfirmDelet($slug)
    {
        $this->unitDeleted = Order::where('slug', $slug)->first();
        $this->details = OrderDetail::where('order_id', $this->unitDeleted->id)->get();
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
    protected $listeners = [
        'confirmed',
    ];
    public function confirmed()
    {
        if($this->details)
        {
            foreach ($this->details as $item)
            {
                $item->delete();
            }
        }
        if ($this->unitDeleted) {
            $this->unitDeleted->delete();
        }
    }
}
