<div class="flex space-x-1 justify-around">
    @if (Auth::user()->hasAnyRole(['superadmin', 'admin']))
    {{-- edit --}}
    <a href="{{ route('canton-district.update', $slug) }}"
        class="p-1 text-blue-600 hover:bg-blue-600 hover:text-white rounded-full">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path
                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
        </svg>
    </a>
    {{-- end edit --}}
    @endif
    @if (Auth::user()->hasAnyRole(['superadmin', 'admin']))
    {{-- add neighborhood-community --}}
    <a href="{{ route('neighborhood-community.create', $slug) }}"
        class="p-1 text-blue-600 hover:bg-blue-600 hover:text-white rounded-full">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
            <path 
                d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"/>
        </svg>
    </a>
    {{-- end neighborhood-community --}}
    @endif
    @if (Auth::user()->hasAnyRole(['superadmin', 'admin']))
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
