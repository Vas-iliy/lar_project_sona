<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends SiteController
{
    public function __construct()
    {
        $this->page = 'home';
        $this->template = env('THEME') . '.' . $this->page . '.' . $this->page;
    }

    public function index()
    {


        return view(env('THEME') . '.layouts.site');
    }
}
