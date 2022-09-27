<?php

namespace App\Http\Livewire\DeliveryBasketSubgobernment;

use Livewire\Component;
use App\Models\DeliveryBasket;
use App\Models\MunicipalityBasket;
use App\Models\User;
use App\Models\Person;
use App\Models\DocumentPerson;
use App\Models\Beneficiary;
use App\Models\DeliveryPoint;
use App\Models\Subgovernment;
use App\Models\Delivery;

use App\Models\NeighborhoodCommunity;
use App\Models\Country;
use App\Models\Department;
use App\Models\Gender;
use App\Models\Profession;
use App\Models\Province;

use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Image;

class DeliveryBasketSubgobernmentCreate extends Component
{


    use LivewireAlert;
    use WithFileUploads;
    public $beneficiary_id;
    public $delivery_point_id;
    public $delivery_id;
    public $state = "ACTIVE";
    public $state_delivery = "ENTREGADO";
    
    public $photo_new;

    public $current_date;
    public $deliverybasket;
    ///
    public $amount;
    public $amount_sum;
    /// UPDATE
    public $name;
    public $lastname;
    public $date_birth;
    public $gender_id;

    // document_person
    public $document_number;
    public $document_issuance;
    public $document_supplement;

    public $beneficiary;
    public $profession_id;
    public $country_id;
    public $department_id;
    public $province_id;

    public $genders;
    public $professions;
    public $countries;
    public $departments;
    public $provinces;


    public function render()
    {
        return view('livewire.delivery-basket-subgobernment.delivery-basket-subgobernment-create');
    }
    public function mount($slug)
    {
        $this->current_date = date('m-d-Y', time());
        $this->beneficiary = Beneficiary::where('slug', $slug)->firstOrFail();
        $this->person = Person::where('id', $this->beneficiary->person_id)->firstOrFail();
        $this->documentperson = DocumentPerson::where('person_id', $this->person->id)->firstOrFail();   
        $this->deliverypoints = DeliveryPoint::all()->where('state', '=', 'ACTIVE')->where('subgovernment_code', '=', auth()->user()->subgovernment_code);
        $this->deliveries = Delivery::where('state', '=', 'ACTIVE')->where('subgovernment_code', '=', auth()->user()->subgovernment_code)->get();
        if ($this->person) {
            $this->name = $this->person->name;
            $this->lastname = $this->person->lastname;
            $this->date_birth = $this->person->date_birth;
            $this->gender_id = $this->person->gender_id;
        }
        if ($this->documentperson) {
            //dd($this->documentperson);
            $this->document_number = $this->documentperson->document_number;
            $this->document_issuance = $this->documentperson->document_issuance;
            $this->document_supplement = $this->documentperson->document_supplement;
        }
        if ($this->beneficiary) {
            $this->profession_id = $this->beneficiary->profession_id;
            $this->country_id = $this->beneficiary->country_id;
            $this->department_id = $this->beneficiary->department_id;
            $this->neighborhood_community_id = $this->beneficiary->neighborhood_community_id;
        }


        ///
        $this->genders = Gender::all()->where('state', 'ACTIVE');
        $this->professions = Profession::all()->where('state', 'ACTIVE');
        $this->countries = Country::all()->where('state', 'ACTIVE');
        $this->departments = Department::all()->where('state', 'ACTIVE');
        
    }
    public function onChangeSelectDelivery()
    {
        $this->deliveries = Delivery::all()->where('state', '=', 'ACTIVE')->where('subgovernment_code', '=', auth()->user()->subgovernment_code);

    }
    public function onChangeSelectDeliveryPoint()
    {
        $this->deliverypoints = DeliveryPoint::all()->where('state', '=', 'ACTIVE')->where('subgovernment_code', '=', auth()->user()->subgovernment_code);

    }
    protected $rules = [
        'delivery_point_id' =>'required',
        'delivery_id' =>'required',
                         
    ];
    public function submit()
    {
        $this->validate();
        $this->deliveryVerifi = Delivery::where('id', $this->delivery_id)->firstOrFail();

        if($this->deliveryVerifi->number_baskets === 0) {

            $this->confirm('Ya no hay canastas disponibles para esta entrega', [
                'icon' => 'erro',
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'showCancelButton' => false,
                'confirmButtonText' => 'Aceptar',
            ]);

        }
        else {

            $this->DataPoint = Subgovernment::where('slug', auth()->user()->subgovernment_code)->first();

            try {
                $verify_delivery = DeliveryBasket::where('beneficiary_id', $this->beneficiary->id)->where('delivery_id', $this->delivery_id)->firstOrFail();
                if($verify_delivery) {
    
                    $this->confirm('El beneficiario "'.$this->person->name.' '.$this->person->lastname.'" ya adquirió esta canasta de esta versión.', [
                        'icon' => 'warning',
                        'toast' => false,
                        'text' =>  $this->person->name.' '.$this->person->lastname,
                        'position' => 'center',
                        'showConfirmButton' => true,
                        'showCancelButton' => false,
                        'confirmButtonText' => 'Aceptar',
                    ]);
                
                }
            }
            catch (\Exception $error) {

                $this->person->update([

                    'name' => $this->name,
                    'lastname' => $this->lastname,
                    'date_birth' => $this->date_birth,
                    'gender_id' => $this->gender_id,
                ]);
                $this->documentperson->update([
                    'document_number' => $this->document_number,
                    'document_issuance' => $this->document_issuance,
                    'document_supplement' => $this->document_supplement,
                ]);
                $this->beneficiary->update([
                    'user_id' => Auth()->User()->id,
                    'country_id' => $this->country_id,
                    'department_id' => $this->department_id,
                    'neighborhood_community_id' => $this->neighborhood_community_id,
                ]);
    
                $this->deliverybasket = new DeliveryBasket();
                $this->deliverybasket->user_id = Auth()->User()->id;
                $this->deliverybasket->beneficiary_id = $this->beneficiary->id;
                $this->deliverybasket->delivery_id = $this->delivery_id;
                $this->deliverybasket->delivery_point_id = $this->delivery_point_id;
                $this->deliverybasket->subgovernment_code = auth()->user()->subgovernment_code;
                $this->deliverybasket->date_delivery = $this->current_date;
                $this->deliverybasket->state = $this->state;
                $this->deliverybasket->state_delivery = $this->state_delivery;
                $this->deliverybasket->municipality_id = $this->DataPoint->municipality_id;
                $this->deliverybasket->slug = Str::uuid();
                $this->deliverybasket->save();
                
                $this->delivery = Delivery::where('id', $this->deliverybasket->delivery_id)->firstOrFail();
    
                $this->municipalitybasket = MunicipalityBasket::where('id', $this->delivery->municipality_basket_id)->firstOrFail();
    
                $this->amount = $this->delivery->number_baskets -1;
                $this->amount_sum = $this->municipalitybasket->number_baskets_delivered +1;
    
                $this->delivery->update([
                    'number_baskets'=> $this->amount,
                    'number_baskets_delivered'=> $this->amount_sum,
                ]);
    
                $this->municipalitybasket->update([
                    'number_baskets'=> $this->amount,
                    'number_baskets_delivered'=> $this->amount_sum,
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

        }


    }
    public function cleanInputs()
    {
        $this->delivery_point_id = "";
        $this->delivery_id = "";
    }
    public function onChangeSelectDepartment()
    {
        $this->departments = Department::all()->where('state', 'ACTIVE');
    }
    protected $listeners = [
        'confirmed',
       ];
    public function confirmed()
    {   
        return redirect()->route('delivery-basket-subgobernment.print', ['slug'=>$this->deliverybasket->slug]);
    }
}
