<div wire:poll>
    <div class="row">
        <h6>Description</h6>
        <div>
            {{ $lot->description }}
        </div>
        <h6>Current price - {{ $price }}</h6>
    </div>
    <div class="row">
        @can('create', [App\Models\Bid::class, $lot])
            <div class="col">

                <form action="{{route('lots.bid', $lot)}}" method="post" id="bid-form">
                    <div class="input-group price-field">

                        @csrf
                        <input type="number" name="value" class="form-control price-input" placeholder="Your bet" value="{{ $value }}">
                        <button type="submit" class="btn btn-primary">Bet</button>

                        @if($lot->redemption_price)
                            <button type="button" id="buyout-button" data-buyout-price="{{ $lot->redemption_price }}" class="btn btn-success">{{ $lot->redemption_price }} - Buyout</button>
                        @endif
                    </div>
                </form>
            </div>
            <div class="col"></div>
            <div class="col"></div>
        @endcan
    </div>
    <div>
        <h4>Actions</h4>
        @can('favorites', [App\Models\Lot::class, $lot])
        <livewire:favorits-button :lot="$lot" />
        @endcan
        @foreach($messages as $message)
            <x-message :message="$message" />
        @endforeach
    </div>
</div>
