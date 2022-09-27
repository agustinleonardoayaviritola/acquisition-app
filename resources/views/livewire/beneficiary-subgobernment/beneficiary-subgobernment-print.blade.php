<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Imprimir
        </div>
    </x-slot>


    <div class="flex  m-8 justify-center items-center">
        <div wire:ignore class="justify-center border-dashed bg-white border-2 m-8 p-4">
            <div id="printableArea">

                <div class="flex justify-center items-center">
                    <div class="w-full flex justify-center items-center">
                        @if($this->subgovernment->name == 'SUB GOBERNACIÓN CERCADO')
                            <img src="{{ asset('/images/SUB-GOBERNACION-DE-CERCADO.svg') }}" alt="">

                        @elseif ($this->subgovernment->name == 'SUB GOBERNACIÓN BERMEJO')
                            <img src="{{ asset('/images/SUB-GOBERNACION-DE-BERMEJO.svg') }}" alt="">

                        @elseif ($this->subgovernment->name == 'SUB GOBERNACIÓN EL PUENTE')
                            <img src="{{ asset('/images/SUB-GOBERNACION-EL-PUENTE.svg') }}" alt="">

                        @elseif ($this->subgovernment->name == 'SUB GOBERNACIÓN SAN LORENZO')
                            <img src="{{ asset('/images/SUB-GOBERNACION-DE-SAN-LORENZO.svg') }}" alt="">

                        @elseif ($this->subgovernment->name == 'SUB GOBERNACIÓN ENTRE RIOS')
                            <img src="{{ asset('/images/SUB-GOBERNACION-OCONNOR.svg') }}" alt="">

                        @elseif ($this->subgovernment->name == 'SUB GOBERNACIÓN URIONDO')
                            <img src="{{ asset('/images/SUB-GOBERNACION-DE-URIONDO.svg') }}" alt="">

                        @elseif ($this->subgovernment->name == 'SUB GOBERNACIÓN PADCAYA')
                            <img src="{{ asset('/images/SUB-GOBERNACION-DE-PADCAYA.svg') }}" alt="">

                        @elseif ($this->subgovernment->name == 'SUB GOBERNACIÓN YUNCHARA')
                            <img src="{{ asset('/images/SUB-GOBERNACION-DE-YUNCHARA.svg') }}" alt="">
                        @endif
                    </div>
                    <div class="w-full flex justify-center items-center flex-col">
                        <h1 class="text-2xl font-bold">Recibo Nro. {{ $beneficiary->id }}</h1>
                        <h4 class="text-xl">Fecha {{ $current_date }}</h4>
                    </div>
                </div>
                <hr class=" my-4">
                <table>
                    <tr>
                        <td class="text-base"><b>Registrado por:</b> {{ $userperson->name }}
                            {{ $userperson->lastname }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-base"><b>Nombre del beneficiario:</b> {{ $person->name }}
                            {{ $person->lastname }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-base"><b>Fecha de registro: </b> {{ $date_register }}</td>
                    </tr>
                    <tr>
                        @if($beneficiary_state->name === 'HABILITADO')
                            <td class="text-base "><b>Estado del Beneficiario: </b><b class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-lime-300 text-lime-600 uppercase">{{ $beneficiary_state->name }}</b></td> 
                        @else
                            <td class="text-base "><b>Estado del Beneficiario: </b><b class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-600 uppercase">{{ $beneficiary_state->name }}</b></td>
                        @endif
                    </tr>
                    <tr>
                    </tr>
                </table>
                <hr class=" my-4">
                @if($beneficiary_state->name === 'HABILITADO')
                    <h1 class="text-center  text-xs leading-5 font-semibold rounded-full  text-lime-600 uppercase">Usted está habilitado para esta gestión de la canasta adulto mayor</h1>
                @else
                    <h1 class="text-center  text-xs leading-5 font-semibold rounded-full  text-yellow-600 uppercase">Usted estára habilitado para la siguiente gestión de la canasta adulto mayor</h1>
                @endif   
                <hr class=" my-4">
            </div>
            <div class="justify-center flex">
                <div class="container m-auto bg-white rounded-md w-96 p-1 mt-5 mb-10">
                    <x-jet-button id="btn_print" onclick="printDiv('printableArea')"
                        class=" h-12 w-full rounded-full flex items-center bg-primary-500  justify-center">
                        <i class="fas fa-print"></i>&nbsp; Imprimir
                    </x-jet-button>
    
                    <script>
                        function printDiv(divName) {
                            console.log('entrando');
                            $("#btn_print").hide();
                            var printContents = document.getElementById(divName).innerHTML;
                            var originalContents = document.body.innerHTML;
    
                            document.body.innerHTML = printContents;
    
                            window.print();
    
                            document.body.innerHTML = originalContents;
    
                            $("#btn_print").show();
                        }
                    </script>
                </div>
                <div class="container m-auto bg-white rounded-md w-96 p-1 mt-5 mb-10">
                    <x-jet-button wire:click="confirmedReturnBeneficiary"
                        class=" h-12 w-full rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-house"></i>&nbsp; Volver a la lista de Beneficiarios
                    </x-jet-button>
                </div>
            </div>

        </div>

    </div>

</div>