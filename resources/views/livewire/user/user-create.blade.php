<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Registro de usuarios
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="pt-10 px-10">
            <h1 class=" text-2xl font-bold">Agregar usuario</h1>
        </div>
        <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">

            <p class="mt-4 text-base opacity-40 uppercase"><i class="fa-solid fa-list"></i></i> Datos personales</p>

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

            {{-- email --}}
            <div class="mt-4 text-sm">
                <label for="email"></i> Usuario</label>
            </div>
            <x-jet-input type="text" placeholder="email" wire:model="email" class="mt-1 block w-full rounded-rm"
                required />
            @error('email')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end email --}}

            {{-- password --}}
            <div class="mt-4 text-sm">
                <label for="password"> Contraseña</label>
            </div>
            <x-jet-input type="password" wire:model="password" class="mt-1 block w-full rounded-rm" />
            @error('password')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end password --}}

            {{-- select role --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="role_id" value="{{ __('Rol para el usuario') }}" />
                <select wire:model="role_id" wire:change="onChangeSelectRole"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-fx"
                    required>

                    <option selected>(Seleccionar)</option>
                    @forelse ($roles as $rol)
                        <option value="{{ $rol->id }}">
                            {{ $rol->description }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>

                @error('role_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- end select role --}}

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
