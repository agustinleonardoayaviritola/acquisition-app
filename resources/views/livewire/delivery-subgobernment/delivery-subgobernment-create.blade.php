<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Registro de Entrega
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="pt-10 px-10">
            <h1 class=" text-2xl font-bold">Agregar Nueva Entrega</h1>
        </div>
        <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">
            {{-- select municipality_basket_id --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="municipality_basket_id"
                    value="{{ __('Canastas por Municipios') }}" />
                <select wire:model="municipality_basket_id" wire:change="onChangeSelectMunicipalityBasket"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($municipalitybaskets as $municipalitybasket)
                        <option value="{{ $municipalitybasket->id }}">
                            {{ $municipalitybasket->description }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>

                @error('municipality_basket_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end select municipality_basket_id --}}

            {{-- select basket_id --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="basket_id" value="{{ __('Canastas') }}" />
                <select wire:model="basket_id" wire:change="onChangeSelectBasket"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($baskets as $baske)
                        <option value="{{ $baske->id }}">
                            {{ $baske->name }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>

                @error('basket_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end select basket_id --}}



            {{-- description --}}
            <div class="mt-4 text-sm">
                Descripción
            </div>
            <x-textarea placeholder="Descripción" wire:model="description" class="mt-1 block w-full" />
            @error('description')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end description --}}

            {{-- number_baskets --}}
            <div class="col-span-1 md:col-span-2">

                <div class="mt-4 text-sm">
                    <label for="number_baskets"> Número de Canastas</label>
                </div>
                <x-jet-input type="number" placeholder="Número de Canastas" wire:model="number_baskets"
                    class="mt-1 block w-full rounded-rm" required />
                @error('number_baskets')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>
            {{-- end number_baskets --}}

            <div class="col-span-1 md:col-span-1">
                {{-- select month --}}
                <div class="mt-4 text-sm">
                    <label for="document_issuance"> Mes</label>
                </div>
                <select wire:model="month"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>
                    <option value="" selected>(Seleccionar)</option>
                    <option value="ENERO">ENERO</option>
                    <option value="FEBRERO">FEBRERO</option>
                    <option value="MARZO">MARZO</option>
                    <option value="ABRIL">ABRIL</option>
                    <option value="MAYO">MAYO</option>
                    <option value="JUNIO">JUNIO</option>
                    <option value="JULIO">JULIO</option>
                    <option value="AGOSTO">AGOSTO</option>
                    <option value="SEPTIEMBRE">SEPTIEMBRE</option>
                    <option value="OCTUBRE">OCTUBRE</option>
                    <option value="NOVIEMBRE">NOVIEMBRE</option>
                    <option value="DICIEMBRE">DICIEMBRE</option>
                </select>
                @error('document_issuance')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
                {{-- end select month --}}
            </div>

            {{-- start_date --}}
            <div class="mt-4 text-sm">
                <label for="start_date"> Fecha de Inicio</label>
            </div>
            <x-jet-input type="date" placeholder="Fecha" wire:model="start_date" required />
            @error('start_date')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end start_date --}}

            {{-- end_date --}}
            <div class="mt-4 text-sm">
                <label for="end_date"> Fecha de Finalización</label>
            </div>
            <x-jet-input type="date" placeholder="Fecha" wire:model="end_date" required />
            @error('end_date')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end end_date --}}


            {{-- state --}}
            <x-jet-label class="mt-4 text-sm" value="Estado" />
            <div class="mt-4 space-y-2">
                <div class="flex items-center">
                    <input wire:model="state" value="ACTIVE" type="radio"
                        class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300">
                    <label for="push_everything" class="ml-2 block text-sm font-medium text-gray-700">
                        Activo
                    </label>
                </div>
                <div class="flex items-center">
                    <input wire:model="state" value="INACTIVE" type="radio"
                        class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300">
                    <label for="push_email" class="ml-2 block text-sm font-medium text-gray-700">
                        Inactivo
                    </label>
                </div>
            </div>
            {{-- end state --}}
            {{-- all errors --}}
            @if ($errors->any())
                <div class="bg-red-100 rounded-md text-red-500 p-2 font-semibold my-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- end all errors --}}
            <x-jet-button type="submit"
                class="mt-4 text-sm h-12 w-full bg-primary-500 rounded-rm flex items-center justify-center">
                Guardar
            </x-jet-button>
        </form>
    </div>
</div>