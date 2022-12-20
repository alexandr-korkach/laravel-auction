<x-layouts.base title="AUCTION.loc-actions">


    <div class="album py-5 bg-light">
        <div class="container">
            <h3>Last actions</h3>
            @if(count($messages))
                @foreach($messages as $message)
                    <div class="alert alert-{{ $message->type->textForHtml() }}" role="alert">
                        {!! $message->text !!}
                    </div>
                @endforeach


            {{ $messages->links() }}
            @else
                <p>No actions last 24 hours</p>
            @endif
        </div>
    </div>
</x-layouts.base>
