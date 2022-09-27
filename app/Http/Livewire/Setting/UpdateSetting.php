<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use App\Models\Setting;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class UpdateSetting extends Component
{
    use LivewireAlert; 
    public function render()
    {
        return view('livewire.setting.update-setting');
    }
    public function mount($slug)
    {
        $this->setting = Setting::where('slug', $slug)->firstOrFail();
        if ($this->setting) {
            $this->deliveries = $this->setting->deliveries;
            $this->records = $this->setting->records;
            $this->updates = $this->setting->updates;
        }
    }
    public function submit()
    {

        $this->setting->update([
            'deliveries' => $this->deliveries,
            'records' => $this->records,
            'updates' => $this->updates,
        ]);
        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);
    }
}
