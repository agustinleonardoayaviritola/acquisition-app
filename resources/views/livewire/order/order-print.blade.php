<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Area de impresion
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div wire:ignore class="justify-center border-dashed bg-white border-2 m-8 p-4">
            <div id="printableArea" class="m-8 mt-0 p-2">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="..."><img class="logo object-scale-down h-28  inline-block"
                                        src="{{ asset('/images/logo-gobernacion.svg') }}" /></div>
                                    <div class="...">02</div>
                                    <div class="...">03</div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
