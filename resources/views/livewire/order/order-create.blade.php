<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Pedido
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="pt-10 px-10">
            <h1 class=" text-2xl font-bold">Agregar nueva pedido</h1>
        </div>
        <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">


            {{-- select supplier_id --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="supplier_id" value="{{ __('Proveedores') }}" />
                <select wire:model="supplier_id" wire:change="showInfoSupplier"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">
                            {{ $supplier->name }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>

                @error('supplier_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end select supplier_id --}}

            {{-- select order_type_id --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="order_type_id" value="{{ __('Tipo') }}" />
                <select wire:model="order_type_id" wire:change="onChangeSelectOrderTypes"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($order_types as $order_type)
                        <option value="{{ $order_type->id }}">
                            {{ $order_type->name }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>

                @error('order_type_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end select order_type_id --}}

            {{-- select order_code_id --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="order_code_id" value="{{ __('Código') }}" />
                <select wire:model="order_code_id" wire:change="onChangeSelectOrderCodes"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($order_codes as $order_code)
                        <option value="{{ $order_code->id }}">
                            {{ $order_code->name }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>

                @error('order_code_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end select order_code_id --}}

            {{-- select requesting_unit_id --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="requesting_unit_id" value="{{ __('Código') }}" />
                <select wire:model="requesting_unit_id" wire:change="onChangeSelectRequestingUnits"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($requesting_units as $requesting_unit)
                        <option value="{{ $requesting_unit->id }}">
                            {{ $requesting_unit->name }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>

                @error('requesting_unit_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end select requesting_unit_id --}}

            {{-- application_number --}}
            <div class="mt-4 text-sm">
                Número de solicitud
            </div>
            <x-jet-input onkeyup="this.value = this.value.toUpperCase();" type="number"
                placeholder="Número de solicitud" wire:model="application_number" class="mt-1 block w-full rounded-rm"
                required />
            @error('application_number')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end application_number --}}

            {{-- issue_date --}}
            <div class="mt-4 text-sm">
                Fecha de emisión
            </div>
            <x-jet-input onkeyup="this.value = this.value.toUpperCase();" type="date" placeholder="Fecha de emisión"
                wire:model="issue_date" required />
            @error('issue_date')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end issue_date --}}

            {{-- delivery_time --}}
            <div class="mt-4 text-sm">
                Plazo Entrega
            </div>
            <x-jet-input onkeyup="this.value = this.value.toUpperCase();" type="number" placeholder="Plazo Entrega"
                wire:model="delivery_time" required />
            @error('delivery_time')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end delivery_time --}}

            {{-- observation --}}
            <div class="mt-4 text-sm">
                Observación
            </div>
            <x-jet-input onkeyup="this.value = this.value.toUpperCase();" type="text" placeholder="Observación"
                wire:model="observation" class="mt-1 block w-full rounded-rm" required />
            @error('observation')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end observation --}}

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
