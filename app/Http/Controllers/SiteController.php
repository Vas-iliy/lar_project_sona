<?php

namespace App\Http\Controllers;

use App\Repositories\ContactRepository;
use App\Repositories\ImageRepository;
use App\Repositories\PageRepository;
use App\Repositories\SocialRepository;
use App\Repositories\TextRepository;
use App\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

    public function __construct(PageRepository $page_rep, SocialRepository $social_rep, ContactRepository $contact_rep,
                TextRepository $text_rep, ImageRepository $image_rep)
    {
        $this->page_rep = $page_rep;
        $this->social_rep = $social_rep;
        $this->contact_rep = $contact_rep;
        $this->text_rep = $text_rep;
        $this->image_rep = $image_rep;
    }

    protected function renderOutput()
    {
        $menu = $this->getMenu();
        $social = $this->getSocial();
        $contacts = $this->getContact(config('settings.count_contacts_header'));

        $navigations = view(env('THEME') . '.menu', compact(['menu', 'social', 'contacts']))->render();
        $this->vars = Arr::add($this->vars, 'navigations', $navigations);

        $text = $this->getTextOne(['position', 'footer']);
        $soc = $this->getSocial();
        $contact = $this->getContact();

        $footer = view(env('THEME') . '.footer', compact(['text', 'soc', 'contact']))->render();
        $this->vars = Arr::add($this->vars, 'footer', $footer);

        return view($this->template)->with($this->vars);
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
        $social = $this->social_rep->get('*', $take);

        return $social;
    }

    protected function getContact($take = false) {
        $contact = $this->contact_rep->get('*', $take);

        return $contact;
    }

    protected function getTextOne($where) {
        $text = $this->text_rep->one('*', $where);

        return $text;
    }

    protected function getImage() {
        $image = $this->image_rep->get();

        return $image;
    }

}
