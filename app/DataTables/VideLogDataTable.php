<?php

namespace App\DataTables;

use App\Models\VideoLog;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class VideLogDataTable
 */
class VideLogDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        $query = VideoLog::query()->orderByDesc('created_at');

        return $query;
    }
}
