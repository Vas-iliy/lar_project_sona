<div class="booking-form">
    <h3>Booking Your Hotel</h3>
    <form action="{{route('search')}}" method="post">
        @csrf
        @include(env('THEME') . '.form')
        <button type="submit">Check Availability</button>
    </form>
</div>
