<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Registro de Canastas para las Sub Gobernaciones
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="pt-10 px-10">
            <h1 class=" text-2xl font-bold">Agregar registro</h1>
        </div>
        <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">

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



            {{-- select Subgovernment --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="subgovernment_id" value="{{ __('Sub Gobernación') }}" />
                <select wire:model="subgovernment_id" wire:change="onChangeSelectSubgovernment"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($subgovernments as $subgovernment)
                        <option value="{{ $subgovernment->id }}">
                            {{ $subgovernment->name }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>

                @error('subgovernment_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end select Subgovernment --}}

            {{-- name --}}
            <div class="mt-4 text-sm">
                Nombre
            </div>
            <x-jet-input onkeyup="this.value = this.value.toUpperCase();" type="text" placeholder="Nombre"
                wire:model="name" class="mt-1 block w-full rounded-rm" required />
            @error('name')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end name --}}

            {{-- description --}}
            <div class="mt-4 text-sm">
                Descripción
            </div>
            <x-jet-input type="text" placeholder="Descripción"
                wire:model="description" class="mt-1 block w-full rounded-rm" required />
            @error('description')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end description --}}



            {{-- start_date --}}
            <div class="mt-4 text-sm">
                <label for="start_date"> Fecha de Inicio de entrega</label>
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
                <label for="end_date"> Fecha de Fin de entrega</label>
            </div>
            <x-jet-input type="date" placeholder="Fecha" wire:model="end_date" required />
            @error('end_date')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end end_date --}}

            {{-- number_baskets --}}
            <div class="col-span-1 md:col-span-1">

                <div class="mt-4 text-sm">
                    Cantidad de Canastas
                </div>
                <x-jet-input type="number" placeholder="Cantidad de Canastas" wire:model="number_baskets"
                    class="mt-1 block w-full rounded-rm" />
                @error('number_baskets')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>
            {{-- end number_baskets --}}



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
                class=" mt-4 bg-primary-500 text-sm h-12 w-full rounded-rm flex items-center justify-center">
                Guardar
            </x-jet-button>
        </form>
    </div>
</div>
