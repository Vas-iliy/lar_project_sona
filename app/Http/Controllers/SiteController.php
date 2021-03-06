<?php

namespace App\Http\Controllers;

use App\Category;
use App\Page;
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

class SiteController extends Controller
{
    protected $page_rep;
    protected $image_rep;
    protected $text_rep;
    protected $service_rep;
    protected $room_rep;
    protected $comment_rep;
    protected $blog_rep;
    protected $contact_rep;
    protected $social_rep;
    protected $check_rep;
    protected $user_rep;
    protected $db_rep;
    protected $fact_rep;

    protected $page;
    protected $template;
    protected $content = false;
    protected $vars = [];

    public function __construct(PageRepository $page_rep, SocialRepository $social_rep, ContactRepository $contact_rep,
                TextRepository $text_rep, ImageRepository $image_rep, ServiceRepository $service_rep, RoomRepository $room_rep,
                CommentRepository $comment_rep, BlogRepository $blog_rep)
    {
        $this->page_rep = $page_rep;
        $this->social_rep = $social_rep;
        $this->contact_rep = $contact_rep;
        $this->text_rep = $text_rep;
        $this->image_rep = $image_rep;
        $this->service_rep = $service_rep;
        $this->room_rep = $room_rep;
        $this->comment_rep = $comment_rep;
        $this->blog_rep = $blog_rep;
    }

    protected function renderOutput()
    {
        $menu = $this->getMenu();
        $social = $this->getSocial(config('settings.count_socials_header'));
        $contacts = $this->getContact(config('settings.count_contacts_header'));

        $navigations = view(env('THEME') . '.menu', compact(['menu', 'social', 'contacts']))->render();
        $this->vars = Arr::add($this->vars, 'navigations', $navigations);

        $text = $this->getTextOne(['position', 'footer']);
        $soc = $this->getSocial();
        $contact = $this->getContact();

        if ($this->content) {
            $this->vars = Arr::add($this->vars, 'content', $this->content);
        }

        $footer = view(env('THEME') . '.footer', compact(['text', 'soc', 'contact']))->render();
        $this->vars = Arr::add($this->vars, 'footer', $footer);

        return view($this->template)->with($this->vars);
    }

    public function arrChange($array) {
        $newArray = [];
        foreach ($array as $k => $arr) {
            if ($arr->position) {
                $k = $arr->position;
            }
            $newArray = Arr::add($newArray, $k, $arr);
        }

        return $newArray;
    }

    protected function getPage($page) {
        return Page::select('id')->where('alias', $page)->first()->id;
    }

    protected function dateChange($date, $format) {
        $date = date_create($date);
        $date = date_format($date, $format);

        return $date;
    }

    private function getMenu()
    {
        $menus = $this->page_rep->get();
        $builder = \Menu::make('myMenu', function ($m) use ($menus) {
            foreach ($menus as $menu) {
                if ($menu->parent == 0) {
                    $m->add($menu->title, $menu->path)->id($menu->id);
                }
                else {
                    if ($m->find($menu->parent)) {
                        $m->find($menu->parent)->add($menu->title, $menu->path)->id();
                    }
                }
            }
        });

        return $builder;
    }

    protected function getSocial($take = false) {
        return $this->social_rep->get('*', $take);;
    }
    protected function getContact($take = false) {
        return $this->contact_rep->get('*', $take);
    }
    protected function getTextOne($where) {
        return $this->text_rep->one('*', $where);
    }
    protected function getImage($where, $take = false) {
        return $this->image_rep->get('*', $take, $where);
    }

    protected function getText($where) {
        return $this->text_rep->get('*', false, $where);
    }
    protected function getService($where, $take = false) {
        return $this->service_rep->get('*', $take, $where);
    }

    protected function getRoom($take = false, $alias = false, $paginate = false, $where = false) {
        if ($where) {
            return $this->room_rep->get('*', false, false, false, $where);
        }
        $where = false;
        if ($alias) {
            $id = Category::select('id')->where('alias', $alias)->first()->id;
            $where = ['category_id', $id];
        }

        $room = $this->room_rep->get('*', $take, $where, $paginate);
        $room->load('services');

        return $room;
    }

    protected function getComment($take = false, $where = false) {
        $comment = $this->comment_rep->get('*', $take, $where);
        $comment->load('user');

        return $comment;
    }

    protected function getBlog($take = false, $paginate = false) {
        $blog = $this->blog_rep->get('*', $take, false, $paginate);
        $blog->load('filters');

        return $blog;
    }

}
