<h4>Lot - "{{ $lot->title }}" Created</h4>
<p>{{ $lot->description }}</p>
<a href="{{ route('public.lots.show', $lot) }}">read more...</a>
