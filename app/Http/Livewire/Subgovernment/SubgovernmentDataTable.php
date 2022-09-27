<?php

namespace App\Http\Livewire\Subgovernment;

use Livewire\Component;
use App\Models\Subgovernment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SubgovernmentDataTable extends LivewireDatatable
{
    use LivewireAlert;
    public $exportable = true;
    
    
    public function builder()
    {
        return (Subgovernment::query()
        ->where('subgovernments.state', '!=', 'DELETED')
        ->join('users as user', function($join) {
            $join->on('user.id', '=', 'subgovernments.user_id');
        })
        ->join('people as person', function($join) {
            $join->on('person.id', '=', 'user.person_id');
        }));
    }

    public function columns()
    {
        return [
            Column::name('name')
                ->searchable()
                ->label('Sub Gobernación')
                ->alignRight(),

            Column::callback(['person.name', 'person.lastname'], function ($name, $lastname) {
                return $name.' '.$lastname;
            })
            ->alignRight()
            ->label('Nombre completo del usuario administrador'),

            Column::name('user.email')
                ->label('Cuenta del administrador')
                ->alignRight(),

            Column::name('subgovernments.slug')
                ->label('Código único de la Sub gobernación')
                ->alignRight(),

             Column::callback(['state'], function ($state) {
                    return view('components.datatables.state-data-table', ['state' => $state]);
                })
                    ->label('Estado')
                    ->filterable([
                        'ACTIVE',
                        'INACTIVE'
                    ]),

            Column::callback(['slug'], function ($slug) {
                return view('livewire.subgovernment.subgovernment-table-actions', ['slug' => $slug]);
            })->label('Opciones')
            ->excludeFromExport()


        ];
    }
    public $idDelet;
    public function toastConfirmDelet($slug)
    {
        $subgovernment = Subgovernment::where('slug', $slug)->firstOrFail();
        $this->idDelet = $subgovernment->id;
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  'La Subgobernacion: '.$subgovernment->name,
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
        if ($this->idDelet) {
            $Subgovernment = Subgovernment::find($this->idDelet);
            $Subgovernment->state = "DELETED";
            $Subgovernment->update();
        }
    }


   
}
