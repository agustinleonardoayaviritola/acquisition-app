<div>
    {{-- The whole world belongs to you. --}}
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Entregas realizadas
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="w-full flex justify-end space-x-2">
        </div class="m-5">
        <livewire:delivery-basket-detail-subgobernment.delivery-basket-detail-data-table />
    </div>
</div>
