<div wire:poll.1000ms>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Entregas
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class=" text-primary-400 flex justify-end ...">{{ now() }}</div>
        <div class="w-full flex justify-start space-x-2 container bg-white  grid grid-cols-2 gap-2">
            <div class="my-2 mx-4">
                <h1 class="text-2xl">{{ $subgovernment->name }}</h1>
                <h1 class="text-lg">Detalle de Canastas asignadas</h1>
                @if ($deliverysubgobernment)
                    <h1 class="text-lg ">Canastas totales de la entrega vigente:
                        {{ $deliverysubgobernment->number_baskets_total }}
                    </h1>
                    <hr class=" mt-2">
                    <h2 class="text-lg">Canastas restantes para la entrega vigente:
                        {{ $deliverysubgobernment->number_baskets }}
                    </h2>
                    <hr class=" mt-2">
                    <h2 class="text-lg">Canastas entregadas: {{ $deliverysubgobernment->number_baskets_delivered }}
                    </h2>
                @else
                    <h1 class="text-lg ">Canastas totales por gestion: "No hay canastas asignadas"</h1>
                    <h2 class="text-lg">Canastas restantes para la gestion: "No hay canastas asignadas"</h2>
                @endif
            </div>
            <div class="relative top-4.5 right-0 ...">
                @if ($this->subgovernment->name == 'SUB GOBERNACIÓN CERCADO')
                    <img class="object-center object-fill h-36 w-96 -m-4"
                        src="{{ asset('/images/SUB-GOBERNACION-DE-CERCADO.svg') }}" alt="">
                @elseif ($this->subgovernment->name == 'SUB GOBERNACIÓN BERMEJO')
                    <img class="object-center object-fill h-36 w-96 -m-4"
                        src="{{ asset('/images/SUB-GOBERNACION-DE-BERMEJO.svg') }}" alt="">
                @elseif ($this->subgovernment->name == 'SUB GOBERNACIÓN EL PUENTE')
                    <img class="object-center object-fill h-36 w-96 -m-4"
                        src="{{ asset('/images/SUB-GOBERNACION-EL-PUENTE.svg') }}" alt="">
                @elseif ($this->subgovernment->name == 'SUB GOBERNACIÓN SAN LORENZO')
                    <img class="object-center object-fill h-36 w-96 -m-4"
                        src="{{ asset('/images/SUB-GOBERNACION-DE-SAN-LORENZO.svg') }}" alt="">
                @elseif ($this->subgovernment->name == 'SUB GOBERNACIÓN ENTRE RIOS')
                    <img class="object-center object-fill h-36 w-96 -m-4"
                        src="{{ asset('/images/SUB-GOBERNACION-OCONNOR.svg') }}" alt="">
                @elseif ($this->subgovernment->name == 'SUB GOBERNACIÓN URIONDO')
                    <img class="object-center object-fill h-36 w-96 -m-4"
                        src="{{ asset('/images/SUB-GOBERNACION-DE-URIONDO.svg') }}" alt="">
                @elseif ($this->subgovernment->name == 'SUB GOBERNACIÓN PADCAYA')
                    <img class="object-center object-fill h-36 w-96 -m-4"
                        src="{{ asset('/images/SUB-GOBERNACION-DE-PADCAYA.svg') }}" alt="">
                @elseif ($this->subgovernment->name == 'SUB GOBERNACIÓN YUNCHARA')
                    <img class="object-center object-fill h-36 w-96 -m-4"
                        src="{{ asset('/images/SUB-GOBERNACION-DE-YUNCHARA.svg') }}" alt="">
                @endif
            </div>
        </div>
        <div class ="m-5">
            <livewire:delivery-basket-subgobernment.delivery-basket-subgobernment-data-table/>
        </div>
    </div>
</div>