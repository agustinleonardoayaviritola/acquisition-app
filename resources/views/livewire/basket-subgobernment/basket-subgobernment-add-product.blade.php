
<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Agregar productos canasta
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="pt-10 px-10">
            <h1 class=" text-2xl font-bold">Agregar producto</h1>
        </div>
        <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">

          {{-- select product --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="product_id" value="{{ __('Producto') }}" />
                <select wire:model="product_id" wire:change="onChangeSelectProduct"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name.'  |   '.$product->amount}}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>

                @error('product_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end select product --}}
            
            {{-- amount (cantidad) --}}
            <div class="mt-4 text-sm">
                Cantidad
            </div>
            <x-jet-input type="number" placeholder="Cantidad"
                wire:model="amount" class="mt-1 block w-full rounded-rm" required />
            @error('amount')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end amount (cantidad) --}}

                      
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
            <x-jet-button type="submit" class=" mt-4 bg-primary-500 text-sm h-12 w-full rounded-rm flex items-center justify-center">
                Guardar
            </x-jet-button>
        </form>
    </div>
</div>
