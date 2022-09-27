<?php

namespace App\Http\Livewire\BeneficiarySubgobernment;

use Livewire\Component;
use App\Models\Beneficiary;
use App\Models\BeneficiaryType;
use App\Models\BeneficiaryStateDetail;
use App\Models\BeneficiaryState;
use App\Models\NeighborhoodCommunity;
use App\Models\Country;
use App\Models\Department;
use App\Models\Gender;
use App\Models\Telephone;
use App\Models\Person;
use App\Models\DocumentPerson;
use App\Models\Profession;
use App\Models\Province;
use App\Models\User;
use App\Models\Subgovernment;
use App\Models\BeneficiaryStatusHistory;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;

class BeneficiarySubgobernmentUpdateState extends Component
{
    use LivewireAlert;
    public $slug;
    public $data;
    public $beneficiary;
    public $beneficiary_state_detail_id;
    public $stateId;
    public $user_id;
    ////
    public $beneficiarystate;
    public $beneficiarystatedetails;
    public $description;


    public function render()
    {
        return view('livewire.beneficiary-subgobernment.beneficiary-subgobernment-update-state');
    }
    public function mount($slug)
    {   
        
        $this->beneficiarystate = BeneficiaryState::all()->where('state', 'ACTIVE');
        $this->getStateDetails();
        ////
        $this->subgovernment = Subgovernment::where('slug', '=', auth()->user()->subgovernment_code)->firstOrFail();
        $this->beneficiary = Beneficiary::where('slug', $slug)->firstOrFail();
        $this->person = Person::where('id', $this->beneficiary->person_id)->firstOrFail();
        $this->documentperson = DocumentPerson::where('person_id', $this->person->id)->firstOrFail();
        $this->beneficiarystates = BeneficiaryState::where('id', $this->beneficiary->beneficiary_state_id)->firstOrFail();
    }
  
    public function updatedStateId()
    {
        $this->getStateDetails();
    }
    public function getStateDetails()
    {
        if($this->stateId != '') {
            $this->beneficiarystatedetails = BeneficiaryStateDetail::where('state', 'ACTIVE')->where('beneficiary_state_id', $this->stateId)->get();   

        } else {

        }
    }
    protected $rules = [
        'stateId' => 'required',
        'beneficiary_state_detail_id' => 'required',
        'description' => 'required',

    ];
    public function submit()
    {
        $this->validate();
        $BeneficiaryStatusHistory = BeneficiaryStatusHistory::create([
            'user_id' => Auth()->User()->id,
            'beneficiary_id' => $this->beneficiary->id,
            'beneficiary_state_detail_id' => $this->beneficiary_state_detail_id,
            'description' => $this->description,
            'slug' => Str::uuid(),
        ]);
        $this->datastatedetail = BeneficiaryStateDetail::where('id',$this->beneficiary_state_detail_id )->firstOrFail();
        $this->databeneficiarystate = BeneficiaryState::where('id',$this->datastatedetail->beneficiary_state_id )->firstOrFail();


        $this->beneficiary->update([
            'user_id' => Auth()->User()->id,
            'beneficiary_state_id' => $this->databeneficiarystate->id,
        ]);

        $this->cleanInputs();
        $this->alert('success', 'Registro actualizado correctamente.', [
            'toast' => true,
            'position' => 'top-end',
        ]);
        return redirect()->route('beneficiary-subgobernment.update.state', [$this->beneficiary->slug]);

    }
    public function cleanInputs()
    {
        $this->stateId = "";
        $this->beneficiary_state_detail_id = "";
        $this->description = "";
        $this->beneficiarystatedetails = null;
    }
    protected $listeners = [
        'confirmed',
    ];

    public function confirmed()
    {
        return redirect()->route('beneficiary-subgobernment.update.state', [$this->beneficiary->slug]);
    }
}
