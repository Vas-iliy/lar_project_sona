<section class="room-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
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
                                    <img src="{{asset(env('THEME'))}}/img/room/avatar/{{$comment->user->image}}" alt="">
                                </div>
                                <div class="ri-text">
                                    <span>{{$comment->created_at->format('d M, Y')}}</span>
                                    <div class="rating">
                                        @for($i=0; $i < (int)$comment->user->fact->ratings[0]->rating; $i++)
                                            <i class="icon_star"></i>
                                        @endfor
                                    </div>
                                    <h5>{{$comment->user->name}}</h5>
                                    <p>{!! $comment->text !!}</p>
                                </div>
                            </div>
                       @endforeach
                    </div>
                    @endif
                    @if($user)
                        <div class="review-add">
                            <h4>Add Review</h4>
                            <form action="{{route('comment')}}" class="ra-form" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <textarea name="text" placeholder="Your Review"></textarea>
                                        <input type="hidden" name="room_id" value="{{$room->id}}">
                                        <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                                        <button type="submit">Отправить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif

            </div>

            <div class="col-lg-6">
                <div class="booking-form">
                    <form action="{{route('reserv', ['alias' => \Illuminate\Support\Str::replaceFirst(' ', '-', $room->title)])}}" class="ra-form" method="post">
                        @csrf
                        @include(env('THEME') . '.form', ['count' => $room->counts, 'guests' => $room->capacity])
                        <div class="review-add">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="name" placeholder="Name*">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="email" placeholder="Email*">
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" name="phone" placeholder="Phone*">
                                    <button type="submit">Reservation</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
