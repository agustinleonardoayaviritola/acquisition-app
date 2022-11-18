<?php

namespace App\Http\Livewire\OrderDetail;

use App\Models\Order;
use Livewire\Component;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OrderDetailDataTable extends LivewireDatatable
{
    use LivewireAlert;
    public $exportable = true;
    public $model = OrderDetail::class;

    public $order_id;

    public function builder()
    {
        return (OrderDetail::query()
            ->join('orders', function ($join) {
                $join->on('orders.id', '=', 'order_details.order_id');
            })
            ->where('order_details.order_id',  $this->order_id)
            ->where('order_details.state', '!=', 'DELETED'));
    }
    public function columns()
    {
        return [
            Column::name('quantity')
                ->searchable()
                ->label('Monto'),

            Column::callback(['id', 'slug'], function ($id, $slug) {
                return view('livewire.order-detail.order-detail-table-actions', ['id' => $id, 'slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()

        ];
    }

    public $idDelet;
    public function toastConfirmDelet($slug)
    {
        $this->idDelet = OrderDetail::where('slug', $slug)->first();
        $this->confirm(__('¿Estas seguro que seas eliminar el registro?'), [
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
        //dd($this->idDelet);
        if ($this->idDelet) {
            //Asignando estado DELETED
            $this->idDelet->state = "DELETED";
            //Guardando el registro
            $this->updatetotal($this->idDelet);
            $this->idDelet->update();
        }
    }
    public function updatetotal($idDelet)
    {
        $order = Order::where('id', $idDelet->order_id)->first();
        $order->total = $order->total - $idDelet->subtotal;
        //dd($idDelet->subtotal);
        $order->update();
    }
}
