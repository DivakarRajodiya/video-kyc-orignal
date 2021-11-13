<?php

namespace App\DataTables;

use App\Models\User;

/**
 * Class AgentDataTable
 */
class AgentDataTable
{
    public function get()
    {
        $query = User::where('is_master', 0)->where('user_type', User::USER_TYPE_AGENT)->get();

        return $query;
    }
}
