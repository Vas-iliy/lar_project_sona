@if($menus)
    @foreach($menus as $menu)
        <li {{\Illuminate\Support\Facades\URL::current() == $menu->url() ? 'class=active' : ''}}>
            <a href="{{$menu->url()}}">{{$menu->title}}</a>
            @if($menu->hasChildren())
                <ul class="dropdown">
                    @include(env('THEME') . '.content_menu', ['menus' => $menu->children()])
                </ul>
            @endif
        </li>
    @endforeach
@endif
