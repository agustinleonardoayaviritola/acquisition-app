<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Reportes por Usuarios
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 m-10 mt-0 p-4">
        <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">
            <p class="mt-4 text-base opacity-40 uppercase"><i class="fa-solid fa-list"></i></i> Parametros</p>
            {{-- start_date --}}
            <div class="mt-4 text-sm">
                <label for="start_date"> Fecha de Inicio</label>
            </div>
            <x-jet-input type="datetime-local" id="datePickerId1" placeholder="Fecha" wire:model="start_date" required />
            @error('start_date')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end start_date --}}


            {{-- end_date --}}
            <div class="mt-4 text-sm">
                <label for="end_date"> Fecha de Fin</label>
            </div>
            <x-jet-input type="datetime-local" id="datePickerId2" placeholder="Fecha" wire:model="end_date" required />
            @error('end_date')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end end_date --}}


            {{-- select management --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="management" value="{{ __('Gestion') }}" />
                <select wire:model="management"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>

                    <option selected>(Seleccionar)</option>
                    @for ($i = 2022; $i <= 2030; $i++)
                        <option value="{{ $i }}">
                            {{ $i }}</option>
                    @endfor
                </select>

                @error('management')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end select basketManagements --}}


            @if (!is_null($deliverydetails))
                {{-- select delivery state --}}
                <x-jet-label class="mt-2" for="delivery_id" value="{{ __('Entregas') }}" />
                <select wire:model="delivery_id"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-fx"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($deliverydetails as $deliverydetail)
                        <option value="{{ $deliverydetail->id }}">
                            {{ $deliverydetail->description }}</option>

                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse

                </select>

                @error('delivery_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
                {{-- end select delivery detail --}}
            @endif

            <x-jet-button type="submit"
                class=" mt-4 text-sm h-12 w-full rounded-rm bg-primary-500 flex items-center justify-center"
                id="setPhoto">
                Generar Reporte
            </x-jet-button>
        </form>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="flex m-8 justify-center items-center">
                <div class="justify-center border-dashed bg-white border-2 m-8 p-4">
                    <div id="printableArea" class="m-10 mt-0 p-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="left-0 top-0">
                                <img  class="object-fill h-22 w-32 ..." src="{{ asset('/images/logo-gobernacion.svg') }}" alt="">
                            </div>
                            <div class="text-xs uppercase mt-10">
                                <p class="text-right">Canasta alimentaria personas de la tercera edad</p>
                                <p class="text-right">Dirección de tecnologias de la información</p>
                                <p class="text-right">Gobierno Autonomo DPTAL. TARIJA</p>
                            </div>
                        </div>
                        <hr class=" my-8">
                        <p class="mt-4 text-base font-bold text-center uppercase">Total por usuario y punto de entrega</p>
                        <p class="mt-4 text-base font-bold text-center uppercase">Parametros</p>
                        <div class=" ml-10 grid grid-cols-2 gap-4">
                            <div class="w-full flex justify-center items-center flex-col">
                                Desde: <p class="font-bold text-xl">{{$start}}</p>
                            </div>
                            <div class="w-full flex justify-center items-center flex-col">
                                Hasta: <p class="font-bold text-xl">{{$end}}</p>
                            </div>
                            <div class="w-full flex flex-col font-bold">
                                Sub Gobernación: {{$subgoverment->name ?? 'Datos no asignado'}}
                            </div>
                            <div class="w-full flex flex-col font-bold">

                            </div>
                            <div class="w-full flex flex-col font-bold">
                                Gestión: {{$dataMunicipalityBasket->management ?? 'Datos no asignado'}}
                            </div>
                            <div class="w-full flex flex-col font-bold">

                            </div>
                            <div class="w-full flex flex-col font-bold">
                                Versión: {{$dataMunicipalityBasket->name ?? 'Datos no asignado'}}
                            </div>
                            <div class="w-full flex flex-col font-bold">

                            </div>
                            <div class="w-full flex flex-col font-bold">
                                Mes: {{$datadelivery->month ?? 'Datos no asignado'}}
                            </div>

                        </div>
                        <table class="ml-12 mt-6 border border-slate-500 min-w-min divide-y divide-gray-200 justify-center">
                            @if (!is_null($datadelliverybaskets))
                                <thead class="bg-red-600">
                                    <tr>
                                        <th scope="col border border-slate-600"
                                            class="px-6 py-3 font-bold text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Nombre del Usuario
                                        </th>
                                        <th scope="col border border-slate-600"
                                            class="px-6 py-3 font-bold text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Punto de entrega
                                        </th>
                                        <th scope="col border border-slate-600"
                                            class="px-6 py-3 font-bold text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Canastas entregadas
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($usersdata as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap border border-slate-600">
                                                <div class="text-sm text-gray-900 ">
                                                    {{ $item->name }} {{ $item->beneficiary_surname }} 
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap border border-slate-600">
                                                <div class="text-sm text-gray-900 ">
                                                    {{ $item->collection_point }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap border border-slate-600">
                                                <div class="text-sm text-gray-900 ">
                                                    {{ $item->baskets_delivered }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap border border-slate-600">
                                            <div class="text-sm text-gray-900">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border border-slate-600">
                                            <div class="text-sm text-gray-900 font-bold uppercase">
                                                Total de canastas entregadas:
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border border-slate-600">
                                            <div class="text-sm text-gray-900 font-bold">
                                                {{$total ?? 'No hay datos para mostrar'}}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="justify-center flex">
                <div class="container m-auto rounded-md w-96 p-1 mt-5 mb-10">
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
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')
    <script type="text/javascript">
        datePickerId1.max = new Date().toISOString().split("T")[0];
        datePickerId2.max = new Date().toISOString().split("T")[0];
    </script>
@endpush