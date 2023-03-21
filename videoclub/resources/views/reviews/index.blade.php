@forelse($reviews as $review)
<div>
  <a href="{{route('resenas.show', $review)}}">{{$review->title}}</a>
  <p>{{$review->description}}</p>
</div>


@empty
<p>No reviews</p>
@endforelse