<?php

namespace App\Http\Livewire\Beneficiary;

use App\Models\Beneficiary;
use App\Models\Person;
use App\Models\DocumentPerson;
use App\Models\Telephone;
use App\Models\Municipality;
use App\Models\BeneficiaryState;
use App\Models\CantonDistrict;
use App\Models\NeighborhoodCommunity;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BeneficiaryDataTable extends LivewireDatatable
{
    use LivewireAlert;
    //public $itemDeleted;
    public $dataBeneficiary;
    public $dataPerson;
    public $dataDocument;
    //
    public $exportable = true;
    public $model = Beneficiary::class;
    



    public function builder()
    {

        return (Beneficiary::query()
            ->where('beneficiaries.state', '!=', 'DELETED')
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
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'beneficiaries.user_id');
            })
            ->join('people as peopleuser', function ($join) {
                $join->on('peopleuser.id', '=', 'users.person_id');
            })
            ->join('municipalities', function($join) {
                $join->on('municipalities.id', '=', 'canton_districts.municipality_id');        
            })
            /*             ->join('genders', function ($join) {
                $join->on('genders.id', '=', 'people.gender_id');
            }) */
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
            ->alignRight()
            ->label('Nombre completo'),

            Column::name('municipalities.name')
            ->filterable($this->municipalities)->alignRight()
            ->label('Sub Gobernación'),

/*             Column::name('genders.name')
            ->filterable($this->genders)->alignRight()
            ->label('Genero'),   */
  
 
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

            DateColumn::name('created_at')
                ->filterable()
                ->label('Fecha de Afiliación')
                
                ->format('d/m/Y'),

            Column::callback(['peopleuser.name', 'peopleuser.lastname'], function ($name, $lastname) {
                return $name.' '.$lastname;
            })
            ->label('Usuario'),
                
            Column::callback(['slug'], function ($slug) {
                return view('livewire.beneficiary.beneficiary-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }

    protected $listeners = [
        'confirmed',
    ];

    public function toastConfirmDelet($slug)
    {
        $this->dataBeneficiary = Beneficiary::where('slug', $slug)->first();
        $this->dataPerson = Person::where('id', $this->dataBeneficiary->person_id)->first();
        $this->dataDocument = DocumentPerson::where('person_id',$this->dataPerson->id)->first();
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  $this->dataPerson->name.'' .$this->dataPerson->lastname,
            'confirmButtonText' =>  'Si',
            'showConfirmButton' =>  true,
            'showCancelButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonColor' => '#A5DC86',
        ]);
    }
    public function confirmed()
    {
        if ($this->dataDocument) {
            $this->dataDocument->delete();
        }
        if($this->dataBeneficiary) {
            $this->dataBeneficiary->delete();
        }
        if($this->dataPerson){
            $this->dataPerson->delete();
        }

    }
    public function getBeneficiaryStatesProperty()
    {
        return BeneficiaryState::pluck('name');
    }
    public function getMunicipalitiesProperty()
    {
        return Municipality::pluck('name');
    }
    public function getGendersProperty()
    {
        return Gender::pluck('name');
    }
    public function getCantonDistrictsProperty()
    {
        return CantonDistrict::pluck('name');
    }
    public function getNeighborhoodCommunitiesProperty()
    {
        return NeighborhoodCommunity::pluck('name');
    }
}
