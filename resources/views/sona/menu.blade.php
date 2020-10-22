<header class="header-section">
    <div class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @if($contacts)
                        <ul class="tn-left">
                            @foreach($contacts as $contact)
                                <li><i class="{{$contact->icon}}"></i> {{$contact->title}}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="tn-right">
                        @if($social)
                            <div class="top-social">
                                @foreach($social as $soc)
                                    <a href="{{$soc->link}}"><i class="{{$soc->icon}}"></i></a>
                                @endforeach
                            </div>
                        @endif
                        {{--<a href="#" class="bk-btn">Booking Now</a>--}}
                    </div>
                </div>
                <div class="col-lg-4">
                    @if(!\Illuminate\Support\Facades\Auth::check())
                        <div class="auth">
                            <a href="{{route('login')}}">Login</a>
                            <a href="{{route('register')}}">Register</a>
                        </div>
                    @else
                        <div class="person">
                            <button class="btn btn-person dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{\Illuminate\Support\Facades\Auth::user()->name}}
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">{{\Illuminate\Support\Facades\Auth::id()}}</a>
                                <a class="dropdown-item active" href="#">Active link</a>
                                <a class="dropdown-item" href="#">Another link</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo">
                        <a href="{{url('/')}}">
                            <img src="{{asset(env('THEME'))}}/img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                @if($menu)
                    <div class="col-lg-10">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    @include(env('THEME') . '.content_menu', ['menus' => $menu->roots()])
                                </ul>
                            </nav>
                            {{--<div class="nav-right search-switch">
                                <i class="icon_search"></i>
                            </div>--}}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>
<!-- Header End -->
