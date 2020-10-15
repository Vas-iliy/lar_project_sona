<?php

namespace App\Http\Controllers;

use App\Repositories\ContactRepository;
use App\Repositories\ImageRepository;
use App\Repositories\PageRepository;
use App\Repositories\SocialRepository;
use App\Repositories\TextRepository;
use Illuminate\Support\Arr;

class HomeController extends SiteController
{
    public function __construct(PageRepository $page_rep, SocialRepository $social_rep, ContactRepository $contact_rep, TextRepository $text_rep, ImageRepository $image_rep)
    {
        parent::__construct($page_rep, $social_rep, $contact_rep, $text_rep, $image_rep);

        $this->page = 'home';
        $this->template = env('THEME') . '.' . $this->page . '.' . $this->page;
    }

    public function index()
    {
        $content = view(env('THEME') . '.' . $this->page .'.content', compact([]));
        $this->vars = Arr::add($this->vars, 'content', $content);

        return $this->renderOutput();
    }
}
