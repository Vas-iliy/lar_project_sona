<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
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

class UsersController extends SiteController
{
    public function __construct(PageRepository $page_rep, SocialRepository $social_rep, ContactRepository $contact_rep, TextRepository $text_rep,
                                ImageRepository $image_rep, ServiceRepository $service_rep, RoomRepository $room_rep, CommentRepository $comment_rep,
                                BlogRepository $blog_rep)
    {
        parent::__construct($page_rep, $social_rep, $contact_rep, $text_rep, $image_rep, $service_rep, $room_rep, $comment_rep, $blog_rep);

        $this->template = env('THEME') . '.auth.register';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        $content = view(env('THEME') . '.auth.content_user', compact('user'));
        $this->vars = Arr::add($this->vars, 'content', $content);

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        $user = Auth::user();


    }
}
