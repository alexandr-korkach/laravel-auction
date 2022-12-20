<x-layouts.base title="AUCTION.loc-Search result">


    <div class="album py-5 bg-light">
        <div class="container">
            <h3 class="mb-4">Your search term "{{ $search }}" found {{$lots->count()}} results</h3>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">

                @foreach($lots as $item)
                    <x-lots.item :item="$item" />
                @endforeach

            </div>
            {{ $lots->links() }}
        </div>
    </div>
</x-layouts.base>
