<?php

namespace App\Http\Livewire\Applicant;

use App\Models\Applicant;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ApplicantDataTable extends LivewireDatatable
{
    //Using de alert
    use LivewireAlert;
    public $exportable = true;
    public $model = Applicant::class;
    

    public function builder()
    {
        return Applicant::query()
        ->where('applicants.state', '!=', 'ELIMINADO')
        ->join('people as person', function ($join) {
            $join->on('person.id', '=', 'applicants.person_id');
        })
        ->join('telephones', function ($join) {
            $join->on('person.id', '=', 'telephones.person_id');
        })
        ->join('requesting_units', function ($join) {
            $join->on('requesting_units.id', '=', 'applicants.requesting_unit_id');
        });
    }
    public function columns()
    {
        return [

            Column::callback(['person.name', 'person.lastname'], function ($name, $lastname) {
                return $name.' '.$lastname;
            })
            ->label('Solicitante'),   
            
            Column::name('requesting_units.name')
            ->searchable()
            ->label('UNIDAD DE TRABAJO'),

            Column::name('telephones.number')
            ->searchable()
            ->label('TELEFONO-CELULAR'), 

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
                return view('livewire.applicant.applicant-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }

    public $applicantDeleted;
    public function toastConfirmDelet($slug)
    {
        $this->applicantDeleted = Applicant::where('slug', $slug)->first();
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  $this->applicantDeleted->name,
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
        if ($this->applicantDeleted) {
            //Asignando estado DELETED
            $this->applicantDeleted->state = "ELIMINADO";
            //Guardando el registro
            $this->applicantDeleted->update();
        }
    }
}
