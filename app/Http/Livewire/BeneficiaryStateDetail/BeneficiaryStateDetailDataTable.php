<?php

namespace App\Http\Livewire\BeneficiaryStateDetail;

use Livewire\Component;
use App\Models\BeneficiaryStateDetail;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class BeneficiaryStateDetailDataTable extends LivewireDatatable
{
    //Using de alert
    use LivewireAlert;

    public $exportable = true;
    public $model = BeneficiaryStateDetail::class;
    

    public function builder()
    {
        return BeneficiaryStateDetail::query()->where('state', '!=', 'DELETED');
    }

    public function columns()
    {
        return [

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
                return view('livewire.beneficiary-state-detail.beneficiary-state-detail-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }

    public $BeneficiaryStateDetailDeleted;
    public function toastConfirmDelet($slug)
    {
        $this->BeneficiaryStateDetailDeleted = BeneficiaryStateDetail::where('slug', $slug)->first();
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  $this->BeneficiaryStateDetailDeleted->description,
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
        if ($this->BeneficiaryStateDetailDeleted) {
            //Asignando estado DELETED
            $this->BeneficiaryStateDetailDeleted->state = "DELETED";
            //Guardando el registro
            $this->BeneficiaryStateDetailDeleted->update();
        }
    }
}
