<div>
    @if ($state == 'ACTIVO')
        <span
            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 uppercase">
            ACTIVO
        </span>
    @endif
    @if ($state == 'INACTIVO')
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 uppercase">
        INACTIVO
        </span>
    @endif
</div>
