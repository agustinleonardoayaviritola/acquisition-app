<?php

namespace App\Http\Livewire\Subgovernment;

use Livewire\Component;
use App\Models\Subgovernment;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Image;

class SubgovernmentUpdate extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    //product
    public $namesub;
    public $description;
    public $state;
    public $photo;
    public $photo_new;

    public function mount($slug)
    {

        $this->subgovernment = Subgovernment::where('slug', $slug)->firstOrFail();
        if ($this->subgovernment) {
            //cargando datos del profession
            $this->name = $this->subgovernment->name;
            $this->photo = $this->subgovernment->photo;
            $this->description = $this->subgovernment->description;
            $this->state = $this->subgovernment->state;
        }
    }

    public function render()
    {
        return view('livewire.subgovernment.subgovernment-update');
    }

    protected $rules = [
        //restriccion subgovernment
        'name' => 'required|max:100|min:2|unique:subgovernments,name',
        'description' => 'nullable',
        'state' =>'required',

    ];
    public function submit()
    {
        $this->rules['name'] = 'required|unique:subgovernments,name,'. $this->subgovernment->id;
        $this->validate();

        $this->subgovernment->update([
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state,
        ]);

        if ($this->photo_new) {
            if($this->subgovernment->photo) {
                Storage::disk('public_uploads')->delete($this->subgovernment->photo);

                $filePath = time() . '-capture.' . $this->photo_new->getClientOriginalExtension();
                $img = Image::make($this->photo_new);
                $img->save('storage/capture-photo-subgovernment/' . $filePath);
                $this->subgovernment->photo = 'storage/capture-photo-subgovernment/' . $filePath;
                $this->subgovernment->save();
            }
            else {
                $filePath = time() . '-capture.' . $this->photo_new->getClientOriginalExtension();
                $img = Image::make($this->photo_new);
                $img->save('storage/capture-photo-subgovernment/' . $filePath);
                $this->subgovernment->photo = 'storage/capture-photo-subgovernment/' . $filePath;
                $this->subgovernment->save();
            }
        }

        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',

        ]);
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

}
