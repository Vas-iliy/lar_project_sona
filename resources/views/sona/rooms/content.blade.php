<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Our Rooms</h2>
                    <div class="bt-option">
                        <a href="{{url('/')}}">Home</a>
                        <span>Rooms</span>
                        @if($alias)
                            <span>{{$rooms[0]->category->title}}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Rooms Section Begin -->
@if($rooms)
<section class="rooms-section spad">
    <div class="container">
        <div class="row">
            @foreach($rooms as $room)
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="{{asset(env('THEME'))}}/img/room/{{$room->img}}" alt="">
                        <div class="ri-text">
                            <h4>{{$room->title}}</h4>
                            <h3>{{$room->price}}$<span>/Pernight</span></h3>
                            <table>
                                <tbody>
                                <tr>
                                    <td class="r-o">Size:</td>
                                    <td>{{$room->size}}</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Capacity:</td>
                                    <td>{{$room->capacity}}</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Bed:</td>
                                    <td>{{$room->bed}}</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Services:</td>
                                    <td>
                                        @foreach($room->services as $k=>$service)
                                            {{$service->title}},{{$k == 2 ? '...' : ''}}
                                            @if($k == 2)
                                                @break
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
                @if($rooms->lastPage() > 1)
                    <div class="col-lg-12">
                        <div class="room-pagination">
                            @if($rooms->currentPage() !== 1)
                                <a href="{{$rooms->previousPageUrl()}}"><<</a>
                            @endif
                            @for($i = 1; $i <= $rooms->lastPage(); $i++)
                                <a {{$rooms->currentPage() == $i ? 'class=active' : '' }} href="{{$rooms->url($i)}}">{{$i}}</a>
                            @endfor
                            @if($rooms->currentPage() !== $rooms->lastPage())
                                <a href="{{$rooms->nextPageUrl()}}">>></a>
                            @endif
                        </div>
                    </div>
                @endif
        </div>
    </div>
</section>
@endif
