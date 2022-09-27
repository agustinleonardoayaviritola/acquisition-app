<?php

namespace App\Http\Livewire\DeliveryBasketSubgobernment;

use App\Models\Beneficiary;
use App\Models\Setting;
use App\Models\DocumentPerson;
use App\Models\BeneficiaryState;
use App\Models\CantonDistrict;
use App\Models\NeighborhoodCommunity;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DeliveryBasketSubgobernmentDataTable extends LivewireDatatable
{

    public $itemDeleted;
    public $exportable = true;
    public $model = Beneficiary::class;
    public $slug_setting = '5db32257-0105-46f6-8519-9759ea997cde';
    
    public function builder()
    {
            return (Beneficiary::query()
            ->where('beneficiaries.state', '!=', 'DELETED')
            ->where('beneficiaries.subgovernment_code', '=', auth()->user()->subgovernment_code)
            ->join('neighborhood_communities', function ($join) {
                $join->on('neighborhood_communities.id', '=', 'beneficiaries.neighborhood_community_id');
            })
            ->join('canton_districts', function ($join) {
                $join->on('canton_districts.id', '=', 'neighborhood_communities.canton_district_id');
            })
            ->join('people', function ($join) {
                $join->on('people.id', '=', 'beneficiaries.person_id');
            })
            ->join('document_people', function ($join) {
                $join->on('document_people.person_id', '=', 'people.id');
            })
            ->join('beneficiary_states', function($join) {
                $join->on('beneficiary_states.id', '=', 'beneficiaries.beneficiary_state_id');        
            })
        );
    }
    public function columns()
    {
        return [

            Column::name('document_people.document_number')
            ->searchable()
           ->label('CI'),

            Column::callback(['person.name', 'person.lastname'], function ($name, $lastname) {
                return $name.' '.$lastname;
            })
            ->searchable()
            ->label('Nombre completo'),


            Column::name('canton_districts.name')
           ->label('Distrito/Canton')
           ->filterable($this->canton_districts)->alignRight(),     


            Column::name('neighborhood_communities.name')
           ->label('Barrio/Comunidad')
           ->filterable($this->neighborhood_communities)->alignRight(),     

            Column::callback(['beneficiary_states.name'], function ($beneficiary_states_name) {
                return view('components.datatables.state-beneficiary-data-table', ['beneficiary_states_name' => $beneficiary_states_name]);
            })
                ->exportCallback(function ($beneficiary_states_name) {
                    $beneficiary_states_name == 'HABILITADO' ? $beneficiary_states_name = 'HABILITADO' : $beneficiary_states_name = 'PRE-INSCRIBIDO';
                    return (string) $beneficiary_states_name;
                })
                ->label('Estado')
                ->filterable($this->beneficiary_states)->alignRight(),

                
            Column::callback(['slug'], function ($slug) {
                $setting = Setting::where('slug', $this->slug_setting)->first();
                $beneficiaryy = Beneficiary::where('slug',$slug)->firstOrFail();
                $StateBeneficiary = BeneficiaryState::where('id', $beneficiaryy->beneficiary_state_id)->firstOrFail();
                return view('livewire.delivery-basket-subgobernment.delivery-basket-subgobernment-data-table-actions', ['slug' => $slug, 'StateBeneficiary' => $StateBeneficiary, 'datasetting' => $setting]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }
    public function getBeneficiaryStatesProperty()
    {
        return BeneficiaryState::pluck('name');
    }
    public function getNeighborhoodCommunitiesProperty()
    {
        return NeighborhoodCommunity::where('subgovernment_code','=',auth()->user()->subgovernment_code)->pluck('name');
    }
    public function getCantonDistrictsProperty()
    {
        return CantonDistrict::where('subgovernment_code','=',auth()->user()->subgovernment_code)->pluck('name');
    }
}
