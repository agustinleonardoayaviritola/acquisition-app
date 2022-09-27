<div class="flex space-x-1 justify-around">
    {{-- The Master doesn't talk, he acts. --}}
  {{-- print detail --}}
    <a href="{{ route('delivery-basket-subgobernment.print', $slug) }}"
        class="p-1 text-cyan-500 hover:bg-cyan-600 hover:text-white rounded-full">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
            <path 
            d="M448 192H64C28.65 192 0 220.7 0 256v96c0 17.67 14.33 32 32 32h32v96c0 17.67 14.33 32 32 32h320c17.67 0 32-14.33 32-32v-96h32c17.67 0 32-14.33 32-32V256C512 220.7 483.3 192 448 192zM384 448H128v-96h256V448zM432 296c-13.25 0-24-10.75-24-24c0-13.27 10.75-24 24-24s24 10.73 24 24C456 285.3 445.3 296 432 296zM128 64h229.5L384 90.51V160h64V77.25c0-8.484-3.375-16.62-9.375-22.62l-45.25-45.25C387.4 3.375 379.2 0 370.8 0H96C78.34 0 64 14.33 64 32v128h64V64z"/>
        </svg>
    </a>
    {{-- end print detail --}}
    {{-- delet --}}
    <button wire:click="toastConfirmDelet('{{ $slug }}')"
        class="p-1 text-prmary-400 hover:bg-primary-300 hover:text-white rounded-full">

        <svg class="w-5 h-5"  viewBox="0 0 448 512" fill="currentColor">
            <path fill-rule="evenodd"
                d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z"
                />
        </svg>
    </button>
    {{-- end delet --}}
</div>
