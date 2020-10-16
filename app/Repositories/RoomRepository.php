<?php


namespace App\Repositories;

use App\Contact;
use App\Room;

class RoomRepository extends Repository
{
    public function __construct(Room $room)
    {
        $this->model = $room;
    }
}
