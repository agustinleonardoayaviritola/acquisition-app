<?php

namespace App\Http\Livewire\BeneficiarySubgobernment;

use Livewire\Component;
use App\Models\Beneficiary;
use App\Models\BeneficiaryType;
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
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Image;

class BeneficiarySubgobernmentUpdate extends Component
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
    public $description;
    public $slug;
    public $state = "ACTIVE";
    public $photo;

    public $reference_name;

    public $photo64;
    public $photo_new;
    public $beneficiary;
    public $beneficiary_file;
    public $beneficiary_file_new;
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
    public function render()
    {
        return view('livewire.beneficiary-subgobernment.beneficiary-subgobernment-update');
    }
    public function mount($slug)
    {
        $this->genders = Gender::all()->where('state', 'ACTIVE');
        $this->professions = Profession::all()->where('state', 'ACTIVE');
        $this->countries = Country::all()->where('state', 'ACTIVE');
        $this->departments = Department::all()->where('state', 'ACTIVE');
        $this->neighborhoodcommunities = NeighborhoodCommunity::all()->where('state', 'ACTIVE');

        $this->beneficiary = Beneficiary::where('slug', $slug)->firstOrFail();
        $this->person = Person::where('id', $this->beneficiary->person_id)->firstOrFail();
        $this->documentperson = DocumentPerson::where('person_id', $this->person->id)->firstOrFail();
        if ($this->person) {
            $this->name = $this->person->name;
            $this->lastname = $this->person->lastname;
            $this->address = $this->person->address;
            $this->num_address = $this->person->num_address;
            $this->date_birth = $this->person->date_birth;
            $this->gender_id = $this->person->gender_id;
            $this->primary = Telephone::where('person_id', $this->person->id)->where('type', 'PRIMARY')->first();
            $this->secondary = Telephone::where('person_id', $this->person->id)->where('type', 'SECONDARY')->first();
            if($this->primary) {
                $this->telephone_primary = $this->primary->number;
            }
            if($this->secondary) {
                $this->telephone_secondary = $this->secondary->number;

            }
        }
        if ($this->documentperson) {
            $this->document_number = $this->documentperson->document_number;
            $this->document_issuance = $this->documentperson->document_issuance;
            $this->document_supplement = $this->documentperson->document_supplement;
        }
        if ($this->beneficiary) {
            $this->photo64 =$this->beneficiary->photo;
            $this->beneficiary_file =$this->beneficiary->file;
            $this->reference_name = $this->beneficiary->reference_name;
            $this->profession_id = $this->beneficiary->profession_id;
            $this->country_id = $this->beneficiary->country_id;
            $this->department_id = $this->beneficiary->department_id;
            $this->neighborhood_community_id = $this->beneficiary->neighborhood_community_id;
        }
        
        
        
    }
    protected $rules = [
        'name' => 'required|max:255|min:2',
        'lastname' => 'required|max:255|min:2',
        //'photo' => 'nullable|image|max:10240',
        //'beneficiary_file' => 'nullable|file|max:10240',
        'gender_id' => 'required|numeric|min:1|not_in:0',
        //'profession_id' => 'required|numeric|min:1|not_in:0',
        'country_id' => 'required|numeric|min:1|not_in:0',
    ];
    public function submit()
    {
        $this->validate();
        $this->person->update([

            'name' => $this->name,
            'lastname' => $this->lastname,
            'address' => $this->address,
            'num_address' => $this->num_address,
            'date_birth' => $this->date_birth,
            'gender_id' => $this->gender_id,
        ]);
        $this->documentperson->update([
            'document_number' => $this->document_number,
            'document_issuance' => $this->document_issuance,
            'document_supplement' => $this->document_supplement,
        ]);
        //Editando telefonos
        if($this->telephone_primary) {
            if($this->primary) {
                $this->primary->update([
                    'number' => ($this->telephone_primary) ? $this->telephone_primary : '-',
                ]);
            }
            else {
                $Telephone1 = Telephone::create([
                    'person_id' => $this->person->id,
                    'number' => ($this->telephone_primary) ? $this->telephone_primary : '-',
                    'type' => 'PRIMARY',
                ]);
            }

        }
        if($this->telephone_secondary) {
            if($this->secondary) {
                $this->secondary->update([
                    'number' => ($this->telephone_secondary) ? $this->telephone_secondary : '-',
                ]);
            }
            else {
                $Telephone2 =Telephone::create([
                    'person_id' => $this->person->id,
                    'number' => ($this->telephone_secondary) ? $this->telephone_secondary : '-',
                    'type' => 'SECONDARY',
                ]);
            }

        }
        $this->beneficiary->update([
            'user_id' => Auth()->User()->id,
            'reference_name' => $this->reference_name,
            'profession_id' => $this->profession_id,
            'country_id' => $this->country_id,
            'department_id' => $this->department_id,
            'neighborhood_community_id' => $this->neighborhood_community_id,
        ]);

        if ($this->photo_new) {
            if($this->beneficiary->photo) {
                Storage::disk('public_uploads')->delete($this->beneficiary->photo);
                $extension = explode('/', mime_content_type($this->photo_new))[1];

                // dd($extension);

                $filePath = time() . '-beneficiary.' . $extension;
                $img = Image::make($this->photo_new);
                $img->save('storage/beneficiary-photo/' . $filePath);
                $this->beneficiary->photo = 'storage/beneficiary-photo/' . $filePath;
                $this->beneficiary->save();
            }
            else {
                $extension = explode('/', mime_content_type($this->photo_new))[1];
                // dd($extension);
                $filePath = time() . '-beneficiary.' . $extension;
                $img = Image::make($this->photo_new);
                $img->save('storage/beneficiary-photo/' . $filePath);
                $this->beneficiary->photo = 'storage/beneficiary-photo/' . $filePath;
                $this->beneficiary->save();
            }
        }
        if ($this->beneficiary_file_new) {
            if($this->beneficiary->file) {
                Storage::disk('public_uploads')->delete($this->beneficiary->file);
                $fileName = time() . '-beneficiary.' . $this->beneficiary_file_new->getClientOriginalExtension();
                $this->beneficiary_file_new->storeAs('storage/beneficiary-file/', $fileName, 'public_uploads');
                $this->beneficiary->file = 'storage/beneficiary-file/' . $fileName;
                $this->beneficiary->save();
            }
            else {
                $fileName = time() . '-beneficiary.' . $this->beneficiary_file_new->getClientOriginalExtension();
                $this->beneficiary_file_new->storeAs('storage/beneficiary-file/', $fileName, 'public_uploads');
                $this->beneficiary->file = 'storage/beneficiary-file/' . $fileName;
                $this->beneficiary->save();
            }

        }
        $this->alert('success', 'Registro actualizado correctamente.', [
            'toast' => true,
            'position' => 'top-end',
        ]);
    }
    public function onChangeSelectDepartment()
    {
        $this->departments = Department::all()->where('state', 'ACTIVE');
    }
}
