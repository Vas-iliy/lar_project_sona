<?php


namespace App\Repositories;

use App\Contact;
use App\Fact;
use App\Room;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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

            return ['status' => 'Вы зарезервировали эту комнату'];
        }
        else {
            return ['status' => 'На эту дату такой комнаты нет, выбирите другую'];
        }
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
