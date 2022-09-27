<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar el Canton/Distrito
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="pt-10 px-10">
            <h1 class=" text-2xl font-bold">Agregar Canton/Distrito</h1>
        </div>
        <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">
            {{-- select community --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="municipality_id" value="{{ __('Municipios') }}" />
                <select wire:model="municipality_id" wire:change="onChangeSelectMunicipality"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($municipalities as $municipality)
                        <option value="{{ $municipality->id }}">
                            {{ $municipality->name }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>

                @error('municipality_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- select  end community --}}
            <div class="col-span-1 md:col-span-1">
                {{-- select expedition_ci --}}
                <div class="mt-4 text-sm">
                    <label for="type"> Tipo</label>
                </div>
                <select wire:model="type"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>
                    <option value="" selected>(Seleccionar)</option>
                    <option value="CANTON">CANTON</option>
                    <option value="DISTRITO">DISTRITO</option>
                
                </select>
                @error('type')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
                {{-- end select expedition_ci --}}
            </div>

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
            

            {{-- descripcion --}}
            <div class="mt-4 text-sm">
                Descripción
            </div>
            <x-jet-input type="text" placeholder="Descripción" wire:model="description"
                class="mt-1 block w-full rounded-rm" />
            @error('name')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end descripcion --}}

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
            <x-jet-button type="submit" class=" mt-4 text-sm h-12 w-full rounded-rm flex items-center justify-center">
                Guardar
            </x-jet-button>
        </form>
    </div>
</div>
