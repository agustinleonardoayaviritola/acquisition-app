<?php

namespace App\Http\Livewire\CantonDistrict;

use App\Models\CantonDistrict;
use App\Models\NeighborhoodCommunity;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CantonDistrictElPuenteDataTable extends LivewireDatatable
{
    //Using de alert
    use LivewireAlert;
    public $exportable = true;
    public $model = CantonDistrict::class;
    

    public function builder()
    {
        return (CantonDistrict::query()
        ->where('canton_districts.state', '!=', 'DELETED')
        ->join('municipalities as municipality', function($join) {
           $join->on('municipality.id', '=', 'canton_districts.municipality_id')->where('municipality.id', '=', 3);
       })
       );
    }
    public function columns()
    {
        return [

            Column::name('name')
                ->searchable()
               ->label('Canton/Distrito'),

           Column::name('type')
               ->searchable()
              ->label('Tipo'),

            Column::callback(['id'], function ($id) {
                $neighborhoodcommunities = NeighborhoodCommunity::all()->where('canton_district_id',$id)->where('state','ACTIVE')->where('type','COMUNIDAD');               
                return view('livewire.canton-district.neighborhood-community-data-table', ['neighborhoodcommunities' => $neighborhoodcommunities]);
                })
                ->label('Comunidades'),

           Column::callback(['canton_districts.id'], function ($id) {
                   $neighborhoodcommunities = NeighborhoodCommunity::all()->where('canton_district_id',$id)->where('state','ACTIVE')->where('type','BARRIO');               
                   return view('livewire.canton-district.neighborhood-community-data-table', ['neighborhoodcommunities' => $neighborhoodcommunities]);
                   })
                   ->label('Barrios'),

            Column::callback(['slug'], function ($slug) {
                return view('livewire.canton-district.canton-district-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }
    public $CantonDistrictDeleted;
    public function toastConfirmDelet($slug)
    {
         $this->CantonDistrictDeleted = CantonDistrict::where('slug', $slug)->first();
         $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
             'icon' => 'warning',
             'position' =>  'center',
             'toast' =>  false,
             'text' =>  $this->CantonDistrictDeleted->name,
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
         if ($this->CantonDistrictDeleted) {
             //Asignando estado DELETED
             $this->CantonDistrictDeleted->state = "DELETED";
             //Guardando el registro
             $this->CantonDistrictDeleted->update();
         }
    }
 
    public $NeighborhoodCommunityDelete;
    public function deleteDetail($slug)
    {
         $this->NeighborhoodCommunityDelete = NeighborhoodCommunity::where('slug', $slug)->first();
         $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
             'icon' => 'warning',
             'position' =>  'center',
             'toast' =>  false,
             'text' =>  $this->NeighborhoodCommunityDelete->description,
             'confirmButtonText' =>  'Si',
             'showConfirmButton' =>  true,
             'showCancelButton' => true,
             'onConfirmed' => 'confirmedDetail',
             'confirmButtonColor' => '#A5DC86',
         ]);
 
    }
 
    public function confirmedDetail()
    {
         if($this->NeighborhoodCommunityDelete){
             $this->NeighborhoodCommunityDelete->state = "DELETED";
             $this->NeighborhoodCommunityDelete->update();
         }
    }
}
