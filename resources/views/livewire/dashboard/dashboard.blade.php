<x-slot name="header">
    <label class="font-semibold text-xl text-gray-800 leading-tight">
        Panel de Administración
    </label>
</x-slot>

<div class="my-12 sm:px-6 lg:px-8 space-y-4">

    <div wire:poll.1000ms>
        <div class="text-2xl text-primary-400 font-bold flex justify-center ...">{{ now() }}</div>
    </div>
 
    {{-- SUB GOBERNACIONES --}}

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-items-center" wire:poll.1000ms>
        {{-- start card --}}
        @foreach ($subgovernment as $item)
            <div
                class="md:max-w-xl bg-white rounded-lg border border-gray-200 shadow-md white:bg-gray-800 white:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg" src="../{{ $item->photo }}" alt="" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-1xl font-bold tracking-tight text-gray-400 white:text-white">
                            {{ $item->name }}</h5>
                        <hr class="my-4">
                    </a>
                    @switch(true)
                        @case($item->slug == $codigocercado)
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                <h5 class="text-sm font-bold text-green-700">Total Beneficiarios:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$subcercadototal}}</p>
                                <h5 class="text-sm font-bold text-green-600">Beneficiarios habilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$subcercadohabilitados}}</p>
                                <h5 class="text-sm font-bold text-blue-600">Beneficiarios nuevos:</h5>
                                <p class="pt-5 font-bold mb-3 font-normal text-blue-700 dark:text-blue-700">{{$subcercadonuevos}}</p>
                                <h5 class="text-sm font-bold text-red-600">Beneficiarios inhabilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-red-700 dark:text-red-700">{{$subcercadoinhabilitados}}</p>
                            </div>
                        @break

                        @case($item->slug == $codigobermejo)
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                <h5 class="text-sm font-bold text-green-700">Total Beneficiarios:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$subbermejo}}</p>
                                <h5 class="text-sm font-bold text-green-600">Beneficiarios habilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$subbermejohabilitados}}</p>
                                <h5 class="text-sm font-bold text-blue-600">Beneficiarios nuevos:</h5>
                                <p class="pt-5 font-bold mb-3 font-normal text-blue-700 dark:text-blue-700">{{$subbermejonuevos}}</p>
                                <h5 class="text-sm font-bold text-red-600">Beneficiarios inhabilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-red-700 dark:text-red-700">{{$subbermejoinhabilitados}}</p>
                            </div>
                        @break

                        @case($item->slug == $codigoelpuente)
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                <h5 class="text-sm font-bold text-green-700">Total Beneficiarios:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$subelpuente}}</p>
                                <h5 class="text-sm font-bold text-green-600">Beneficiarios habilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$subelpuentehabilitados}}</p>
                                <h5 class="text-sm font-bold text-blue-600">Beneficiarios nuevos:</h5>
                                <p class="pt-5 font-bold mb-3 font-normal text-blue-700 dark:text-blue-700">{{$subelpuentenuevos}}</p>
                                <h5 class="text-sm font-bold text-red-600">Beneficiarios inhabilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-red-700 dark:text-red-700">{{$subelpuenteinhabilitados}}</p>
                            </div>
                        @break

                        @case($item->slug == $codigosanlorenzo)
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                <h5 class="text-sm font-bold text-green-700">Total Beneficiarios:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$subsanlorenzo}}</p>
                                <h5 class="text-sm font-bold text-green-600">Beneficiarios habilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$subsanlorenzohabilitados}}</p>
                                <h5 class="text-sm font-bold text-blue-600">Beneficiarios nuevos:</h5>
                                <p class="pt-5 font-bold mb-3 font-normal text-blue-700 dark:text-blue-700">{{$subsanlorenzonuevos}}</p>
                                <h5 class="text-sm font-bold text-red-600">Beneficiarios inhabilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-red-700 dark:text-red-700">{{$subsanlorenzoinhabilitados}}</p>
                            </div>
                        @break

                        @case($item->slug == $codigoentrerios)
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                <h5 class="text-sm font-bold text-green-700">Total Beneficiarios:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$subentrerios}}</p>
                                <h5 class="text-sm font-bold text-green-600">Beneficiarios habilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$subentrerioshabilitados}}</p>
                                <h5 class="text-sm font-bold text-blue-600">Beneficiarios nuevos:</h5>
                                <p class="pt-5 font-bold mb-3 font-normal text-blue-700 dark:text-blue-700">{{$subentreriosnuevos}}</p>
                                <h5 class="text-sm font-bold text-red-600">Beneficiarios inhabilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-red-700 dark:text-red-700">{{$subentreriosinhabilitados}}</p>
                            </div>
                        @break

                        @case($item->slug == $codigouriondo)
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                <h5 class="text-sm font-bold text-green-700">Total Beneficiarios:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$suburiondo}}</p>
                                <h5 class="text-sm font-bold text-green-600">Beneficiarios habilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$suburiondohabilitados}}</p>
                                <h5 class="text-sm font-bold text-blue-600">Beneficiarios nuevos:</h5>
                                <p class="pt-5 font-bold mb-3 font-normal text-blue-700 dark:text-blue-700">{{$suburiondonuevos}}</p>
                                <h5 class="text-sm font-bold text-red-600">Beneficiarios inhabilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-red-700 dark:text-red-700">{{$suburiondoinhabilitados}}</p>
                            </div>
                        @break

                        @case($item->slug == $codigopadcaya)
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                <h5 class="text-sm font-bold text-green-700">Total Beneficiarios:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$subpadcaya}}</p>
                                <h5 class="text-sm font-bold text-green-600">Beneficiarios habilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$subpadcayahabilitados}}</p>
                                <h5 class="text-sm font-bold text-blue-600">Beneficiarios nuevos:</h5>
                                <p class="pt-5 font-bold mb-3 font-normal text-blue-700 dark:text-blue-700">{{$subpadcayanuevos}}</p>
                                <h5 class="text-sm font-bold text-red-600">Beneficiarios inhabilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-red-700 dark:text-red-700">{{$subpadcayainhabilitados}}</p>
                            </div>
                        @break

                        @case($item->slug == $codigoyunchara)
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                <h5 class="text-sm font-bold text-green-700">Total Beneficiarios:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$subyunchara}}</p>
                                <h5 class="text-sm font-bold text-green-600">Beneficiarios habilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-green-700 dark:text-green-700">{{$subyuncharahabilitados}}</p>
                                <h5 class="text-sm font-bold text-blue-600">Beneficiarios nuevos:</h5>
                                <p class="pt-5 font-bold mb-3 font-normal text-blue-700 dark:text-blue-700">{{$subyuncharanuevos}}</p>
                                <h5 class="text-sm font-bold text-red-600">Beneficiarios inhabilitados:</h5>
                                <p class="pt-5 font-bold mb-1 font-normal text-red-700 dark:text-red-700">{{$subyuncharainhabilitados}}</p>
                            </div>
                        @break
                    @endswitch
                    <hr class="my-2">
                    @foreach ($datasubgovernment as $itemsub)
                    
                        @if ($item->slug === $itemsub->subgovernment_code)
                            <h5 class="font-bold">Descripción de entrega actual:</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $itemsub->name }}</p>
                            <hr class="my-2">
                            <h5 class="font-bold text-teal-600">Canastas totales:</h5>
                            <p class="font-bold mb-3 font-normal text-gray-700 dark:text-gray-400">
                                {{ $itemsub->number_baskets_total }}</p>
                            <hr class="my-2">
                            <h5 class="font-bold text-yellow-600">Canastas restantes:</h5>
                            <p class=" font-bold mb-3 font-normal text-gray-700 dark:text-gray-400">
                                {{ $itemsub->number_baskets }}</p>
                            <hr class="my-2">
                            <h5 class="font-bold text-lime-600">Canastas entregadas:</h5>
                            <p class="font-bold mb-3 font-normal text-gray-700 dark:text-gray-400">
                                {{ $itemsub->number_baskets_delivered }}</p>
                            <hr class="my-2">
                            @foreach ($datadelivery as $itemdelivery)
                            
                            @if($itemdelivery->municipality_basket_id === $itemsub->id)
                            @foreach($databaskets as $itembasket)
                            @if($itembasket->id === $itemdelivery->basket_id)
                            <h5 class="font-bold">Precio de canasta:</h5>
                            <p class="font-bold mb-3 font-normal text-gray-700 dark:text-gray-400">{{$itembasket->price_amount}}</p>
                            @else
                            @endif
                            @endforeach
                            @else
                            @endif
                            
                            @endforeach
                        @else
                        @endif
                    @endforeach
                    <hr class="my-2">
                    <a href="#"
                        class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Historial de entregas
                        <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
        {{-- end card --}}
        {{-- end SUB GOBERNACIONES --}}
    </div>
</div>
