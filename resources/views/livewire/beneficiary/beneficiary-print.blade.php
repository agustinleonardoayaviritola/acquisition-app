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
                        <img src="{{ asset('/images/logo-gobernacion.svg') }}" alt="">
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
                        <td class="text-base"><b>Estado del Beneficiario: </b> {{ $beneficiary_state->name }}</td>
                    </tr>
                    <tr>
                    </tr>
                </table>
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
                    <x-jet-button wire:click="$emit('ReturnBeneficiary')"
                        class=" h-12 w-full rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-house"></i>&nbsp; Volver a la lista de Beneficiarios
                    </x-jet-button>
                </div>
            </div>

        </div>

    </div>

</div>
