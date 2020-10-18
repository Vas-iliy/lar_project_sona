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

class BlogController extends SiteController
{
    public function __construct(PageRepository $page_rep, SocialRepository $social_rep, ContactRepository $contact_rep, TextRepository $text_rep, ImageRepository $image_rep, ServiceRepository $service_rep, RoomRepository $room_rep, CommentRepository $comment_rep, BlogRepository $blog_rep)
    {
        parent::__construct($page_rep, $social_rep, $contact_rep, $text_rep, $image_rep, $service_rep, $room_rep, $comment_rep, $blog_rep);

        $this->page = 'blog';
        $this->template = env('THEME') . '.' . $this->page . '.' . $this->page;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $blog = $this->getBlog(false, config('settings.count_blog'));

        $content = view(env('THEME') . '.' . $this->page . '.content', compact(['blog']))->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        return $this->renderOutput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
