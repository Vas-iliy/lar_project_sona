<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    protected $page_rep;
    protected $category_rep;
    protected $image_rep;
    protected $text_rep;
    protected $service_rep;
    protected $room_rep;
    protected $comment_rep;
    protected $blog_rep;
    protected $inform_rep;
    protected $filter_rep;
    protected $contact_rep;
    protected $social_rep;
    protected $guest_rep;
    protected $check_rep;
    protected $count_rep;

    protected $page;
    protected $template;
    protected $vars = [];

    protected function renderOutput()
    {
        return view($this->template)->with($this->vars);
    }
}
