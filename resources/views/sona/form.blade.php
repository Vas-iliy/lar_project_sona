<div class="check-date">
    <label for="date-in">Check In:</label>
    <input type="text" name="checkIn" class="date-input" id="date-in">
    <i class="icon_calendar"></i>
</div>
<div class="check-date">
    <label for="date-out">Check Out:</label>
    <input type="text" name="checkOut" class="date-input" id="date-out">
    <i class="icon_calendar"></i>
</div>
<div class="select-option">
    <label for="guest">Guests:</label>
    <select name="guest" id="guest">
        @if(\Illuminate\Support\Facades\URL::current() == url('/'))
        <option value="1">1 Adults</option>
        <option value="2">2 Adults</option>
        <option value="3">3 Adults</option>
        <option value="4">4 Adults</option>
        <option value="5">5 Adults</option>
        <option value="6">6 Adults</option>
        @else
            @if($guests)
                @for($i=1; $i<=$guests; $i++)
                    <option value="{{$i}}">{{$i}} Adults</option>
                @endfor
            @endif
        @endif
    </select>
</div>
<div class="select-option">
    <label for="room">Room:</label>
    <select name="room" id="room">
        @if(\Illuminate\Support\Facades\URL::current() == url('/'))
            <option value="1">1 Room</option>
            <option value="2">2 Room</option>
            <option value="3">3 Room</option>
        @else
            @if($count)
                @foreach($count as $c)
                    <option value="{{$c->count}}">{{$c->count}} Room</option>
                @endforeach
            @endif
        @endif
    </select>
</div>
