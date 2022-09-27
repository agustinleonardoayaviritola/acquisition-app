<div>
        @foreach ($BasketProducts as $P)
            <p class="flex text-sm">
                {{ $P->amount.'  '.$P->product->name }}
            </p>
        @endforeach
</div>
