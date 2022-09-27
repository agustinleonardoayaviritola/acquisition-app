<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
     <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Registro Entrega de Canasta
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="pt-10 px-10">
            <h1 class=" text-2xl font-bold">Agregar entrega de canasta</h1>
        </div>
        <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">

            {{-- administrator --}}
            <div class="mt-4 text-sm">
                Gestion
            </div>
            <x-jet-input onkeyup="this.value = this.value.toUpperCase();" type="text" placeholder="Gestion"
                wire:model="management" class="mt-1 block w-full rounded-rm" required />
            @error('management')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end name --}}

            {{-- description --}}
            <div class="mt-4 text-sm">
                Mes
            </div>
            <x-textarea placeholder="Mes" wire:model="mounth" class="mt-1 block w-full" />
            @error('mounth')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end description --}}
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
            <x-jet-button type="submit" class=" mt-4 text-sm h-12 w-full bg-primary-500 rounded-rm flex items-center justify-center">
                Guardar
            </x-jet-button>
        </form>
    </div>
</div>
    
</div>
