<?php

namespace App\Http\Livewire\BeneficiarySubgobernment;

use App\Models\Beneficiary;
use App\Models\BeneficiaryState;
use App\Models\DocumentPerson;
use App\Models\BeneficiaryStatusHistory;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BeneficiarySubgobernmentHistoryDataTable extends LivewireDatatable
{
    use LivewireAlert;
    public $itemDeleted;
    ///
    public $beneficiary_id;
    public function builder()
    {
        return (BeneficiaryStatusHistory::query()
            ->where('beneficiary_id', '=', $this->beneficiary_id)
            ->join('beneficiary_state_details', function($join) {
                $join->on('beneficiary_state_details.id', '=', 'beneficiary_status_histories.beneficiary_state_detail_id');        
            })
            ->join('beneficiary_states', function ($join) {
                $join->on('beneficiary_states.id', '=', 'beneficiary_state_details.beneficiary_state_id');
            })
            
        );
    }
    public function columns()
    {
        return [


            Column::name('beneficiary_states.name')
            ->searchable()
            ->label('Estado'),

            Column::name('beneficiary_state_details.description')
            ->label('Detalle del estado'),

            Column::name('description')
            ->label('Descripción'),

            DateColumn::name('created_at')
                ->label('Fecha')
                ->format('d/m/Y'),
        ];
    }
}
