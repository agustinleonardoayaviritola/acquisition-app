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


            {{-- select requesting_unit_id --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="requesting_unit_id" value="{{ __('Unidades  ') }}" />
                <select wire:model="requesting_unit_id" wire:change="onChangeSelectRequistinUnit"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($requestingunits as $requestingunit)
                        <option value="{{ $requestingunit->id }}">
                            {{ $requestingunit->name }}</option>
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

            {{-- name --}}
            <div class="mt-4 text-sm">
                <label for="name"></i>Nombres</label>
            </div>
            <x-jet-input type="text" placeholder="Nombres" wire:model="name" class="mt-1 block w-full rounded-rm"
                required />
            @error('name')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end name --}}

            {{-- lastname --}}
            <div class="mt-4 text-sm">
                <label for="lastname"></i>Apellidos</label>
            </div>
            <x-jet-input type="text" placeholder="Apellidos" wire:model="lastname"
                class="mt-1 block w-full rounded-rm" required />
            @error('lastname')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end lastname --}}

            {{-- number --}}
            <div class="mt-4 text-sm">
                <label for="number"></i>Número</label>
            </div>
            <x-jet-input type="text" placeholder="Número" wire:model="number" class="mt-1 block w-full rounded-rm"
                required />
            @error('number')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end number --}}
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
