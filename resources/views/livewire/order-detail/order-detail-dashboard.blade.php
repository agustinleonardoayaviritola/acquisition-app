<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de Pedido
        </div>
    </x-slot>
    <div class=" max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="w-full flex justify-start space-x-2 container bg-white">
            <div class="my-2 mx-4">
                <h1 class="text-lg opacity-50">Información de pedido</h1>
                <h1 class="text-2xl">Número: {{ $order->application_number }}</h1>
                <h2 class="text-xl font-bold">Total: {{ $order->total }}</h2>
            </div>
        </div>
        <div class="w-full flex justify-end space-x-2 mt-4">
            <a href="{{ route('order-detail.create', $order->slug) }}"
                class="my-2  mx-4 border-2 border-green-500 text-green-500 bg-white flex items-center rounded-full hover:bg-green-500 hover:text-white">
                <svg class="w-8 h-8 m-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        <div class="m-5">
            <livewire:order-detail.order-detail-data-table :order_id="$order->id" />
        </div>
    </div>

</div>
