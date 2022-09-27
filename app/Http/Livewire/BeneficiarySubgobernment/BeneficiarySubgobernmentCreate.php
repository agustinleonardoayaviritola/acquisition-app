<?php

namespace App\Http\Livewire\BeneficiarySubgobernment;

use Livewire\Component;
use App\Models\Beneficiary;
use App\Models\BeneficiaryType;
use App\Models\NeighborhoodCommunity;
use App\Models\CantonDistrict;
use App\Models\Municipality;
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
use App\Models\BeneficiaryStateDetail;


use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Image;

class BeneficiarySubgobernmentCreate extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    //person
    public $name;
    public $lastname;
    public $address;
    public $num_address;
    public $date_birth;
    public $gender_id;

    // document_person
    public $document_number;
    public $document_issuance;
    public $document_supplement;

    //telephone
    public $telephone_primary;
    public $telephone_secondary;

    //beneficiary
    public $slug;
    public $state = "ACTIVE";
    public $photo;

    public $reference_name;

    public $photo64;
    public $beneficiary;
    public $beneficiary_file;
    public $profession_id;
    public $beneficiary_type_id;
    public $country_id;
    public $department_id;
    public $province_id;
    public $beneficiary_state_id;
    public $user_id;
    public $genders;
    public $professions;
    
    public $countries;
    public $departments;
    public $provinces;
    public $beneficiary_states;
    
    public $neighborhood_community_id;
    public function mount()
    {
        $this->query = ' ';
        $this->neighborhoodcommunities = [];
        $this->genders = Gender::all()->where('state', 'ACTIVE');
        $this->professions = Profession::all()->where('state', 'ACTIVE');
        $this->countries = Country::all()->where('state', 'ACTIVE');
        $this->departments = Department::all()->where('state', 'ACTIVE');
        $this->neighborhoodcommunities = NeighborhoodCommunity::all()->where('state', 'ACTIVE')->where('subgovernment_code', Auth()->User()->subgovernment_code);

    }
    public function render()
    {
        return view('livewire.beneficiary-subgobernment.beneficiary-subgobernment-create');
    }
    protected $rules = [
        'name' => 'required|max:255|min:2',
        'lastname' => 'required|max:255|min:2',
        //'photo' => 'nullable|image|max:10240',
        //'beneficiary_file' => 'nullable|file|max:10240',
        'gender_id' => 'required|numeric|min:1|not_in:0',
        'profession_id' => 'required|numeric|min:1|not_in:0',
        'country_id' => 'required|numeric|min:1|not_in:0',

    ];
    public function submit()
    {
        //dd($this->photo64);
        $this->validate();
        $Person = Person::create([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'address' => $this->address,
            'num_address' => $this->num_address,
            'date_birth' => $this->date_birth,
            'gender_id' => $this->gender_id,
        ]);
        $DocumentPerson = DocumentPerson::create([
            'person_id' => $Person->id,
            'document_type_id' => 1,
            'document_number' => $this->document_number,
            'document_issuance' => $this->document_issuance,
            'document_supplement' => $this->document_supplement,
        ]);
        //Creando registro de telefonos
        $Telephone1 = Telephone::create([
            'person_id' => $Person->id,
            'number' => ($this->telephone_primary) ? $this->telephone_primary : '-',
            'type' => 'PRIMARY',
        ]);
        $Telephone2 =Telephone::create([
            'person_id' => $Person->id,
            'number' => ($this->telephone_secondary) ? $this->telephone_secondary : '-',
            'type' => 'SECONDARY',
        ]);

        $this->beneficiary = new Beneficiary();
        $this->beneficiary->state = $this->state;
        $this->beneficiary->user_id = Auth()->User()->id;
        $this->beneficiary->reference_name = $this->reference_name;
        $this->beneficiary->slug = Str::uuid();
        $this->beneficiary->state = $this->state;
        $this->beneficiary->person_id = $Person->id;
        $this->beneficiary->profession_id = $this->profession_id;
        $this->beneficiary->country_id = $this->country_id;
        $this->beneficiary->department_id = $this->department_id;
        $this->beneficiary->beneficiary_state_id = 2;
        $this->beneficiary->neighborhood_community_id = $this->neighborhood_community_id;
        $this->beneficiary->subgovernment_code = auth()->user()->subgovernment_code;
        $this->beneficiary->save();

        $BeneficiaryStatusHistory = BeneficiaryStatusHistory::create([
            'user_id' => Auth()->User()->id,
            'beneficiary_id' => $this->beneficiary->id,
            'beneficiary_state_detail_id' => 3,
            'description' => 'Nuevo Beneficiario',
            'slug' => Str::uuid(),
        ]);



        // if ($this->photo) {
        //     $filePath = time() . '-beneficiary.' . $this->photo->getClientOriginalExtension();
        //     $img = Image::make($this->photo)
        //         ->resize(720, null, function ($constraint) {
        //             $constraint->aspectRatio();
        //         });
        //     $img->save('storage/beneficiary-photo/' . $filePath);
        //     $Beneficiary->photo = 'storage/beneficiary-photo/' . $filePath;
        //     $Beneficiary->save();
        // }

        if ($this->photo64) {

            $extension = explode('/', mime_content_type($this->photo64))[1];

            // dd($extension);

            $filePath = time() . '-beneficiary.' . $extension;
            $img = Image::make($this->photo64);
            $img->save('storage/beneficiary-photo/' . $filePath);
            $this->beneficiary->photo = 'storage/beneficiary-photo/' . $filePath;
            $this->beneficiary->save();
        }


        if ($this->beneficiary_file) {
            $fileName = time() . '-beneficiary.' . $this->beneficiary_file->getClientOriginalExtension();
            $this->beneficiary_file->storeAs('storage/beneficiary-file/', $fileName, 'public_uploads');
            $this->beneficiary->file = 'storage/beneficiary-file/' . $fileName;
            $this->beneficiary->save();
        }
        $this->cleanInputs();
        $this->confirm('Registro creado correctamente', [
            'icon' => 'success',
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'showCancelButton' => false,
            'cancelButtonText' => 'Cancelar',
            'confirmButtonText' => 'Aceptar',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function cleanInputs()
    {
        $this->name = "";
        $this->description = "";
        $this->state = "ACTIVE";
    }
    protected $listeners = [
        'confirmed',
    ];
    public function confirmed()
    {
        return redirect()->route('beneficiary-subgobernment.print', ['slug'=>$this->beneficiary->slug]);
    }
    public function onChangeSelectDepartment()
    {
        $this->departments = Department::all()->where('state', 'ACTIVE');
    }
}
