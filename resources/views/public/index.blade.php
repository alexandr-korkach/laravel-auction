<x-layouts.base title="AUCTION.loc">
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">AUCTION.loc</h1>
                <p class="lead text-muted">{{__("Create your own auction, buy goods at the cheapest price, follow the events and grow your business")}}</p>
                <p>
                    <a href="{{ route('public.lots.all') }}" class="btn btn-primary my-2">{{__("Go to all lots")}}</a>
                    <a href="{{ route('public.actions') }}" class="btn btn-secondary my-2">{{__("Follow the events")}}</a>
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                @if(count($lots))
                @foreach($lots as $item)
                    <x-lots.item :item="$item" />
                @endforeach
                @else
                    {{__("No lots...")}}
                @endif

            </div>
        </div>
    </div>
</x-layouts.base>
