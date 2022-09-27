<div class="flex space-x-1 justify-around">
    @if (Auth::user()->hasAnyRole(['superadmin', 'admin']))
        {{-- edit --}}
        <a href="{{ route('beneficiary.update', $slug) }}"
            class="p-1 text-blue-600 hover:bg-blue-600 hover:text-white rounded-full">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
        </a>
        {{-- end edit --}}
    @endif
    @if (Auth::user()->hasAnyRole(['superadmin', 'admin', 'user']))
        {{-- print --}}
        <a href="{{ route('beneficiary.print', $slug) }}"
            class="p-1 text-blue-600 hover:bg-blue-600 hover:text-white rounded-full">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
                <path
                    d="M448 192H64C28.65 192 0 220.7 0 256v96c0 17.67 14.33 32 32 32h32v96c0 17.67 14.33 32 32 32h320c17.67 0 32-14.33 32-32v-96h32c17.67 0 32-14.33 32-32V256C512 220.7 483.3 192 448 192zM384 448H128v-96h256V448zM432 296c-13.25 0-24-10.75-24-24c0-13.27 10.75-24 24-24s24 10.73 24 24C456 285.3 445.3 296 432 296zM128 64h229.5L384 90.51V160h64V77.25c0-8.484-3.375-16.62-9.375-22.62l-45.25-45.25C387.4 3.375 379.2 0 370.8 0H96C78.34 0 64 14.33 64 32v128h64V64z" />
            </svg>
        </a>
        {{-- end print --}}
    @endif

    {{-- edit state --}}
    @if (Auth::user()->hasAnyRole(['superadmin', 'admin']))
        <a href="{{ route('beneficiary.update.state', $slug) }}"
            class="p-1 text-teal-600 hover:bg-teal-600 hover:text-white rounded-full">
            <svg class="w-5 h-5" viewBox="0 0 576 512" fill="currentColor">
                <path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V285.7l-86.8 86.8c-10.3 10.3-17.5 23.1-21 37.2l-18.7 74.9c-2.3 9.2-1.8 18.8 1.3 27.5H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM549.8 235.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-29.4 29.4-71-71 29.4-29.4c15.6-15.6 40.9-15.6 56.6 0zM311.9 417L441.1 287.8l71 71L382.9 487.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z"/>
            </svg>
        </a>
    @endif
    {{-- end edit state --}}

    @if (Auth::user()->hasAnyRole(['superadmin']))
        {{-- delet --}}
        <button wire:click="toastConfirmDelet('{{ $slug }}')"
            class="p-1 text-red-600 hover:bg-red-600 hover:text-white rounded-full">

            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
        </button>
        {{-- end delet --}}
    @endif
</div>


