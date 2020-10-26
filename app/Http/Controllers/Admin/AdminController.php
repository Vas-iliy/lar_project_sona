<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $template;
    protected $content = false;
    protected $vars = [];
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();

            return $next($request);
        });
    }

    protected function renderOutput() {
        $menu = $this->getMenu();
        $navigations = view(env('THEME') . '.admin.menu', compact('menu'))->render();
        $this->vars = Arr::add($this->vars, 'navigations', $navigations);

        if ($this->content) {
            $this->vars = Arr::add($this->vars, 'content', $this->content);
        }

        return view($this->template)->with($this->vars);
    }

    private function getMenu() {
        return \Menu::make('adminMenu', function ($menu) {
           $menu->add('Комнаты', ['route' => 'room.index']);
           $menu->add('Статьи', ['route' => 'room.index']);
           $menu->add('Пользователи', ['route' => 'room.index']);
           $menu->add('Привелегии', ['route' => 'room.index']);
        });
    }
}
