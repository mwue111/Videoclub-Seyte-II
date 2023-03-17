@forelse($reviews as $review){
<a href="">{{$review -> title}}</a>
}
@empty
<p>No reviews</p>
@endforelse