<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Registro de Proveedor
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="pt-10 px-10">
            <h1 class=" text-2xl font-bold">Agregar nuevo proveedor</h1>
        </div>
        <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">


            {{-- select supplier_category_id --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="supplier_category_id" value="{{ __('Categorías') }}" />
                <select wire:model="supplier_category_id" wire:change="onChangeSelectSupplierCategories"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($suppliercategories as $suppliercategory)
                        <option value="{{ $suppliercategory->id }}">
                            {{ $suppliercategory->name }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>

                @error('supplier_category_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end select supplier_category_id --}}

            {{-- name_supplier --}}
            <div class="mt-4 text-sm">
                <label for="name_supplier"></i>Nombre</label>
            </div>
            <x-jet-input type="text" placeholder="Nombre Proveedor" wire:model="name_supplier"
                class="mt-1 block w-full rounded-rm" required />
            @error('name_supplier')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end name_supplier --}}

            {{-- name --}}
            <div class="mt-4 text-sm">
                <label for="name"></i>Persona de contacto</label>
            </div>
            <x-jet-input type="text" placeholder="Nombres" wire:model="name" class="mt-1 block w-full rounded-rm"
                required />
            @error('name')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end name --}}



            {{-- number --}}
            <div class="mt-4 text-sm">
                <label for="number"></i>Tel/Fax:</label>
            </div>
            <x-jet-input type="text" placeholder="Número" wire:model="number" class="mt-1 block w-full rounded-rm"
                required />
            @error('number')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end number --}}

            {{-- email --}}
            <div class="mt-4 text-sm">
                <label for="email"></i> Correo</label>
            </div>
            <x-jet-input type="email" placeholder="Correo" wire:model="email" class="mt-1 block w-full rounded-rm" />
            @error('email')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end email --}}

            {{-- address --}}
            <div class="mt-4 text-sm">
                <label for="address"></i>Dirección</label>
            </div>
            <x-textarea type="text" placeholder="Dirección" wire:model="address" class="mt-1 block w-full rounded-rm"
                required />
            @error('address')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end address --}}

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
