<x-layouts.base title="AUCTION.loc-All lots">


    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">



            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">

                @foreach($lots as $item)
                    <x-lots.item :item="$item" />
                @endforeach

            </div>
            {{ $lots->links() }}
        </div>
    </div>
</x-layouts.base>
