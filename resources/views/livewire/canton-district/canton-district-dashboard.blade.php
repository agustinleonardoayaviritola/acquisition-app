<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Canton/Distrito
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="w-full flex justify-end space-x-2">
            @if (Auth::user()->hasAnyRole(['superadmin', 'admin']))
            <a href="{{ route('canton-district.create') }}"
                class="my-2 border-2 border-green-500 text-green-500 bg-white flex items-center rounded-full hover:bg-green-500 hover:text-white">
                <svg class="w-8 h-8 m-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
            </a>
            @endif
        </div>
        <div class="pt-8 space-y-10">
            <p class="mt-4 text-xl opacity-40 uppercase"><i class="fa-solid fa-list"></i></i> Municipio de Cercado</p>
            <livewire:canton-district.canton-district-data-table />
        </div>
        <div class="pt-8 space-y-10">
            <p class="mt-4 text-xl opacity-40 uppercase"><i class="fa-solid fa-list"></i></i> Municipio de San Lorenzo</p>

            <livewire:canton-district.canton-district-san-lorenzo-data-table />
        </div>
        <div class="pt-8 space-y-10">
            <p class="mt-4 text-xl opacity-40 uppercase"><i class="fa-solid fa-list"></i></i> Municipio de El Puente</p>

            <livewire:canton-district.canton-district-el-puente-data-table />
        </div>
        <div class="pt-8 space-y-10">
            <p class="mt-4 text-xl opacity-40 uppercase"><i class="fa-solid fa-list"></i></i> Municipio de Entre Ríos</p>

            <livewire:canton-district.canton-district-entre-rios-data-table />
        </div>
        <div class="pt-8 space-y-10">
            <p class="mt-4 text-xl opacity-40 uppercase"><i class="fa-solid fa-list"></i></i> Municipio de Uriondo</p>

            <livewire:canton-district.canton-district-uriondo-data-table />
        </div>
        <div class="pt-8 space-y-10">
            <p class="mt-4 text-xl opacity-40 uppercase"><i class="fa-solid fa-list"></i></i> Municipio de Yunchara</p>

            <livewire:canton-district.canton-district-yunchara-data-table />
        </div>
        <div class="pt-8 space-y-10">
            <p class="mt-4 text-xl opacity-40 uppercase"><i class="fa-solid fa-list"></i></i> Municipio de Padcaya</p>

            <livewire:canton-district.canton-district-padcaya-data-table />
        </div>
        <div class="pt-8 space-y-10">
            <p class="mt-4 text-xl opacity-40 uppercase"><i class="fa-solid fa-list"></i></i> Municipio de Bermejo</p>

            <livewire:canton-district.canton-district-bermejo-data-table />
        </div>
    </div>
</div>
