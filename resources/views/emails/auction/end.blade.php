<h4>Your auction has ended</h4>
<p>Auction for your <a href="{{ route('public.lots.show', $lot) }}">lot</a> has ended, please contact the winner at this address: {{ $lot->lastBid->user->email}}</p>

