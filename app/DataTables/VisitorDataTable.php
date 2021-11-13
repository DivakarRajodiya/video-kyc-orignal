<?php

namespace App\DataTables;

use App\Models\Visitor;

/**
 * Class VisitorDataTable
 */
class VisitorDataTable
{
    public function get()
    {
        $query = Visitor::query();

        return $query;
    }
}
