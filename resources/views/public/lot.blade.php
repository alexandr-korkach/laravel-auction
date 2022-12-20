<x-layouts.base title="AUCTION.loc::{{ $lot->title }}">


    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-xs-1 row-cols-sm-1 row-cols-md-3 g-3">
                <div class="col">
                </div>
                <div class="col-8">
                    <h3>{{ $lot->title }}
                        </h3>

                    <div id="carouselExampleIndicators" class="carousel slide " data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach($lot->images as $image)
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="{{ $loop->index }}" @if($loop->first) class="active"
                                        @endif aria-current="true"></button>

                            @endforeach
                        </div>
                        <div class="carousel-inner ">
                            @foreach($lot->images as $image)
                                <div class="carousel-item  @if($loop->first) active @endif">
                                    <img src="{{ asset($image->url) }}" class="d-block w-100" alt="...">
                                </div>
                            @endforeach

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col">
                </div>
            </div>

            <livewire:lot-price :lot="$lot" />




        </div>
    </div>
</x-layouts.base>
