<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Registro de Sub gobernaciones
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="pt-10 px-10">
            <h1 class=" text-2xl font-bold">Agregar Sub gobernación</h1>
        </div>
        <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">

            <p class="mt-4 text-base opacity-40 uppercase"><i class="fas fa-list-ol"></i> Datos personales del usuario</p>

            {{-- name user --}}
            <div class="mt-4 text-sm">
                <label for="name"></i> Nombre completo</label>
            </div>
            <x-jet-input type="text" placeholder="Nombre completo" wire:model="name"
                class="mt-1 block w-full rounded-rm" required />
            @error('name')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end name user --}}

            {{-- lastname --}}
            <div class="mt-4 text-sm">
                <label for="lastname"> Apellido completo</label>
            </div>
            <x-jet-input type="text" placeholder="Apellido completo" wire:model="lastname"
                class="mt-1 block w-full rounded-rm" required />
            @error('lastname')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end lastname --}}

            {{-- start type document --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                <div class="col-span-1 md:col-span-2">
                    {{-- codigo --}}
                    <div class="mt-4 text-sm">
                        <label for="document_number"> Número de documento</label>
                    </div>
                    <x-jet-input type="number" placeholder="Número de documento" wire:model="document_number"
                        class="mt-1 block w-full rounded-rm" required />
                    @error('document_number')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror
                    {{-- end ci --}}
                </div>
                <div class="col-span-1 md:col-span-1">
                    {{-- select expedition_ci --}}
                    <div class="mt-4 text-sm">
                        <label for="document_issuance"> Lugar de expedición</label>
                    </div>
                    <select wire:model="document_issuance"
                        class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-rm"
                        required>
                        <option value="" selected>(Seleccionar)</option>
                        <option value="CH">CH Chuquisaca</option>
                        <option value="LP">LP La Paz</option>
                        <option value="CB">CB Cochabamba</option>
                        <option value="OR">OR Oruro</option>
                        <option value="PT">PT Potosí</option>
                        <option value="TJ">TJ Tarija</option>
                        <option value="SC">SC Santa Cruz</option>
                        <option value="BE">BE Beni</option>
                        <option value="PD">PD Pando</option>
                    </select>
                    @error('document_issuance')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror
                    {{-- end select expedition_ci --}}
                </div>
                <div class="col-span-1 md:col-span-1">
                    {{-- code_ci --}}
                    <div class="mt-4 text-sm">
                        <label for="document_supplement"> Complemento (opcional)</label>
                    </div>
                    <x-jet-input onkeyup="this.value = this.value.toUpperCase();" type="text"
                        placeholder="Complemento (opcional)" wire:model="document_supplement"
                        class="mt-1 block w-full rounded-rm" />
                    @error('document_supplement')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror
                    {{-- end code_ci --}}
                </div>
            </div>
            {{-- end type document --}}

            {{-- address --}}
            <div class="mt-4 text-sm">
                <label for="address"> Dirección</label>
            </div>
            <x-textarea placeholder="Dirección" wire:model="address" class="mt-1 block w-full" />
            @error('address')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end address --}}


            {{-- num address --}}
            <div class="mt-4 text-sm">
                <label for="num_address"> Número de casa</label>
            </div>
            <x-jet-input type="number" placeholder="Número de casa" wire:model="num_address"
                class="mt-1 block w-full rounded-rm" required />
            @error('num_address')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end num address --}}

            {{-- date_birth --}}
            <div class="mt-4 text-sm">
                <label for="date_birth"> Fecha de nacimiento</label>
            </div>
            <x-jet-input type="date" placeholder="Fecha" wire:model="date_birth" required />
            @error('date_birth')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end date_birth --}}


            {{-- email --}}
            <div class="mt-4 text-sm">
                <label for="email"> Correo electrónico</label>
            </div>
            <x-jet-input type="email" placeholder="Correo electrónico" wire:model="email"
                class="mt-1 block w-full rounded-rm" />
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

            <p class="mt-4 text-base opacity-40 uppercase"><i class="fas fa-list-ol"></i> DATOS PARA SUB GOBERNACIÓN</p>
            {{-- select community --}}
            <div>
                <x-jet-label class="mt-4 text-sm" for="municipality_id" value="{{ __('Municipio') }}" />
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
            {{-- name Subgovernment --}}
            <div class="mt-4 text-sm">
                <label for="name_sub"></i> Nombre</label>
            </div>
            <x-jet-input onkeyup="this.value = this.value.toUpperCase();" type="text" placeholder="Nombre"
                wire:model="name_sub" class="mt-1 block w-full rounded-rm" required />
            @error('namesub')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end name Subgovernment --}}

            {{-- description subgovernment --}}
            <div class="mt-4 text-sm">
                <label for="description"> Descripción</label>
            </div>
            <x-textarea placeholder="Descripción" wire:model="description" class="mt-1 block w-full" />
            @error('description')
                <p class="text-red-500 font-semibold my-2">
                    {{ $message }}
                </p>
            @enderror
            {{-- end description subgovernment --}}

            {{-- state subgovernment --}}
            <x-jet-label class="mt-4 text-sm" for="state" value="Estado" />
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
            {{-- end state subgovernment --}}
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
                class="mt-4 h-12 w-full bg-primary-500 rounded-rm flex items-center justify-center">
                Guardar
            </x-jet-button>
        </form>
    </div>
</div>
