<div>
    @if ($state == 'ENTREGADO')
        <span
            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 uppercase">
            ENTREGADO
        </span>
    @endif
    @if ($state == 'PENDIENTE')
        <span
            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 uppercase">
            PENDIENTE
        </span>
    @endif
    @if ($state == 'DELETED')
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 uppercase">
            ELIMINADO
        </span>
    @endif
</div>
