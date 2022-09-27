<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Cambio de estado del Beneficiario
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8" wire:poll.1000ms>
        <div class=" text-primary-400 flex justify-end ...">{{ now() }}</div>

        <div class="w-full flex justify-start space-x-2 container bg-white  grid grid-cols-2 gap-2">
            <div class="my-2 mx-4" >
                <h1 class="text-2xl">Detalle de los estados del Beneficiario</h1>
                <hr class=" mt-2">
                <h1 class="text-lg ">Nombre Completo: {{ $person->name }} {{ $person->lastname }}
                </h1>
                <h2 class="text-lg">CI: {{ $documentperson->document_number }} {{ $documentperson->document_supplement }}
                </h2>
                <h2 class="text-lg">Fecha de Naciemiento: {{ $person->date_birth }}
                </h2>
                <hr class=" mt-2">
                @if ($beneficiarystates->name == 'PRE-INSCRIBIDO')
                    Estado Actual: <h2
                        class="mt-4 px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-600 uppercase">
                        {{ $beneficiarystates->name }}
                    </h2>
                @elseif($beneficiarystates->name == 'HABILITADO')
                    Estado Actual: <h2
                        class="mt-4 px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-lime-300 text-lime-600 uppercase">
                        {{ $beneficiarystates->name }}
                    </h2>
                @elseif($beneficiarystates->name == 'OBSERVADO')
                    Estado Actual: <h2
                        class="mt-4 px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-cyan-300 text-cyan-600 uppercase">
                        {{ $beneficiarystates->name }}
                    </h2>
                @elseif($beneficiarystates->name == 'SUSPENSIÓN TEMPORAL')
                    Estado Actual: <h2
                        class="mt-4 px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-orange-300 text-orange-600 uppercase">
                        {{ $beneficiarystates->name }}
                    </h2>
                @elseif($beneficiarystates->name == 'EXTINGUIDO')
                    Estado Actual: <h2
                        class="mt-4 px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-red-300 text-red-600 uppercase">
                        {{ $beneficiarystates->name }}
                    </h2>
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
        <div>
            <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">

                {{-- select state --}}
                <x-jet-label class="mt-2" for="stateId" value="{{ __('Estado') }}" />
                <select wire:model="stateId" id="stateId"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-fx"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($beneficiarystate as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }}</option>

                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>

                @error('stateId')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
                {{-- end select state --}}

                @if (!is_null($beneficiarystatedetails))
                    {{-- select detail state --}}
                    <x-jet-label class="mt-2" for="beneficiary_state_detail_id" value="{{ __('Tipo de estado') }}" />
                    <select wire:model="beneficiary_state_detail_id"
                        class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-fx"
                        required>

                        <option selected>(Seleccionar)</option>
                        @forelse ($beneficiarystatedetails as $beneficiarystatedetail)
                            <option value="{{ $beneficiarystatedetail->id }}">
                                {{ $beneficiarystatedetail->description }}</option>

                        @empty
                            <option disabled>Sin registros</option>
                        @endforelse

                    </select>

                    @error('beneficiary_state_detail_id')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror
                    {{-- end select state detail --}}
                @endif

                {{-- description --}}
                <div class="mt-4 text-sm">
                    <label for="description"> Descripción</label>
                </div>
                <x-textarea placeholder="Descripción" wire:model="description" class="mt-1 block w-full" required />
                @error('description')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
                <x-jet-button type="submit"
                    class=" mt-4 bg-primary-500 text-sm h-12 w-full rounded-rm flex items-center justify-center">
                    Cambiar
                </x-jet-button>
                {{-- end description --}}
            </form>
        </div>
        <div class="m-5">
            <livewire:beneficiary-subgobernment.beneficiary-subgobernment-history-data-table :beneficiary_id="$beneficiary->id"/>
        </div>
    </div>
</div>
