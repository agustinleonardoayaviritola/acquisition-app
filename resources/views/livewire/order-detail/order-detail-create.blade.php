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


            {{-- select unit_id --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="unit_id" value="{{ __('Unidad') }}" />
                <select wire:model="unit_id" wire:change="showInfoUnit"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($units as $unit)
                        <option value="{{ $unit->id }}">
                            {{ $unit->name }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>

                @error('unit_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end select unit_id --}}

            {{-- name --}}
               <div class="mt-4 text-sm">
                <label for="name"></i>Nombre</label>
            </div>
            <x-jet-input type="text" step="any" placeholder="Nombre" wire:model="name"
                class="mt-1 block w-full rounded-rm" required />
            @error('name')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end name --}}

            {{-- quantity --}}
            <div class="mt-4 text-sm">
                <label for="quantity"></i>Cantidad</label>
            </div>
            <x-jet-input type="number" placeholder="Cantidad" wire:model="quantity"
                class="mt-1 block w-full rounded-rm" required />
            @error('quantity')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end quantity --}}

            {{-- price --}}
            <div class="mt-4 text-sm">
                <label for="price"></i>Precio</label>
            </div>
            <x-jet-input type="number" step="any" placeholder="Precio" wire:model="price"
                class="mt-1 block w-full rounded-rm" required />
            @error('price')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end price --}}

            {{-- descripcion --}}
            <div class="mt-4 text-sm">
                Descripción
            </div>
            <x-textarea type="text" placeholder="Descripción" wire:model="description"
                class="mt-1 block w-full rounded-rm" required/>
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
            <x-jet-button type="submit"
                class="mt-4 text-sm h-12 w-full bg-primary-500 rounded-rm flex items-center justify-center">
                Guardar
            </x-jet-button>
        </form>
    </div>
</div>
