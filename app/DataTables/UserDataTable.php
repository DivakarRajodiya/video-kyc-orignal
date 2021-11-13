<?php

namespace App\DataTables;

use App\Models\User;

/**
 * Class UserDataTable
 */
class UserDataTable
{
    public function get()
    {
        $query = User::where('user_type', User::USER_TYPE_USER)->get();

        return $query;
    }
}
