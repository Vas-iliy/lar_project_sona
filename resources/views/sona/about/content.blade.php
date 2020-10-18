<section class="aboutus-page-section spad">
    <div class="container">
        @if($images)
            <div class="about-page-services">
                <div class="row">
                    @foreach($images as $image)
                        @if($image->position == 'top')
                            <div class="col-md-4">
                                <div class="ap-service-item set-bg" data-setbg="{{asset(env('THEME'))}}/img/about/{{$image->img}}">
                                    <div class="api-text">
                                        <h3>{{$image->title}}</h3>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
        <div class="about-page-text">
            <div class="row">
                @if($text['top'])
                    <div class="col-lg-6">
                        <div class="ap-title">
                            <h2>{{$text['top']->title}}</h2>
                            <p>{!! $text['top']->text !!}</p>
                        </div>
                    </div>
                @endif
                @if($services)
                    <div class="col-lg-5 offset-lg-1">
                        <ul class="ap-services">
                            @foreach($services as $service)
                                <li><i class="icon_check"></i> {{$service->title}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
            </div>
        </div>
    </div>
</section>

@if($images)
<section class="gallery-section spad">
    <div class="container">
            <div class="row">
                @foreach($images as $img)
                    @if($img->position == 'gallery')
                        <div class="col-6">
                            <div class="gallery-item set-bg" data-setbg="{{asset(env('THEME'))}}/img/gallery/{{$img->img}}">
                                <div class="gi-text">
                                    <h3>{{$img->title}}</h3>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
    </div>
</section>
@endif
