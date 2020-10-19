<section class="room-details-section spad">
    <div class="container">
        @if($room)
            <div class="room-details-item">
                <img src="{{asset(env('THEME'))}}/img/room/{{$room->img}}" alt="">
                <div class="rd-text">
                    <div class="rd-title">
                        <h3>{{$room->title}}</h3>
                        <div class="rdt-right">
                            <div class="rating">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star-half_alt"></i>
                            </div>
                            <a href="#">Booking Now</a>
                        </div>
                    </div>
                    <h2>{{$room->price}}<span>/Pernight</span></h2>
                    <table>
                        <tbody>
                        <tr>
                            <td class="r-o">Room:</td>
                            <td>{{$count}}</td>
                        </tr>
                        <tr>
                            <td class="r-o">Size:</td>
                            <td>{{$room->size}}</td>
                        </tr>
                        <tr>
                            <td class="r-o">Capacity:</td>
                            <td>Max person {{$room->capacity}}</td>
                        </tr>
                        <tr>
                            <td class="r-o">Bed:</td>
                            <td>{{$room->bed}}</td>
                        </tr>
                        <tr>
                            <td class="r-o">Services:</td>
                            <td>
                                @foreach($room->services as $k=>$service)
                                    {{$service->title}},
                                @endforeach
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <p>{!! $room->descr !!}</p>
                </div>
            </div>
        @endif
        @if($comments)
                <div class="rd-reviews">
                    <h4>Reviews</h4>
                    @foreach($comments as $comment)
                        <div class="review-item">
                            <div class="ri-pic">
                                <img src="img/room/avatar/avatar-1.jpg" alt="">
                            </div>
                            <div class="ri-text">
                                <span>{{$comment->created_at->format('d M, Y')}}</span>
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5>Brandon Kelley</h5>
                                <p>{!! $comment->text !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
    </div>
</section>
