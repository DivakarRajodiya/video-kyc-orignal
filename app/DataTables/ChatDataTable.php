<?php

namespace App\DataTables;

use App\Models\Chat;

/**
 * Class ChatDataTable
 */
class ChatDataTable
{
    /**
     * @return mixed
     */
    public function get()
    {
        $roomIdArray = Chat::all()->pluck('room_id')->toArray();
        $uniqueRoomId = array_unique($roomIdArray);
        $query = Chat::whereIn('room_id', $uniqueRoomId)->orderByDesc('date_created')->get();

        return $query;
    }
}
