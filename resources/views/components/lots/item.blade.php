<div class="col">
    <div class="card h-100">
        <img src="{{ asset($item->image->url) }}" class="card-img-top" alt="{{ $item->title }}">
        <div class="card-body">
            <h5 class="card-title">{{ $item->title }} <span class="badge bg-{{ $item->status->textForHtml() }}">{{ $item->status->text() }}</span></h5>
            <p class="card-text">{{ Str::limit($item->description, 50) }}</p>
            @if($item->status == \App\Enums\LotStatus::Created)
                <h6>{{ __('Starting price') }} - {{ $item->starting_price }}</h6>
            @else
                <h6>{{ __('Current price') }} - {{ $item->starting_price }}</h6>
            @endif
            <a href="{{ route('public.lots.show', $item) }}" class="btn btn-primary">{{ __('Detail') }}</a>
        </div>
        <div class="card-footer">
            <small class="text-muted timer" >
                @if($item->status == \App\Enums\LotStatus::Created)
                    <h6>{{ __('Time to start') }}: <span class="time-value" data-time="{{ $item->starting_at }}"></span></h6>
                @else
                    <h6>{{ __('Time to end') }}: <span class="time-value" data-time="{{ $item->ending_at }}"></span></h6>
                @endif</small>
        </div>
    </div>
</div>
