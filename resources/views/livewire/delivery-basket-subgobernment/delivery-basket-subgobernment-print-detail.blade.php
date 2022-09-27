<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Imprimir
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex m-8 justify-center items-center">
            <div wire:ignore class="justify-center border-dashed bg-white border-2 m-8 p-4">
                <div id="printableArea" class="m-10 mt-0 p-4">
                    

                    <div class="flex justify-center items-center">
                        <div class="w-full flex justify-center items-center">
                            @if ($this->subgovernment->name == 'SUB GOBERNACIÓN CERCADO')
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
                            <h1 class="text-2xl font-bold">Recibo Nro. {{ $deliverybasket->id }}</h1>
                            <h4 class="text-xl">Fecha {{ $current_date }}</h4>
                        </div>
                    </div>
                    <hr class=" my-4">
                    <div class="w-full flex justify-center items-center flex-col">
                        <h1 class="font-bold">FORMULARIO DE COMPROBANTE DE ENTREGA CANASTA ALIMENTARIA PARA EL ADULTO
                            MAYOR
                        </h1>
                        <h1 class="text-xl">({{ $delivery->description }})</h1>
                    </div>
                    <hr class=" my-4">
                    <table>
                        <tr>
                            <td class="text-base"><b>Nombre del beneficiario:</b> {{ $person->name }}
                                {{ $person->lastname }}
                            </td>
                            @if ($documentperson->document_supplement)
                                <td class="text-base"><b>CI:</b> {{ $documentperson->document_number }}{{$documentperson->document_supplement}}
                                </td>
                            @else
                            <td class="text-base"><b>CI:</b> {{ $documentperson->document_number }}
                            </td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-base"><b>Distrito/Canton:</b> {{ $cantondistrict->name }}</td>
                            <td class="text-base"><b>Barrio/Comunidad:</b> {{ $neighborhoodcommunity->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-base"><b>Fecha de entrega: </b> {{ $deliverybasket->date_delivery }}</td>
                            <td class="text-base"><b>Entregado por: </b> {{ $userperson->name }}
                                {{ $userperson->lastname }}</td>
                        </tr>
                    </table>
                    <hr class=" my-4">
                    <table class="w-full">
                        <thead>
                            <tr class="border-2 bg-gray-200">
                                <th class="border-2 border-gray-300">PRODUCTOS</th>
                                <th class="border-2 border-gray-300">CONTENIDO</th>
                                <th class="border-2 border-gray-300">UNIDAD</th>
                            </tr>
                            <tr class="border-2 border-gray-300 bg-gray-200">
                                <th class="border-2 border-gray-300" colspan="3">{{ $delivery->description }}</th>
                            </tr>
                        </thead>
                        {{-- @foreach --}}
                        @forelse ($basketproducts as $item)
                            <tr>
                                <td class="border-2">
                                    {{ $item->product->name }}
                                </td>
                                <td class="border-2">
                                    {{ $item->product->description }}
                                </td>
                                <td class="border-2">
                                    {{ $item->amount }}
                                </td>
                            </tr>
                        @empty
                            <p>sin registros</p>
                        @endforelse
                        {{-- @endforeach --}}
                    </table>
                    <div class="justify-center flex mt-6 pt-6">

                        <div class="h-12 w-full font-bold flex items-center  justify-center">
                            <p>ENTREGUE CONFORME</p>
                        </div>
                        <div class="h-12 w-full font-bold flex items-center  justify-center">
                            <p>RECIBI CONFORME</p>
                        </div>
                    </div>
                </div>
                <div class="justify-center flex">
                    <div class="container m-auto bg-white rounded-md w-96 p-1 mt-5 mb-10">
                        <x-jet-button id="btn_print" onclick="printDiv('printableArea')"
                            class=" h-12 w-full rounded-full flex items-center bg-primary-500  justify-center">
                            <i class="fas fa-print"></i>&nbsp; Imprimir
                        </x-jet-button>

                        <script>
                            function printDiv(divName) {

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
                        <a href="{{ route('delivery-basket-subgobernment.dashboard') }}"
                            class="h-12 w-full bg-slate-600 text-white rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-house"></i>&nbsp; Volver a la lista de entregas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
