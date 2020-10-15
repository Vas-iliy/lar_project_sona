<footer class="footer-section">
    <div class="container">
        <div class="footer-text">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ft-about">
                        <div class="logo">
                            <a href="#">
                                <img src="{{asset(env('THEME'))}}/img/footer-logo.png" alt="">
                            </a>
                        </div>
                        @if($text)
                            <p>{!! $text->text !!}</p>
                        @endif
                        @if($soc)
                            <div class="fa-social">
                                @foreach($soc as $s)
                                    <a href="{{$s->link}}"><i class="{{$s->icon}}"></i></a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="ft-contact">
                        <h6>Contact Us</h6>
                        @if($contact)
                            <ul>
                                @foreach($contact as $c)
                                    <li>{{$c->title}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="ft-newslatter">
                        <h6>New latest</h6>
                        <p>Get the latest updates and offers.</p>
                        {{--Тут потом делаем--}}
                        <form action="#" class="fn-form" method="post">
                            @csrf
                            <input type="text" placeholder="Email">
                            <button type="submit"><i class="fa fa-send"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
