<?php

namespace App\Http\Livewire\NeighborhoodCommunity;

use App\Models\CantonDistrict;
use Livewire\Component;
use App\Models\NeighborhoodCommunity;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class NeighborhoodCommunityDataTable extends LivewireDatatable
{
    use LivewireAlert;

    public $exportable = true;
    public $model = NeighborhoodCommunity::class;
    

    public function builder()
    {

        return NeighborhoodCommunity::query()->where('state', '!=', 'DELETED');

    }

    public function columns()
    {
        return [

            Column::name('name')
                //->searchable()
               ->label('Nombre'),
               

          /*  Column::name('district.name')
               ->searchable()
              ->label('Distrito'),   */ 
               
            /* Column::name('description')
               ->searchable()
              ->label('Descripción'),  */  


            
            Column::callback(['slug'], function ($slug) {
                return view('livewire.neighborhood-community.neighborhood-community-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }

    public $NeighborhoodCommunityDeleted;
    public function toastConfirmDelet($slug)
    {
        $this->NeighborhoodCommunityDeleted = NeighborhoodCommunity::where('slug', $slug)->first();
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  $this->NeighborhoodCommunityDeleted->name,
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
        if ($this->NeighborhoodCommunityDeleted) {
            //Asignando estado DELETED
            $this->NeighborhoodCommunityDeleted->state = "DELETED";
            //Guardando el registro
            $this->NeighborhoodCommunityDeleted->update();
        }
    }
}
