<?php

namespace App\Http\Livewire\BeneficiarySubgobernment;

use Livewire\Component;
Use Carbon\Carbon;
use App\Models\Beneficiary;
use App\Models\Country;
use App\Models\Department;
use App\Models\Gender;
use App\Models\Telephone;
use App\Models\Person;
use App\Models\BeneficiaryState;
use App\Models\DocumentPerson;
use App\Models\Profession;
use App\Models\Subgovernment;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BeneficiarySubgobernmentPrint extends Component
{
    public $beneficiary;
    public $user;
    public $userperson;
    public $person;
    public $beneficiary_state;
    public $current_date;
    public $date_register;
    public function mount($slug)
    {
        $this->beneficiary = Beneficiary::where('slug', $slug)->firstOrFail();
        $this->subgovernment = Subgovernment::where('slug', $this->beneficiary->subgovernment_code)->firstOrFail();
        if ($this->beneficiary) {
            $this->user = User::where('id', $this->beneficiary->user_id)->firstOrFail();
            $this->userperson = Person::where('id', $this->user->person_id)->firstOrFail();            
            $this->person = Person::where('id', $this->beneficiary->person_id)->firstOrFail();            
            $this->beneficiary_state = BeneficiaryState::where('id', $this->beneficiary->beneficiary_state_id)->firstOrFail(); // payment type

        }
        $this->current_date = date('m-d-Y', time());
        
        $this->date_ = Carbon::parse($this->beneficiary->created_at);
        $this->date_register= $this->date_->format('m-d-Y');

         
        
    }
    public function render()
    {
        return view('livewire.beneficiary-subgobernment.beneficiary-subgobernment-print');
    }
    public function confirmedReturnBeneficiary()
    {
        return redirect()->route('beneficiary-subgobernment.dashboard');
    }
}
