<?php

namespace App\Http\Livewire\Province;

use Livewire\Component;
use App\Models\Province;
use App\Models\Department;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProvinceUpdate extends Component
{
    use LivewireAlert;
    //profession
    public $name;
    public $description;
    public $state;

    public function mount($slug)
    {

        $this->province = Province::where('slug', $slug)->firstOrFail();
        $this->departments = Department::all();
        if ($this->province) {
            //cargando datos del provincia
            $this->department_id = $this->province->department_id;
            $this->name = $this->province->name;
            $this->description = $this->province->description;
            $this->state = $this->province->state;
        }
    }
    public function render()
    {
        return view('livewire.province.province-update');
    }
    protected $rules = [
        //restriccion province
        'name' => 'required|max:255|min:2|unique:professions,name',
        'state' =>'required',

    ];
    public function submit()
    {
        $this->rules['name'] = 'required|unique:professions,name,' . $this->province->id;
        $this->validate();

        $this->province->update([
            'name' => strtoupper($this->name),
            'department_id' => $this->department_id,
            'description' => $this->description,
            'state' => $this->state,
        ]);

        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',

        ]);
    }
    public function onChangeSelectDepartment()
    {
        $this->departments = Department::all();
    }
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];
    //Funcion que llama la alerta para redigir al dashboar
    public function confirmed()
    {
        //return redirect()->route('province.Update');
    }


}
