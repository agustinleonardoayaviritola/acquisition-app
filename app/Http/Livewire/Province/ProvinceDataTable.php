<?php

namespace App\Http\Livewire\Province;

use App\Models\Province;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProvinceDataTable extends LivewireDatatable
{
    use LivewireAlert;
    public $exportable = true;
    
    public function builder()
    {

        return (Province::query()
            ->where('provinces.state', '!=', 'DELETED')
            ->join('departments as department', function($join) {
                $join->on('department.id', '=', 'provinces.department_id');
            })
        );
        
    }
    public function columns()
    {
        return [
            Column::name('name')
                ->searchable()
                ->label('Nombre')
                ->alignRight(),

            Column::name('department.name')
                ->searchable()
                ->label('Departamento')
                ->alignRight(),

            Column::name('description')
                ->label('Descripción')
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
                return view('livewire.province.province-table-actions', ['slug' => $slug]);
            })->label('Opciones')
            ->excludeFromExport()


        ];
    }
    public $idDelet;
    public function toastConfirmDelet($slug)
    {
        $Province = Province::where('slug', $slug)->firstOrFail();
        $this->idDelet = $Province->id;
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  'La provincia: '.$Province->name,
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
            $Province = Province::find($this->idDelet);
            $Province->state = "DELETED";
            $Province->update();
        }
    }
}
