<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Registro Entrega de Canasta
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="pt-10 px-10">
            <h1 class=" text-2xl font-bold">Entrega</h1>
        </div>
        <div class="max-w-8xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="my-8  mx-4 pl-2 bg-slate-300">
                <h1 class="font-bold text-2xl">Datos del Beneficiario:</h1>
                <hr class=" mt-1">
                <h1 class="text-2lg ">Nombre completo: {{ $person->name }} {{ $person->lastname }}</h1>
                <h1 class="text-lg ">CI: {{ $documentperson->document_number }}
                    {{ $documentperson->document_issuance }} {{ $documentperson->document_supplement }}</h1>
                <h1 class="text-xl ">Fecha de entrega: {{ $current_date }}</h1>
                {{-- <div>
                    <img class="object-cover h-72 w-80 rounded-lg border border-primary-300 border-dashed"
                        width="50%" height="400px" src="../../{{ $beneficiary->photo }}">
                </div> --}}
            </div>
            <form wire:submit.prevent="submit" class="m-10 mt-0 p-4">
                <div class="my-2 mx-4 pl-2">
                    <div x-data="{
                        optionCountry: $wire.country_id,
                        setOption(option) {
                            this.optionCountry = option
                        }
                    }">
                        <p class="mt-4  text-base opacity-40 uppercase font-bold"><i class="fa-solid fa-list"></i> Datos para
                            actualizar
                        </p>
                        {{-- start type document --}}
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                            <div class="col-span-1 md:col-span-2">
                                {{-- codigo --}}
                                <div class="mt-4 text-sm">
                                    <label for="document_number"> Número de documento</label>
                                </div>
                                <x-jet-input type="text" placeholder="Número de documento"
                                    wire:model="document_number" class="mt-1 block w-full rounded-rm" required />
                                @error('document_number')
                                    <p class="text-red-500 font-semibold my-2">
                                        {{ $message }}
                                    </p>
                                @enderror
                                {{-- end ci --}}
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

                        </div>
                        {{-- end type document --}}

                        <div wire:ignore>
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

                        {{-- end country_id --}}
                        <div wire:ignore>
                            <div class="mt-4 text-sm">
                                País de nacimiento
                            </div>
                            <select id="select-countries" wire:model="country_id"
                                @change="optionCountry = $event.target.value" style="width: 100%;" required>
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

                        {{-- start department_id --}}
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

                    </div>




                    {{-- <div class="grid grid-cols-2 gap-2">

                <div wire:ignore class=" mx-1 grid grid-cols-1 gap-1">
                    <div id="photo">
                        <video autoplay="autoplay" playsinline="playsinline"></video>
                    </div>        
                    <div id="results" class="flex mt-4 w-full flex-col gap-4 " wire:ignore>Su imagen capturada aparecerá aquí...</div>
                </div>
            </div>               
            <div class="ml-4">
                <div class="mx-1 grid grid-cols-4 gap-4 ml-2">

                    <div id="open_camera_button"
                        class=" w-40 py-2 px-2  items-center justify-center bg-primary-500 text-white rounded-rm cursor-pointer hover:bg-red-600 hover:border-primary-800"
                        onclick="OpenWebcam()">
                        📷 Abrir Cámara
                    </div>
                    <div id="pre_take_buttons" style="display: none;">
                        <div class="w-50 py-2 px-2 flex items-center justify-center  bg-primary-500 text-white rounded-rm cursor-pointer hover:bg-red-600 hover:border-primary-800"
                            onclick="preview_snapshot()">
                            Tomar foto
                        </div>
                    </div>


                    <div id="post_take_buttons" class="flex w-full flex-col gap-4" style="display: none;">
                        <div class=" w-40 py-2 px-2 flex items-center justify-center bg-yellow-500 text-white rounded-rm cursor-pointer"
                            onclick="cancel_preview()">
                            Tomar otra foto
                        </div>

                    </div>
                    <div id="updatephoto" style="display: none;">
                        <div class="w-40 py-2 px-2 flex items-center justify-center  bg-green-500 text-white rounded-rm cursor-pointer hover:bg-green-400 hover:border-green-800"
                            id="setPhoto">
                            Actualizar foto
                        </div>
                    </div>
                </div>
            </div> --}}

                    <p class="mt-4 text-base opacity-40 uppercase font-bold"><i class="fa-solid fa-list"></i> Entregar canatas
                    </p>

                    {{-- start delivery --}}
                    <div class="mt-4 text-sm">
                        Version de Canasta
                    </div>
                    <select wire:model="delivery_id" wire:change="onChangeSelectDelivery"
                        class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-md"
                        required>
                        <option selected>(Seleccionar)</option>
                        @forelse ($deliveries as $item)
                            <option value="{{ $item->id }}">{{ $item->description }}</option>
                        @empty
                            <option disabled>Sin registros</option>
                        @endforelse
                    </select>
                    @error('delivery_id')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror

                    {{-- end delivery --}}

                    {{-- start delivery_point --}}
                    <div class="mt-4 text-sm">
                        Punto de entrega
                    </div>
                    <select wire:model="delivery_point_id" wire:change="onChangeSelectDeliveryPoint"
                        class="border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm mt-1 block w-full rounded-md"
                        required>
                        <option selected>(Seleccionar)</option>
                        @forelse ($deliverypoints as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                            <option disabled>Sin registros</option>
                        @endforelse
                    </select>
                    @error('delivery_point_id')
                        <p class="text-red-500 font-semibold my-2">
                            {{ $message }}
                        </p>
                    @enderror

                    {{-- end delivery_point --}}

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
                    @if ($deliveries[0]->number_baskets == 0)
                        <h1 class="mt-16 text-center font-serif font-bold text-red-700 text-5xl">CANASTAS AGOTADAS PARA
                            ESTA
                            ENTREGA.</h1>
                    @else
                        <x-jet-button type="submit"
                            class=" mt-4 text-sm h-12 w-full bg-primary-500 rounded-rm flex items-center justify-center">
                            Entregar
                        </x-jet-button>
                    @endif


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
                //Save photo
                /*             $('#setPhoto').on('click', function() {

                            Webcam.snap(function(data_uri) {
                                console.log('aceptando foto');
                                console.log(data_uri);
                                @this.set('photo64', data_uri);
                            });
                        }); */
            });
        </script>
    @endpush


    {{-- @push('custom-scripts')
    <script defer>
        document.addEventListener('livewire:load', function() {
            $('#setPhoto').on('click', function() {

                //Se deberia ocultar la camara, mostrar solo la foto y el boton de volver a tomar foto
                Webcam.snap(function(data_uri) {
                    document.getElementById('results').innerHTML =
                        '<h2>Aquí está tu imagen:</h2>' +
                        '<img class="object-cover h-62 w-80 rounded-lg border border-primary-300 border-dashed" src="' +
                        data_uri + '"/>';

                    console.log('aceptando foto');
                    console.log(data_uri);
                    @this.set('photo_new', data_uri);

                });
            });

        });
    </script>
    <script>
        function OpenWebcam() {
            Webcam.set({
                width: 600,
                height: 400,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#photo');
            document.getElementById('open_camera_button').style.display = 'none';

            document.getElementById('pre_take_buttons').style.display = '';


        }

        function preview_snapshot() {
            // freeze camera so user can preview pic
            Webcam.freeze();

            // swap button sets
            document.getElementById('pre_take_buttons').style.display = 'none';
            document.getElementById('post_take_buttons').style.display = '';
            document.getElementById('updatephoto').style.display = '';
        }

        function cancel_preview() {
            Webcam.unfreeze();
            // swap buttons back

            document.getElementById('pre_take_buttons').style.display = '';
            document.getElementById('post_take_buttons').style.display = 'none';
            document.getElementById('updatephoto').style.display = 'none';
        }
    </script>
@endpush --}}
