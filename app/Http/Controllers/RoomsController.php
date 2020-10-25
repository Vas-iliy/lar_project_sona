<?php

namespace App\Http\Controllers;

use App\Check;
use App\Comment;
use App\Fact;
use App\Http\Requests\CommentsRequest;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\SearchRequest;
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
use App\Room;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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

        $content = view(env('THEME') . '.' . $this->page . '.content', compact(['rooms', 'alias']))->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        return $this->renderOutput();
    }

    /**
     * Display the specified resource.
     *
     * @param $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function show($alias)
    {
        $room = $this->room_rep->one('*', ['alias', $alias]);
        $comments = $this->getComment(false, ['room_id', $room->id]);
        $user = $this->getUser(Auth::id(), $room->id);

        $content = view(env('THEME') . '.' . $this->page . '.one', compact(['room', 'comments', 'user']))->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        return $this->renderOutput();
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

            $id = $this->getOneRoom(['alias', $alias])->id;

            $data = $this->searchRooms($search);

            if ($data) {
                $atrCheck = ['check_in' => $search['checkIn'], 'check_out' => $search['checkOut'], 'room_id' => $id, 'count_id' => $search['room']];
                $this->checkInsert($atrCheck);
                if (!Auth::check()) {
                    $atrFact = ['name' => $search['name'], 'email' => $search['email'], 'phone' => $search['phone']];
                    $this->factInsert($atrFact);
                    $atrFact_room = ['room_id' => $id, 'fact_id' => Fact::max('id')];
                    $this->fact_roomInsert('fact_room', $atrFact_room);
                }
                else {
                    $atrFact_room = ['room_id' => $id, 'fact_id' => Auth::user()->fact->id];
                    $this->fact_roomInsert('fact_room', $atrFact_room);
                }

                return redirect('/')->with('status', 'Вы зарезервировали комнату');
            }
            else {
                return redirect()->back()->with('status', 'На эту дату такой комнаты нет, выбирите другую');
            }
        }
    }

    private function getOneRoom($where) {
        return $this->room_rep->one('id', $where);
    }

    private function checkInsert($atr) {
        return $this->check_rep->insert($atr);
    }
    private function factInsert($atr) {
        return $this->fact_rep->insert($atr);
    }
    private function fact_roomInsert($table, $atr) {
        return $this->db_rep->db($table, $atr);
    }

    public function search(SearchRequest $request) {
        if ($request->isMethod('post')) {
            $search = $request->except('_token');

            $format = 'Y-m-d';
            $search['checkIn'] = $this->dateChange($search['checkIn'], $format);
            $search['checkOut'] = $this->dateChange($search['checkOut'], $format);

            $rooms = $this->searchRooms($search);
            $count = $request['room'];

            $content = view(env('THEME') . '.' . $this->page . '.search', compact(['rooms', 'count']))->render();
            $this->vars = Arr::add($this->vars, 'content', $content);

            return $this->renderOutput();
        }

    }

    private function searchRooms($request) {
        if (!isset($request['title'])) {
            $rooms = $this->getRoom(false, false, false, ['capacity', '>', $request['guest']-1]);
        }
        else {
            $rooms = $this->getRoom(false, false, false, ['title', $request['title']]);
        }
        $search = [];
        $k = 0;
        foreach ($rooms as $room) {
            foreach ($room->counts as $i => $count) {
                if ($count->count == $request['room']) {
                    for ($n = $i + 1; $n < count($room->counts); $n++) {
                        $room->counts->forget($n);
                    }

                    $search = Arr::add($search, $k, $room);
                    $k++;
                }
                else {
                    $room->counts->forget($i);
                }
            }
        }
        $result = [];
        foreach ($search as $k => $room) {
            if ($room->checks->toArray()) {
                foreach ($room->checks as $check) {
                    if (strtotime($check->check_out) > strtotime($request['checkIn']) &&
                        strtotime($check->check_in) < strtotime($request['checkOut']) &&
                        $check->count_id == $request['room']) {
                            $result[] = $k;
                    }
                }
            }
        }
        foreach ($result as $delete) {
            unset($search[$delete]);
        }

        return $search;
    }

    public function comment(CommentsRequest $request) {
        $data = $request->except('_token');
        $comment = new Comment();
        $comment->fill($data);
        if ($comment->save()) {
            return redirect()->back();
        }
    }
}
