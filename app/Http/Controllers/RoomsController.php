<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentsRequest;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\SearchRequest;
use App\Mail\RoomMail;
use App\Repositories\BlogRepository;
use App\Repositories\CheckRepository;
use App\Repositories\CommentRepository;
use App\Repositories\ContactRepository;
use App\Repositories\DbRepository;
use App\Repositories\FactRepository;
use App\Repositories\ImageRepository;
use App\Repositories\PageRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\SocialRepository;
use App\Repositories\TextRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RoomsController extends SiteController
{
    public function __construct(PageRepository $page_rep, SocialRepository $social_rep, ContactRepository $contact_rep,
                                TextRepository $text_rep, ImageRepository $image_rep, ServiceRepository $service_rep,
                                RoomRepository $room_rep, CommentRepository $comment_rep, BlogRepository $blog_rep,
                                CheckRepository $check_rep, UserRepository $user_rep, FactRepository $fact_rep, DbRepository $db_rep)
    {
        parent::__construct($page_rep, $social_rep, $contact_rep, $text_rep, $image_rep, $service_rep, $room_rep, $comment_rep, $blog_rep);

        $this->check_rep = $check_rep;
        $this->user_rep = $user_rep;
        $this->fact_rep = $fact_rep;
        $this->db_rep = $db_rep;

        $this->page = 'rooms';
        $this->template = env('THEME') . '.' . $this->page . '.' . $this->page;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param bool $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index($alias = false)
    {
        $rooms = $this->getRoom(false, $alias, config('settings.count_rooms'));

        $this->content = view(env('THEME') . '.' . $this->page . '.content', compact(['rooms', 'alias']))->render();

        return $this->renderOutput();
    }

    /**
     * Display the specified resource.
     *
     * @param $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function show(Request $request, $alias)
    {
        $room = $this->room_rep->one('*', ['alias', $alias]);
        $comments = $this->getComment(false, ['room_id', $room->id]);
        $user = $this->getUser(Auth::id(), $room->id);

        if ($request->has('cod')) {
            $check = $this->getCheck(['cod', $request->get('cod')]);
            if ($check) {
                $check->fill(['confirmed' => 1])->update();
            }
        }

        $this->content = view(env('THEME') . '.' . $this->page . '.one', compact(['room', 'comments', 'user']))->render();

        return $this->renderOutput();
    }

    private function getCheck($where) {
        return $this->check_rep->one('*', $where);
    }

    private function getUser($id, $r) {
        if ($id) {
            $user = $this->user_rep->one('*', ['id', $id]);

            if ($user->fact->rooms) {
                foreach ($user->fact->rooms as $room) {
                    if ($room->id == $r) {
                        return true;
                    }
                }
            }

            return false;
        }

        return false;
    }

    public function reservation (ReservationRequest $request, $alias) {
        if ($request->isMethod('post')) {
            $search = $request->except('_token');

            $format = 'Y-m-d';
            $search['checkIn'] = $this->dateChange($search['checkIn'], $format);
            $search['checkOut'] = $this->dateChange($search['checkOut'], $format);
            $search['alias'] = $alias;
            $search['cod'] = Str::random(255);

            if ($this->room_rep->checkDate($search)) {
                return back()->with($this->room_rep->checkDate($search));
            }

            $data = $this->room_rep->searchRooms($search);
            $result = $this->room_rep->reservations($data, $search);

            if (!empty($result['error'])) {
                return back()->with($result);
            }

            $this->email($search, $alias);

            return back()->with($result);
        }
    }

    public function search(SearchRequest $request) {
        if ($request->isMethod('post')) {
            $search = $request->except('_token');

            $format = 'Y-m-d';
            $search['checkIn'] = $this->dateChange($search['checkIn'], $format);
            $search['checkOut'] = $this->dateChange($search['checkOut'], $format);
            $this->room_rep->checkDate($search);

            $rooms = $this->room_rep->searchRooms($search);
            $count = $request['room'];

            $this->content = view(env('THEME') . '.' . $this->page . '.search', compact(['rooms', 'count']))->render();

            return $this->renderOutput();
        }

    }


    public function comment(CommentsRequest $request) {
        $data = $request->except('_token');
        $comment = new Comment();
        $comment->fill($data);
        if ($comment->save()) {
            return redirect()->back();
        }
    }

    public function email($search, $alias) {
        if (Auth::check()) {
                Mail::to(Auth::user()->email)->send(new RoomMail($search['cod'], $alias));
            }
        else {
            Mail::to($search['email'])->send(new RoomMail($search['cod'], $alias));
        }
    }
}
