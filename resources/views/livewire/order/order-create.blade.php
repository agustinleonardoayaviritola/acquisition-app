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
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                
                </div>
                <div class="w-full md:w-1/2 px-3">
                
                </div>
            </div>


            {{-- code --}}
            <div class="mt-4 text-sm">
                Nro. de Solicitud
            </div>
            <x-jet-input onkeyup="this.value = this.value.toUpperCase();" type="text"
                placeholder="Nro de Solicitud" wire:model="code"
                class="mt-1 block w-full rounded-rm" required />
            @error('code')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end code --}}


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



            {{-- select order_type_id --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="order_type_id" value="{{ __('Tipo de Orden') }}" />
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
            {{-- select supplier_id --}}
            <div wire:ignore>
                <div class="mt-4 text-sm">
                    Proveedores
                </div>
                <select id="select_suppliers" wire:model="supplier_id" style="width: 100%;">

                    <option selected>(Seleccionar)</option>
                    @forelse ($suppliers as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
            {{-- select requestingunit_id --}}
            <div wire:ignore>
                <div class="mt-4 text-sm">
                    Unidad Solicitante
                </div>
                <select id="select_requestingunits" wire:model="requestingunit_id" style="width: 100%;">

                    <option selected>(Seleccionar)</option>
                    @forelse ($requestingunits as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>
                @error('requestingunit_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>
            {{-- end select requestingunit_id --}}

            {{-- application_number --}}
            <div class="mt-4 text-sm">
                Nro Prenumerado
            </div>
            <x-jet-input onkeyup="this.value = this.value.toUpperCase();" type="number" placeholder="Nro Prenumerado"
                wire:model="application_number" class="mt-1 block w-full rounded-rm" required />
            @error('application_number')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end application_number --}}





            {{-- observation --}}
            {{--             <div class="mt-4 text-sm">
                Observación
            </div>
            <x-textarea placeholder="Observación" wire:model="observation" class="mt-1 block w-full rounded-rm"
                required />
            @error('observation')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror --}}
            {{-- end observation --}}
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
@push('custom-scripts')
    <script defer>
        document.addEventListener('livewire:load', function() {
            $('#select_suppliers').select2();

            $('#select_suppliers').on('change', function() {
                @this.set('supplier_id', this.value);
            });

            $('#select_requestingunits').select2();

            $('#select_requestingunits').on('change', function() {
                @this.set('requestingunit_id', this.value);
            });

        });
    </script>
@endpush
