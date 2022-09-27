<?php

namespace App\Http\Livewire\Beneficiary;

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
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BeneficiaryPrint extends Component
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
        return view('livewire.beneficiary.beneficiary-print');
    }
    protected $listeners = [
        'ReturnBeneficiary' => 'confirmedReturnBeneficiary',
    ];
    public function confirmedReturnBeneficiary()
    {
        return redirect()->route('beneficiary.dashboard');
    }
}
