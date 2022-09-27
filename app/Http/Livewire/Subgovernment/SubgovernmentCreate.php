<?php

namespace App\Http\Livewire\Subgovernment;

use Livewire\Component;
use App\Models\Subgovernment;
use App\Models\Role;
use App\Models\Person;
use App\Models\Municipality;
use App\Models\DocumentPerson;
use App\Models\IdentityDocumentType;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Image;

class SubgovernmentCreate extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    //subgovernment
    public $name_sub;
    public $description;
    public $state = 'ACTIVE';
    public $photo;
    
    //person
    public $name;
    public $lastname;
    public $address;
    public $num_address;
    public $date_birth;

    // document_person
    public $document_number;
    public $document_issuance;
    public $document_supplement;

    // user
    public $email;
    public $password;


    //Rol
    public $role_id=3;
    public $user_id;

    //Municipality
    public $municipality_id;


    public function mount()
    {
        $this->municipalities = Municipality::all();
        
    }

    public function render()
    {
        return view('livewire.subgovernment.subgovernment-create');
    }

    protected $rules = [
        //restriccion profession
        'name_sub' => 'required|max:100|min:2|unique:subgovernments,name',
        'description' => 'nullable',
        'state' => 'required',
        //restriccion person
        'name' => 'required|max:100|min:2',
        'address' => 'nullable',
        //restriccion user
        'email' => 'unique:users|email',
        'password' => 'nullable',

    ];
    //Metodo que llama el formulario
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->validate();

        // verificacmos si existe la persona
        $PersonExists = DocumentPerson::where('document_number', $this->document_number)->first();
        if (!$PersonExists) {

            $Person = Person::create([
                'name' => $this->name,
                'lastname' => $this->lastname,
                'address' => $this->address,
                'num_address' => $this->num_address,
                'date_birth' => $this->date_birth,
            ]);
            $DocumentPerson = DocumentPerson::create([
                'person_id' => $Person->id,
                'document_type_id' => 1,
                'document_number' => $this->document_number,
                'document_issuance' => $this->document_issuance,
                'document_supplement' => $this->document_supplement,
            ]);

            //Creando registro customer
            $User = User::create([
                'person_id' => $Person->id,
                'email' => $this->email,
                'email_verified_at' => now(),
                'password' => bcrypt($this->password),
                'remember_token' => Str::random(10),
                //encriptando slug
                'slug' => Str::slug(bcrypt(time())),
                'state' => $this->state,
            ]);
            //Creando registro de asignacion de Rol
            $Rol = Role::find($this->role_id);
            if ($Rol) {
                $User->roles()->attach($Rol);
            }
            if($this->photo){
                $Subgovernment = Subgovernment::create([
                    'user_id'=>$User->id,
                    'name' => $this->name_sub,
                    'photo' => $this->photo,
                    'description' => $this->description,
                    'municipality_id' => $this->municipality_id,
                    //encriptando slug
                    'slug' => Str::uuid(),
                    'state' => $this->state,
                ]);

                if ($this->photo) {
                    $filePath = time() . '-capture.' . $this->photo->getClientOriginalExtension();
                    $img = Image::make($this->photo);
                    $img->save('storage/capture-photo-subgovernment/' . $filePath);
                    $Subgovernment->photo = 'storage/capture-photo-subgovernment/' . $filePath;
                    $Subgovernment->save();
                }
            }
            else {
                $Subgovernment = Subgovernment::create([
                    'user_id'=>$User->id,
                    'name' => $this->name_sub,
                    'description' => $this->description,
                    'municipality_id' => $this->municipality_id,
                    //encriptando slug
                    'slug' => Str::uuid(),
                    'state' => $this->state,
                ]);

            }


            $this->user=User::where('slug', $User->slug)->firstOrFail();
            $this->user->update([
                'subgovernment_code'=>$Subgovernment->slug,
            ]);    
        }
        else
        {
            //Creando registro customer
            $User = User::create([
                'person_id' => $PersonExists->person_id,
                'email' => $this->email,
                'email_verified_at' => now(),
                'password' => bcrypt($this->password),
                'remember_token' => Str::random(10),
                //encriptando slug
                'slug' => Str::slug(bcrypt(time())),
                'state' => $this->state,
            ]);
            //Creando registro de asignacion de Rol
            $Rol = Role::find($this->role_id);
            if ($Rol) {
                $User->roles()->attach($Rol);
            }

            if($this->photo){
                $Subgovernment = Subgovernment::create([
                    'user_id'=>$User->id,
                    'name' => $this->name_sub,
                    'photo' => $this->photo,
                    'description' => $this->description,
                    'municipality_id' => $this->municipality_id,
                    //encriptando slug
                    'slug' => Str::uuid(),
                    'state' => $this->state,
                ]);

                if ($this->photo) {
                    $filePath = time() . '-capture.' . $this->photo->getClientOriginalExtension();
                    $img = Image::make($this->photo);
                    $img->save('storage/capture-photo-subgovernment/' . $filePath);
                    $Subgovernment->photo = 'storage/capture-photo-subgovernment/' . $filePath;
                    $Subgovernment->save();
                }
            }
            else {
                $Subgovernment = Subgovernment::create([
                    'user_id'=>$User->id,
                    'name' => $this->name_sub,
                    'description' => $this->description,
                    'municipality_id' => $this->municipality_id,
                    //encriptando slug
                    'slug' => Str::uuid(),
                    'state' => $this->state,
                ]);

            }

            $this->user=User::where('slug', $User->slug)->firstOrFail();
            $this->user->update([
                'subgovernment_code'=>$Subgovernment->slug,
            ]); 

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
    //Funcion para limpiar imputs
    public function cleanInputs()
    {
        $this->name_sub = "";
        $this->description = "";
    }
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];
    //Funcion que llama la alerta para redigir al dashboar
    public function confirmed()
    {
        return redirect()->route('subgovernment.dashboard');
    }
    public function onChangeSelectMunicipality()
    {
        $this->municipalities = Municipality::all();
        
    }


}
