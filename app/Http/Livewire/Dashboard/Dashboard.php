<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\MunicipalityBasket;
use App\Models\Subgovernment;
use App\Models\Delivery;
use App\Models\Basket;
use App\Models\Beneficiary;


class Dashboard extends Component
{    
    ////CERCADO
    public $codigocercado = 'f6734450-80aa-454f-9aa5-465465523d36';
    public $subcercadototal;
    public $subcercadonuevos;
    public $subcercadoinhabilitados;
    public $subcercadohabilitados;
    //public $subcercadototal;
    ////BERMEJO
    public $codigobermejo = 'bf4d54a5-ce78-467f-9764-b0271ea46e6f';
    public $subbermejo;
    public $subbermejonuevos;
    public $subbermejoinhabilitados;
    public $subbermejohabilitados;
    ////EL PUENTE
    public $codigoelpuente = 'd2e878d1-3118-4c27-a030-cd30b681cc01';
    public $subelpuente;
    public $subelpuentenuevos;
    public $subelpuenteinhabilitados;
    public $subelpuentehabilitados;
    ////SAN LORENZO
    public $codigosanlorenzo = '96b0e2aa-199b-4036-8524-0090316068d2';
    public $subsanlorenzo;
    public $subsanlorenzonuevos;
    public $subsanlorenzoinhabilitados;
    public $subsanlorenzohabilitados;
    /// ENTRE RIOS
    public $codigoentrerios = 'c6e09bef-bd81-4821-9f5e-453f1fde70ab';
    public $subentrerios;
    public $subentreriosnuevos;
    public $subentreriosinhabilitados;
    public $subentrerioshabilitados;
    ////URIONDO
    public $codigouriondo = '24dd3f69-5246-45dc-86d8-2a265b9cb259';
    public $suburiondo;
    public $suburiondonuevos;
    public $suburiondoinhabilitados;
    public $suburiondohabilitados;
    ////PADCAYA
    public $codigopadcaya = 'abb9d2dd-d9f0-4a92-90fa-9b4e988d0203';
    public $subpadcaya;
    public $subpadcayanuevos;
    public $subpadcayainhabilitados;
    public $subpadcayahabilitados;
    ///YUNCHARA
    public $codigoyunchara = '00681ae2-17ff-419d-a79f-70ab42a6ff0b';
    public $subyunchara;
    public $subyuncharanuevos;
    public $subyuncharainhabilitados;
    public $subyuncharahabilitados;
    /////


    public function mount()
    {
        
        try {
            $this->datasubgovernment = MunicipalityBasket::where('state', '=', 'ACTIVE')->get();
            $this->datadelivery = Delivery::where('state', '=', 'ACTIVE')->get();
            $this->databaskets = Basket::where('state', '=', 'ACTIVE')->get();
            //dd($this->datadelivery[0]->municipality_basket_id);
            $this->subgovernment = Subgovernment::where('state', '=', 'ACTIVE')->get();


            ////CERCADO

            $this->subcercadototal = Beneficiary::where('subgovernment_code', 'f6734450-80aa-454f-9aa5-465465523d36')->get()->count();
            $this->subcercadonuevos = Beneficiary::where('subgovernment_code', 'f6734450-80aa-454f-9aa5-465465523d36')->where('beneficiary_state_id', 2)->get()->count();
            $this->subcercadoinhabilitados = Beneficiary::where('subgovernment_code', 'f6734450-80aa-454f-9aa5-465465523d36')->where('beneficiary_state_id', 5)->get()->count();
            $this->subcercadohabilitados = Beneficiary::where('subgovernment_code', 'f6734450-80aa-454f-9aa5-465465523d36')->where('beneficiary_state_id', 1)->get()->count();

            ////BERMEJO
            $this->subbermejo = Beneficiary::where('subgovernment_code', 'bf4d54a5-ce78-467f-9764-b0271ea46e6f')->get()->count();
            $this->subbermejonuevos = Beneficiary::where('subgovernment_code', 'bf4d54a5-ce78-467f-9764-b0271ea46e6f')->where('beneficiary_state_id', 2)->get()->count();
            $this->subbermejoinhabilitados = Beneficiary::where('subgovernment_code', 'bf4d54a5-ce78-467f-9764-b0271ea46e6f')->where('beneficiary_state_id', 5)->get()->count();
            $this->subbermejohabilitados = Beneficiary::where('subgovernment_code', 'bf4d54a5-ce78-467f-9764-b0271ea46e6f')->where('beneficiary_state_id', 1)->get()->count();

            ////EL PUENTE
            $this->subelpuente = Beneficiary::where('subgovernment_code', 'd2e878d1-3118-4c27-a030-cd30b681cc01')->get()->count();
            $this->subelpuentenuevos = Beneficiary::where('subgovernment_code', 'd2e878d1-3118-4c27-a030-cd30b681cc01')->where('beneficiary_state_id', 2)->get()->count();
            $this->subelpuenteinhabilitados = Beneficiary::where('subgovernment_code', 'd2e878d1-3118-4c27-a030-cd30b681cc01')->where('beneficiary_state_id', 5)->get()->count();
            $this->subelpuentehabilitados = Beneficiary::where('subgovernment_code', 'd2e878d1-3118-4c27-a030-cd30b681cc01')->where('beneficiary_state_id', 1)->get()->count();

            /////SAN LORENZO
            $this->subsanlorenzo = Beneficiary::where('subgovernment_code', '96b0e2aa-199b-4036-8524-0090316068d2')->get()->count();
            $this->subsanlorenzonuevos = Beneficiary::where('subgovernment_code', '96b0e2aa-199b-4036-8524-0090316068d2')->where('beneficiary_state_id', 2)->get()->count();
            $this->subsanlorenzoinhabilitados = Beneficiary::where('subgovernment_code', '96b0e2aa-199b-4036-8524-0090316068d2')->where('beneficiary_state_id', 5)->get()->count();
            $this->subsanlorenzohabilitados = Beneficiary::where('subgovernment_code', '96b0e2aa-199b-4036-8524-0090316068d2')->where('beneficiary_state_id', 1)->get()->count();

            /////ENTRE RIOS
            $this->subentrerios = Beneficiary::where('subgovernment_code', 'c6e09bef-bd81-4821-9f5e-453f1fde70ab')->get()->count();
            $this->subentreriosnuevos = Beneficiary::where('subgovernment_code', 'c6e09bef-bd81-4821-9f5e-453f1fde70ab')->where('beneficiary_state_id', 2)->get()->count();
            $this->subentreriosinhabilitados = Beneficiary::where('subgovernment_code', 'c6e09bef-bd81-4821-9f5e-453f1fde70ab')->where('beneficiary_state_id', 5)->get()->count();
            $this->subentrerioshabilitados = Beneficiary::where('subgovernment_code', 'c6e09bef-bd81-4821-9f5e-453f1fde70ab')->where('beneficiary_state_id', 1)->get()->count();

            ////URIONDO
            $this->suburiondo = Beneficiary::where('subgovernment_code', '24dd3f69-5246-45dc-86d8-2a265b9cb259')->get()->count();
            $this->suburiondonuevos = Beneficiary::where('subgovernment_code', '24dd3f69-5246-45dc-86d8-2a265b9cb259')->where('beneficiary_state_id', 2)->get()->count();
            $this->suburiondoinhabilitados = Beneficiary::where('subgovernment_code', '24dd3f69-5246-45dc-86d8-2a265b9cb259')->where('beneficiary_state_id', 5)->get()->count();
            $this->suburiondohabilitados = Beneficiary::where('subgovernment_code', '24dd3f69-5246-45dc-86d8-2a265b9cb259')->where('beneficiary_state_id', 1)->get()->count();

            ///PADCAYA
            $this->subpadcaya = Beneficiary::where('subgovernment_code', 'abb9d2dd-d9f0-4a92-90fa-9b4e988d0203')->get()->count();
            $this->subpadcayanuevos = Beneficiary::where('subgovernment_code', 'abb9d2dd-d9f0-4a92-90fa-9b4e988d0203')->where('beneficiary_state_id', 2)->get()->count();
            $this->subpadcayainhabilitados = Beneficiary::where('subgovernment_code', 'abb9d2dd-d9f0-4a92-90fa-9b4e988d0203')->where('beneficiary_state_id', 5)->get()->count();
            $this->subpadcayahabilitados = Beneficiary::where('subgovernment_code', 'abb9d2dd-d9f0-4a92-90fa-9b4e988d0203')->where('beneficiary_state_id', 1)->get()->count();

            ///YUNCHARA
            $this->subyunchara = Beneficiary::where('subgovernment_code', '00681ae2-17ff-419d-a79f-70ab42a6ff0b')->get()->count();
            $this->subyuncharanuevos = Beneficiary::where('subgovernment_code', '00681ae2-17ff-419d-a79f-70ab42a6ff0b')->where('beneficiary_state_id', 2)->get()->count();
            $this->subyuncharainhabilitados = Beneficiary::where('subgovernment_code', '00681ae2-17ff-419d-a79f-70ab42a6ff0b')->where('beneficiary_state_id', 5)->get()->count();
            $this->subyuncharahabilitados = Beneficiary::where('subgovernment_code', '00681ae2-17ff-419d-a79f-70ab42a6ff0b')->where('beneficiary_state_id', 1)->get()->count();

            
        }
        catch (\Exception $error) {
            return $error->getMessage();
        }
/*         foreach($this->datasubgovernment as $item)
        {
            dd($item);
        } */
    }
    public function render()
    {
        //return view('livewire.dashboard.dashboard')->layout('dashboard');
        return view('livewire.dashboard.dashboard');
    }
}
