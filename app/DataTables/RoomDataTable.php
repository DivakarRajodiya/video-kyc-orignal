<?php

namespace App\DataTables;

use App\Models\Room;

/**
 * Class RoomDataTable
 */
class RoomDataTable
{
    public function get()
    {
        $query = Room::query();

        return $query;
    }
}
