<header class="header-section">
    <div class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    @if($contacts)
                        <ul class="tn-left">
                            @foreach($contacts as $contact)
                                <li><i class="{{$contact->icon}}"></i> {{$contact->title}}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="col-lg-2">
                    <div class="tn-right">
                        @if($social)
                            <div class="top-social">
                                @foreach($social as $soc)
                                    <a href="{{$soc->link}}"><i class="{{$soc->icon}}"></i></a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    @if(!\Illuminate\Support\Facades\Auth::check())
                        <div class="auth">
                            <a href="{{route('login')}}">Login</a>
                            <a href="{{route('register')}}">Register</a>
                        </div>
                    @else
                        <div class="auth">
                            <a href="{{route('users.show', ['user' => \Illuminate\Support\Facades\Auth::user()->name])}}">{{\Illuminate\Support\Str::upper(\Illuminate\Support\Facades\Auth::user()->name)}}</a>
                            <a href="{{route('logout')}}">Logout</a>
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
