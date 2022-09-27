<?php

namespace App\Http\Livewire\Profession;

use App\Models\Profession;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProfessionDataTable extends LivewireDatatable
{
    use LivewireAlert;
    public $exportable = true;
    
    public function builder()
    {

        return (Profession::query()->where('state', '!=', 'DELETED'));
        
    }
    public function columns()
    {
        return [
            Column::name('name')
                ->searchable()
                ->label('Nombre')
                ->alignRight(),

            Column::name('description')
                ->searchable()
                ->label('Descripción')
                ->alignRight(),

            Column::callback(['state'], function ($state) {
                return view('components.datatables.state-profession-data-table', ['state' => $state]);
            })
                ->label('Estado')
                ->filterable([
                    'ACTIVE',
                    'INACTIVE'
                ]),

            Column::callback(['slug'], function ($slug) {
                return view('livewire.profession.profession-table-actions', ['slug' => $slug]);
            })->label('Opciones')
            ->excludeFromExport()


        ];
    }
    public $idDelet;
    public function toastConfirmDelet($slug)
    {
        $profession = Profession::where('slug', $slug)->firstOrFail();
        $this->idDelet = $profession->id;
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  'La profesion: '.$profession->name,
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
            $Profession = Profession::find($this->idDelet);
            $Profession->state = "DELETED";
            $Profession->update();
        }
    }
}
