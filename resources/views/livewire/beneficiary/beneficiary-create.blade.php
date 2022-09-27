<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Registro de Beneficiarios
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="pt-10 px-10">

            <h1 class=" text-2xl font-bold">Agregar Beneficiarios</h1>
        </div>
        <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">
            <div x-data="{
                optionCountry: $wire.country_id,
                setOption(option) {
                    this.optionCountry = option
                }
            }">
                <p class="mt-4 text-base opacity-40 uppercase"><i class="fa-solid fa-list"></i></i> Datos personales</p>

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

                {{-- name --}}
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
                {{-- end name --}}

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

                {{-- end profession_id --}}
                <div wire:ignore>
                    <div class="mt-4 text-sm">
                        Profesión
                    </div>
                    <select id="select_professions" wire:model="profession_id" style="width: 100%;" required>
                        
                        <option selected>(Seleccionar)</option>
                        @forelse ($professions as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                            <option disabled>Sin registros</option>
                        @endforelse
                    </select>
                    @error('profession_id')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>
                {{-- end profession_id --}}


                {{-- end country_id --}}
                <div wire:ignore>
                    <div class="mt-4 text-sm">
                        País de nacimiento
                    </div>
                    <select id="select-countries" wire:model="country_id" @change="optionCountry = $event.target.value"
                        style="width: 100%;" required>
                        <option selected>(Seleccionar)</option>
                        @forelse ($countries as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                            <option disabled>Sin registros</option>
                        @endforelse
                    </select>
                    @error('category_id')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>
                {{-- end country_id --}}

                <div class="mt-4 text-sm">
                    Departamento (Solo si nacio en Bolivia)
                </div>
                <select wire:model="department_id" wire:change="onChangeSelectDepartment"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-md"
                    required>
                    <option selected>(Seleccionar)</option>
                    @forelse ($departments as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>
                @error('category_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror

                {{-- end department_id --}}


                {{-- select gender_id --}}
                <div>
                    <div class="mt-4 text-sm">
                        Género
                    </div>
                    <select wire:model="gender_id"
                        class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block  rounded-md"
                        required>
                        <option selected value="0">(Seleccionar)</option>
                        @forelse ($genders as $gender)
                            <option value="{{ $gender->id }}">
                                {{ $gender->name }}</option>
                        @empty
                            <option disabled>Sin registros</option>
                        @endforelse
                    </select>

                    @error('gender_id')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                {{-- end gender_id --}}

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

                {{-- telephones --}}
                <p class="mt-4 text-base opacity-40 uppercase"><i class="fas fa-list-ol"></i> Teléfonos</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                    <div class="col-span-1 md:col-span-1">
                        {{-- telephone_primary --}}
                        <div class="mt-4 text-sm">
                            Nro. de Celular o Teléfono
                        </div>
                        <x-jet-input type="number" placeholder="Nro. de Celular" wire:model="telephone_primary"
                            class="mt-1 block w-full rounded-rm" />
                        @error('telephone_primary')
                            <p class="text-red-500 font-semibold my-2">
                                {{ $message }}
                            </p>
                        @enderror
                        {{-- end telephone_primary --}}
                    </div>
                    <div class="col-span-1 md:col-span-1">
                        {{-- telephone_secondary --}}
                        <div class="mt-4 text-sm">
                            Nro. de referencia
                        </div>
                        <x-jet-input type="number" placeholder="Nro. de celular apoderado"
                            wire:model="telephone_secondary" class="mt-1 block w-full rounded-rm" />
                        @error('telephone_secondary')
                            <p class="text-red-500 font-semibold my-2">
                                {{ $message }}
                            </p>
                        @enderror
                        {{-- end telephone_secondary --}}
                    </div>
                    <div class="col-span-1 md:col-span-1">
                        {{-- reference_name --}}
                        <div class="mt-4 text-sm">
                            <label for="reference_name"></i> Nombre del pariente de referencia</label>
                        </div>
                        <x-jet-input type="text" placeholder="Nombre" wire:model="reference_name"
                            class="mt-1 block w-full rounded-rm" required />
                        @error('reference_name')
                            <p class="text-red-500 font-semibold my-2">
                                {{ $message }}
                            </p>
                        @enderror
                        {{-- end reference_name --}}
                    </div>


                </div>
                {{-- end telephones --}}

                {{-- residence --}}
                <p class="mt-4 text-base opacity-40 uppercase"><i class="fa-solid fa-list"></i> Datos de residencia
                    actual
                </p>

                {{-- NeighborhoodCommunity --}}
                <div wire:ignore>
                    <div class="mt-4 text-sm">
                        Barrio/Comunidad
                    </div>
                    <select id="select-neighborhood_community" wire:model="neighborhood_community_id" style="width: 100%;" required>
                        <option selected>(Seleccionar)</option>
                        @forelse ($neighborhoodcommunities as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                            <option disabled>Sin registros</option>
                        @endforelse
                    </select>
                    @error('neighborhood_community_id')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>
                {{-- <livewire:beneficiary.neighborhood-community-search> --}}
                {{-- end NeighborhoodCommunity --}}

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
                    class="mt-1 block w-full rounded-rm" />
                @error('num_address')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror

                {{-- end num address --}}

                {{-- end residence --}}


                {{-- Beneficiary --}}
                <p class="mt-4 text-base opacity-40 uppercase"><i class="fa-solid fa-list-check"></i> Datos
                    Beneficiario
                </p>

                {{-- beneficiary_file --}}
                {{-- <div class="mt-4 text-sm">
                    <label for="file"></i> Documento de respaldo</label>
                </div>
                <div x-data="{ nameFile: 'no-select' }">
                    @if ($beneficiary_file)
                        <div class="flex items-center justify-start text-gray-400 text-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span x-text="nameFile">Seleccionar imagen</span>
                        </div>
                    @endif
                    <label
                        class="w-60 py-2 px-2 flex items-center justify-center  bg-primary-500 text-white rounded-rm cursor-pointer hover:bg-primary-400 hover:border-primary-800">
                        <svg class="w-6 h-6 m-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        <span class="text-base leading-normal">Seleccionar PDF</span>
                        <input type="file" wire:model="beneficiary_file" id="beneficiary_file"
                            accept="application/pdf" class="hidden"
                            x-on:change="nameFile = document.getElementById('beneficiary_file').files[0].name" />
                    </label>
                </div>
                @error('beneficiary_file')

                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror --}}

                {{-- end beneficiary_file --}}

                {{-- end province_id --}}
                {{-- <div>

                <div class="mt-4 text-sm">
                    Pronvincia
                </div>
                <select wire:model="province_id"
                    class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-md"
                    required>
                    <option selected>(Seleccionar)</option>
                    @forelse ($provinces as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @empty
                        <option disabled>Sin registros</option>
                    @endforelse
                </select>
                @error('category_id')
                    <p class="text-red-500 font-semibold my-2">
                        {{ $message }}
                    </p>
                @enderror
            </div> --}}

                {{-- end province_id --}}

                {{-- capture photo --}}
                {{-- <div wire:ignore>
                    <div class="flex mt-4 w-full flex-col gap-4">
                        <div id="photo" style="width: 720px; height: 400px;">
                            <div></div>
                            <video autoplay="autoplay" playsinline="playsinline"
                                style="width: 720px; height: 400px;"></video>
                        </div>

                        <div class="flex w-full flex-col gap-4">

                            <div id="open_camera_button"
                                class=" w-40 py-2 px-2 flex items-center justify-center  bg-primary-500 text-white rounded-rm cursor-pointer hover:bg-red-400 hover:border-primary-800"
                                onclick="OpenWebcam()">
                                📷 Abrir Cámara
                            </div>
                            <div id="pre_take_buttons" style="display: none;">
                                <div 
                                    class="w-40 py-2 px-2 flex items-center justify-center  bg-primary-500 text-white rounded-rm cursor-pointer hover:bg-red-400 hover:border-primary-800"
                                    onclick="preview_snapshot()">
                                    Tomar foto
                                </div>
                            </div>


                            <div id="post_take_buttons" class="flex w-full flex-col gap-4" style="display: none;">
                                <div class=" w-40 py-2 px-2 flex items-center justify-center bg-primary-400 text-white rounded-rm cursor-pointer"
                                    onclick="cancel_preview()">
                                    Tomar otra
                                </div>

                            </div>
                        </div>
                    </div>
                </div> --}}


                {{-- end capture photo --}}


                {{-- capture photo --}}
                {{-- <div wire:ignore>

                <div class="flex mt-4 w-full justify-center items-center flex-col gap-4">
                    <div id="photo" style="width: 720px; height: 400px;">
                        <div></div>
                        <video autoplay="autoplay" playsinline="playsinline"
                            style="width: 720px; height: 400px;"></video>
                    </div>
                    <div class="flex w-full justify-center items-center flex-col gap-4">
                        <div id="open_camera_button"
                            class=" w-40 py-2 px-2 flex items-center justify-center  bg-blue-500 text-white rounded-full cursor-pointer hover:bg-blue-400 hover:border-primary-800"
                            onclick="OpenWebcam()">
                            📷 Abrir Cámara
                        </div>

                        <div id="take_photo_button" style="display: none;"
                            class="w-40 py-2 px-2 flex items-center justify-center  bg-green-500 text-white rounded-full cursor-pointer hover:bg-green-400 hover:border-primary-800"
                            onclick="preview_snapshot()">
                            ✅ Tomar foto
                        </div>

                        <div id="post_take_buttons"
                            class="w-40 py-2 px-2 flex items-center justify-center  bg-blue-500 text-white rounded-full cursor-pointer hover:bg-blue-400 hover:border-primary-800"
                            style="display: none;"
                            onclick="cancel_preview()">
                            🔄 Toma otro
                        </div>
                    </div>
                </div>
            </div> --}}

                {{-- end capture photo --}}
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
                    class=" mt-4 text-sm h-12 w-full rounded-rm bg-primary-500 flex items-center justify-center"
                    id="setPhoto">
                    Guardar
                </x-jet-button>
            </div>

        </form>
    </div>
</div>
@push('custom-scripts')
    <script defer>
        document.addEventListener('livewire:load', function() {
            $('#select_professions').select2();

            $('#select_professions').on('change', function() {
                @this.set('profession_id', this.value);
            });

            $('#select-neighborhood_community').select2();
            $('#select-neighborhood_community').on('change', function() {
                @this.set('neighborhood_community_id', this.value);
            });

            $('#select-countries').select2();
            $('#select-countries').on('change', function() {
                @this.set('country_id', this.value);
            });
            // $('#select-departments').select2();
            // $('#select-departments').on('change', function() {
            //     @this.set('department_id', this.value);
            //     @this.onChangeSelectDepartment();
            // });
            // $('#select-provinces').select2();
            // $('#select-provinces').on('change', function() {
            //     @this.set('province_id', this.value);
            // });
            //Save photo

        });
    </script>
@endpush
