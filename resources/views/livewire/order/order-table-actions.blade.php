<div class="flex space-x-1 justify-around">
    @if (Auth::user()->hasAnyRole(['superadmin', 'admin']))
        {{-- edit --}}
        <a href="{{ route('order-detail.dashboard', $slug) }}"
            class="p-1 text-blue-600 hover:bg-blue-600 hover:text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
              </svg>
              
        </a>
        {{-- end edit --}}
    @endif
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
