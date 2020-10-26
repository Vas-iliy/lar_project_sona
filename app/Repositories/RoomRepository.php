<?php


namespace App\Repositories;

use App\Contact;
use App\Fact;
use App\Room;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Str;

class RoomRepository extends Repository
{
    protected $check_rep;
    protected $fact_rep;
    protected $db_rep;

    public function __construct(Room $room, CheckRepository $check_rep, FactRepository $fact_rep, DbRepository $db_rep)
    {
        $this->model = $room;

        $this->check_rep = $check_rep;
        $this->fact_rep = $fact_rep;
        $this->db_rep = $db_rep;
    }

    public function searchRooms($request) {
        if (!isset($request['alias'])) {
            $rooms = $this->model->select('*')->where('capacity', '>', $request['guest']-1)->get();
        }
        else {
            $rooms = $this->model->select('*')->where('alias', $request['alias'])->get();
        }
        $rooms->load('checks');
        $rooms->load('counts');
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

    public function reservations($data, $search) {
        if ($data) {
            $id = $this->model->select('id')->where('alias', $search['alias'])->first()->id;
            if (!Auth::check()) {
                $atrFact = ['name' => $search['name'], 'email' => $search['email'], 'phone' => $search['phone']];
                $fact = $this->getFact(['email', $atrFact['email']]);
                if (!$fact) {
                    $this->factInsert($atrFact);
                    $atrFact_room = ['room_id' => $id, 'fact_id' => Fact::max('id')];
                    $atrCheck = ['check_in' => $search['checkIn'], 'check_out' => $search['checkOut'], 'room_id' => $id,
                        'count_id' => $search['room'], 'fact_id' => Fact::max('id'), 'cod' => $search['cod']];
                }
                else {
                    $fact->fill($atrFact)->update();
                    $atrFact_room = ['room_id' => $id, 'fact_id' => $fact->id];
                    $atrCheck = ['check_in' => $search['checkIn'], 'check_out' => $search['checkOut'], 'room_id' => $id,
                        'count_id' => $search['room'], 'fact_id' => $fact->id, 'cod' => $search['cod']];
                }

                $this->fact_roomInsert('fact_room', $atrFact_room);

            }
            else {
                $atrFact_room = ['room_id' => $id, 'fact_id' => Auth::user()->fact->id];
                $this->fact_roomInsert('fact_room', $atrFact_room);
                $atrCheck = ['check_in' => $search['checkIn'], 'check_out' => $search['checkOut'], 'room_id' => $id,
                    'count_id' => $search['room'], 'fact_id' => Auth::user()->fact->id, 'cod' => $search['cod']];
            }

            $this->checkInsert($atrCheck);

            return ['status' => 'Вы зарезервировали эту комнату'];
        }
        else {
            return ['error' => 'На эту дату такой комнаты нет, выбирите другую'];
        }
    }

    public function checkDate($search) {
        if (Auth::check()) {
            $guest = Auth::user()->fact;
        }
        else {
            $guest = $this->getFact(['email', $search['email']]);
        }
        if ($guest) {
            foreach ($guest->checks as $check) {
                if ($check->check_in <= $search['checkIn'] && $check->check_out > $search['checkIn'] && $check->confirmed == 0) {
                    return ['error' => 'Вы уже зарезервировали комнату на эти даты. Перейдите на почту и подтвердите заезд'];
                }
                elseif ($check->check_in <= $search['checkIn'] && $check->check_out > $search['checkIn'] && $check->confirmed == 1) {
                    return ['error' => 'Вы уже зарезервировали комнату на эти даты'];
                }
            }
        }

        return false;
    }

    private function getFact($where) {
        return $this->fact_rep->one('*',$where);
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


}
