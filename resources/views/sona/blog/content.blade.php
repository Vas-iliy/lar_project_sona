@if($blog)
<section class="blog-section blog-page spad">
    <div class="container">
        <div class="row">
            @foreach($blog as $b)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-item set-bg" data-setbg="{{asset(env('THEME'))}}/img/blog/{{$b->img}}">
                        <div class="bi-text">
                            @if($b->filters)
                                @foreach($b->filters as $filter)
                                    <span class="b-tag">{{$filter->title}}</span>
                                @endforeach
                            @endif
                            <h4><a href="{{route('news.show', ['alias' => $b->id])}}">{{$b->title}}</a></h4>
                                @if($b->created_at)
                            <div class="b-time"><i class="icon_clock_alt"></i> {{$b->created_at->format('d M, Y')}}</div>
                                    @endif
                        </div>
                    </div>
                </div>
            @endforeach
            @if($blog->lastPage() > 1)
                <div class="col-lg-12">
                    <div class="room-pagination">
                        @if($blog->currentPage() !== 1)
                            <a href="{{$blog->previousPageUrl()}}"><<</a>
                        @endif
                        @for($i=1; $i <= $blog->lastPage(); $i++)
                            <a {{$blog->currentPage() == $i ? 'class=active' : '' }} href="{{$blog->url($i)}}"> {{$i}}</a>
                            @endfor
                            @if($blog->currentPage() !== $blog->lastPage())
                                <a href="{{$blog->nextPageUrl()}}">>></a>
                            @endif
                    </div>
                </div>
                @endif
        </div>
    </div>
</section>
@endif
