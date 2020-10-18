<section class="blog-details-hero set-bg" data-setbg="{{asset(env('THEME'))}}/img/blog/blog-details/{{isset($blog->images['top']) ? $blog->images['top']->img : 'blog-details-hero.jpg'}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="bd-hero-text">
                    @if($blog->filters)
                        @foreach($blog->filters as $k=>$filter)
                            <span>{{$filter->title}}</span>
                        @endforeach
                    @endif
                    <h2>{{$blog->title}}</h2>
                    <ul>
                        @if($blog->created_at)
                            <li class="b-time"><i class="icon_clock_alt"></i> {{$blog->created_at->format('d M, Y')}}</li>
                        @endif
                        <li><i class="icon_profile"></i> Kerry Jones</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@if($blog->informs)
<section class="blog-details-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="blog-details-text">
                    <div class="bd-title">
                        <p>{!! $blog->informs['top']->text !!}</p>
                    </div>
                    <div class="bd-pic">
                        @foreach($blog->images as $image)
                            @if(!$image->position)
                                <div class="bp-item">
                                    <img src="{{asset(env('THEME'))}}/img/blog/blog-details/{{$image->img}}" alt="">
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="bd-more-text">
                        <div class="bm-item">
                            <p>{!! $blog->informs['down']->text !!}</p>
                        </div>
                    </div>
                    @if($socials)
                        <div class="tag-share">
                            <div class="social-share">
                                <span>Share:</span>
                                @foreach($socials as $soc)
                                    <a href="{{$soc->link}}"><i class="{{$soc->icon}}"></i></a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{--<section class="recommend-blog-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Recommended</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="blog-item set-bg" data-setbg="img/blog/blog-1.jpg">
                    <div class="bi-text">
                        <span class="b-tag">Travel Trip</span>
                        <h4><a href="#">Tremblant In Canada</a></h4>
                        <div class="b-time"><i class="icon_clock_alt"></i> 15th April, 2019</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-item set-bg" data-setbg="img/blog/blog-2.jpg">
                    <div class="bi-text">
                        <span class="b-tag">Camping</span>
                        <h4><a href="#">Choosing A Static Caravan</a></h4>
                        <div class="b-time"><i class="icon_clock_alt"></i> 15th April, 2019</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-item set-bg" data-setbg="img/blog/blog-3.jpg">
                    <div class="bi-text">
                        <span class="b-tag">Event</span>
                        <h4><a href="#">Copper Canyon</a></h4>
                        <div class="b-time"><i class="icon_clock_alt"></i> 21th April, 2019</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>--}}
