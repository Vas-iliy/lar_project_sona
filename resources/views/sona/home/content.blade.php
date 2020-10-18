<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                @if($text['top'])
                    <div class="hero-text">
                        <h1>{{$text['top']->title}}</h1>
                        <p>{!! $text['top']->text !!}</p>
                    </div>
                @endif
            </div>
            <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                @include(env('THEME') . '.search')
            </div>
        </div>
    </div>
    @if($images)
        <div class="hero-slider owl-carousel">
            @foreach($images as $image)
                <div class="hs-item set-bg" data-setbg="{{asset(env('THEME'))}}/img/hero/{{$image->img}}"></div>
            @endforeach
        </div>
    @endif
</section>
<!-- Hero Section End -->

<!-- About Us Section Begin -->
<section class="aboutus-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                @if($text['about'])
                    <div class="about-text">
                        <div class="section-title">
                            <span>{{$text['about']->title}}</span>
                        </div>
                        <p>{!! $text['about']->text !!}</p>
                        <a href="#" class="primary-btn about-btn">Read More</a>
                    </div>
                @endif
            </div>
            <div class="col-lg-6">
                @if($imagesAbout)
                    <div class="about-pic">
                        <div class="row">
                            @foreach($imagesAbout as $img)
                                <div class="col-sm-6">
                                    <img src="{{asset(env('THEME'))}}/img/about/{{$img->img}}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- About Us Section End -->

<!-- Services Section End -->
<section class="services-section spad">
    <div class="container">
        @if($text['service'])
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>{{$text['service']->title}}</span>
                        <p>{!! $text['service']->text !!}</p>
                    </div>
                </div>
            </div>
        @endif
        @if($services)
            <div class="row">
                @foreach($services as $service)
                    <div class="col-lg-4 col-sm-6">
                        <div class="service-item">
                            <i class="{{$service->icon}}"></i>
                            <h4>{{$service->title}}</h4>
                            <p>{{$service->descr}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
    </div>
</section>
<!-- Services Section End -->

<!-- Home Room Section Begin -->
@if($rooms)
<section class="hp-room-section">
    <div class="container-fluid">
        <div class="hp-room-items">
            <div class="row">
                @foreach($rooms as $room)
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="{{asset(env('THEME'))}}/img/room/{{$room->img}}">
                            <div class="hr-text">
                                <h3>{{$room->title}}</h3>
                                <h2>{{$room->price}}$<span>/Pernight</span></h2>
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
                                <a href="{{route('rooms.show', ['alias' => \Illuminate\Support\Str::replaceFirst(' ', '-', $room->title)])}}" class="primary-btn">More Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
<!-- Home Room Section End -->

<!-- Testimonial Section Begin -->
<section class="testimonial-section spad">
    <div class="container">
        @if($text['comment'])
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>{{$text['comment']->title}}</span>
                        <p>{!! $text['comment']->text !!}</p>
                    </div>
                </div>
            </div>
        @endif
        @if($comments)
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-slider owl-carousel">
                        @foreach($comments as $comment)
                            <div class="ts-item">
                                <p>{!! $comment->text !!}</p>
                                <div class="ti-author">
                                    <div class="rating">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star-half_alt"></i>
                                    </div>
                                    <h5> - Alexander Vasquez</h5>
                                </div>
                                <img src="img/testimonial-logo.png" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
    </div>
</section>
<!-- Testimonial Section End -->

<!-- Blog Section Begin -->
<section class="blog-section spad">
    <div class="container">
        @if($text['blog'])
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>{{$text['blog']->title}}</span>
                        <p>{!! $text['blog']->text !!}</p>
                    </div>
                </div>
            </div>
        @endif
        @if($blog)
            <div class="row">
                @foreach($blog as $k=>$b)
                    <div class="{{$k < 3 ? 'col-lg-4' : 'col-lg-6'}}">
                        <div class="blog-item {{$k < 3 ? '' : 'small-size'}} set-bg" data-setbg="{{asset(env('THEME'))}}/img/blog/{{$b->img}}">
                            <div class="bi-text">
                                @foreach($b->filters as $filter)
                                    <span class="b-tag">{{$filter->title}}</span>
                                @endforeach
                                <h4><a href="{{route('news.show', ['alias' => $b->id])}}">{{$b->title}}</a></h4>
                                    @if($b->created_at)
                                     <div class="b-time"><i class="icon_clock_alt"></i> {{$b->created_at->format('d m, Y')}}</div>
                                        @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
<!-- Blog Section End -->
