<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use App\Repositories\CommentRepository;
use App\Repositories\ContactRepository;
use App\Repositories\ImageRepository;
use App\Repositories\PageRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\SocialRepository;
use App\Repositories\TextRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class HomeController extends SiteController
{
    public function __construct(PageRepository $page_rep, SocialRepository $social_rep, ContactRepository $contact_rep, TextRepository $text_rep, ImageRepository $image_rep, ServiceRepository $service_rep, RoomRepository $room_rep, CommentRepository $comment_rep, BlogRepository $blog_rep)
    {
        parent::__construct($page_rep, $social_rep, $contact_rep, $text_rep, $image_rep, $service_rep, $room_rep, $comment_rep, $blog_rep);

        $this->page = 'home';
        $this->template = env('THEME') . '.' . $this->page . '.' . $this->page;
    }

    public function index()
    {
        $id = $this->getPage($this->page);

        $text = $this->getText(['page_id', $id]);
        $text = $this->arrChange($text);
        $images = $this->getImage(['page_id', $id]);
        $imagesAbout = $this->getImage(['page_id', $this->getPage('about')], config('settings.count_image_home_about'));
        $services = $this->getService(['page_id', $id]);
        $rooms = $this->getRoom(config('settings.count_rooms_home'));
        $comments = $this->getComment(config('settings.count_comments_home'));/*
        dd($comments[0]->user->fact->ratings[0]);*/
        $blog = $this->getBlog(config('settings.count_blog_home'));

        $content = view(env('THEME') . '.' . $this->page .'.content', compact(['images', 'text', 'imagesAbout',
            'services', 'rooms', 'comments', 'blog']))->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        return $this->renderOutput();
    }
}
