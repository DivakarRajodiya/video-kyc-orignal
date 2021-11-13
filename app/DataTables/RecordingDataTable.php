<?php

namespace App\DataTables;

use App\Models\Recording;

/**
 * Class RecordingDataTable
 */
class RecordingDataTable
{
    public function get()
    {
        $query = Recording::query()->orderByDesc('created_at');

        return $query;
    }
}
