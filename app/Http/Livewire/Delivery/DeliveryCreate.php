<?php

namespace App\Http\Livewire\Delivery;

use Livewire\Component;
use App\Models\MunicipalityBasket;
use App\Models\Basket;
use App\Models\Delivery;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DeliveryCreate extends Component
{
    
    use LivewireAlert; 
    //varibles para propiedades
    public $start_date;
    public $end_date;
    public $number_baskets;
    public $description;
    public $state = "ACTIVE";
    public $slug;
    public $municipality_basket_id;
    public $basket_id;
    public $month;
    ///
    public $amount;

   public function mount()
   {
    $this->municipalitybaskets = MunicipalityBasket::all();
    $this->baskets = Basket::all();
   }

   public function render()
   {
       return view('livewire.delivery.delivery-create');
   }

    //reglas para validacion
    protected $rules = [
        'municipality_basket_id' =>'required',
        'basket_id' =>'required',
        'description' =>'required',
        'number_baskets' =>'required',
        'end_date' =>'required',
        'start_date' =>'required',
        'state' => 'required',
                         
    ];

    //Metodo que llama el formulario
    public function submit()
    {

     //Funcion para validar mediante las reglas
     $this->validate();
     $this->basketmunicipality=MunicipalityBasket::where('id', $this->municipality_basket_id)->firstOrFail();
     if ($this->number_baskets > $this->basketmunicipality->number_baskets) {

        $this->confirm('La cantidad de canastas asignadas, no pude ser mayor a las que hay para la Gestión.', [
            'icon' => 'warning',
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'showCancelButton' => false,
            'confirmButtonText' => 'Aceptar',
        ]);

     } else {

        //Creando registro
        Delivery::create([
            'user_id' => Auth()->User()->id,
            'municipality_basket_id' => $this->municipality_basket_id,
            'basket_id' => $this->basket_id,
            'description' => $this->description,
            'month' => $this->month,
            'number_baskets' => $this->number_baskets,
            'number_baskets_total' => $this->number_baskets,
            'end_date' => $this->end_date,
            'start_date' => $this->start_date,
        
            //generar slug
            'state' => $this->state,
            'slug' => Str::uuid(),

            ]);

            $this->basketmunicipality=MunicipalityBasket::where('id', $this->municipality_basket_id)->firstOrFail();
            $amount = $this->basketmunicipality->number_baskets;

            $this->basketmunicipality->update([
                'number_baskets'=> $amount - $this->number_baskets,
            ]);

            //Llamando a funcion para limpiar inputs
            $this->cleanInputs();

            //Mostrar alerta de registro
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

        //Funcion para limpiar imputs
        public function cleanInputs()
        {
            $this->municipality_basket_id = "";
            $this->basket_id = "";
            $this->end_date = "";
            $this->description = "";
            $this->start_date = "";
            $this->number_baskets = "";
        }
        public function onChangeSelectMunicipalityBasket()
        {
            $this->municipalitybaskets = MunicipalityBasket::all();
        }
        public function onChangeSelectBasket()
        {
            $this->baskets = Basket::all();
        }

        //Escuchadores para botones de alertas
        protected $listeners = [
             'confirmed',
            ];

            //Funcion que llama la alerta para redigir al dashboard
        public function confirmed()
        {
         return redirect()->route('delivery.dashboard');
        }
}
