<section class="search">
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Room</th>
                <th scope="col">Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rooms as $k => $room)
                <tr>
                    <th scope="row">{{$k + 1}}</th>
                    <td>
                        <a href="{{route('rooms.show', ['alias' => \Illuminate\Support\Str::replaceFirst(' ', '-', $room->title)])}}">
                            <img class="search-img" src="{{asset(env('THEME'))}}/img/room/{{$room->img}}">
                        </a>
                    </td>
                    <td>{{$room->title}}</td>
                    <td>{{$count}}</td>
                    <td>{{$room->price}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>
