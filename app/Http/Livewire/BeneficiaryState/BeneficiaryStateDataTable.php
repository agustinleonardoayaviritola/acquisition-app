<?php

namespace App\Http\Livewire\BeneficiaryState;

use Livewire\Component;
use App\Models\BeneficiaryState;
use App\Models\BeneficiaryStateDetail;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BeneficiaryStateDataTable extends LivewireDatatable
{
    //Using de alert
    use LivewireAlert;

    public $exportable = true;
    public $model = BeneficiaryState::class;
    

    public function builder()
    {
        return BeneficiaryState::query()
        ->where('beneficiary_states.state', '!=', 'DELETED');
    }
    public function columns()
    {
        return [

            Column::name('name')
                ->searchable()
               ->label('Estado'),    
            
            Column::name('description')
              ->label('Descripción'), 

            Column::callback(['id'], function ($id) {
                $beneficiarystatedetails = BeneficiaryStateDetail::all()->where('beneficiary_state_id',$id)->where('state','ACTIVE');
                return view('livewire.beneficiary-state.state-details-data-table', ['beneficiarystatedetails' => $beneficiarystatedetails]);
                })
                ->label('Detalle'),

            Column::callback(['slug'], function ($slug) {
                return view('livewire.beneficiary-state.beneficiary-state-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }

    public $BeneficiaryStateDeleted;
    public function toastConfirmDelet($slug)
    {
        $this->BeneficiaryStateDeleted = BeneficiaryState::where('slug', $slug)->first();
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  $this->BeneficiaryStateDeleted->name,
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
        'confirmedDetail',
    ];
    //Funcion para confirmar la eliminacion
    public function confirmed()
    {
        if ($this->BeneficiaryStateDeleted) {
            //Asignando estado DELETED
            $this->BeneficiaryStateDeleted->state = "DELETED";
            //Guardando el registro
            $this->BeneficiaryStateDeleted->update();
        }
    }

    public $BeneficiaryStateDetailDelete;
    public function deleteDetail($slug)
    {
        $this->BeneficiaryStateDetailDelete = BeneficiaryStateDetail::where('slug', $slug)->first();
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  $this->BeneficiaryStateDetailDelete->description,
            'confirmButtonText' =>  'Si',
            'showConfirmButton' =>  true,
            'showCancelButton' => true,
            'onConfirmed' => 'confirmedDetail',
            'confirmButtonColor' => '#A5DC86',
        ]);

    }

    public function confirmedDetail()
    {
        if($this->BeneficiaryStateDetailDelete){
            $this->BeneficiaryStateDetailDelete->state = "DELETED";
            $this->BeneficiaryStateDetailDelete->update();
        }
    }
}
