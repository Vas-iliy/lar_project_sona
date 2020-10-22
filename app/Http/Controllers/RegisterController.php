<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Repositories\BlogRepository;
use App\Repositories\CommentRepository;
use App\Repositories\ContactRepository;
use App\Repositories\ImageRepository;
use App\Repositories\PageRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\SocialRepository;
use App\Repositories\TextRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends SiteController
{
    public function __construct(PageRepository $page_rep, SocialRepository $social_rep, ContactRepository $contact_rep, TextRepository $text_rep, ImageRepository $image_rep, ServiceRepository $service_rep, RoomRepository $room_rep, CommentRepository $comment_rep, BlogRepository $blog_rep)
    {
        parent::__construct($page_rep, $social_rep, $contact_rep, $text_rep, $image_rep, $service_rep, $room_rep, $comment_rep, $blog_rep);

        $this->page = 'auth';
        $this->template = env('THEME') . '.' . $this->page . '.register';
    }

    public function redirectTo() {
        return '/';
    }

    public function index() {
        if (Auth::guest()) {
            $content = view(env('THEME') . '.auth.content_register')->render();
            $this->vars = Arr::add($this->vars, 'content', $content);

            return $this->renderOutput();
        }
        else {
            return redirect()->back();
        }
    }

    public function register(RegisterRequest $request) {

        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $user->save();

        return redirect($this->redirectTo())->with('status', 'Вы успешно зарегестрированы');
    }

    public function login() {
        if (!Auth::check()) {
            $content = view(env('THEME') . '.' . $this->page . '.content_login')->render();
            $this->vars = Arr::add($this->vars, 'content', $content);

            return $this->renderOutput();
        }
        else {
            return redirect()->back();
        }
    }

    public function auth(Request $request) {
        $data = $request->only(['name', 'password']);

        if (Auth::attempt($data)) {
            return redirect('/');
        }

    }
}
