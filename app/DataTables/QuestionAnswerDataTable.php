<?php

namespace App\DataTables;

use App\Models\QuestionAnswer;

/**
 * Class QuestionAnswerDataTable
 */
class QuestionAnswerDataTable
{
    public function get()
    {
        $query = QuestionAnswer::query()->orderByDesc('id');

        return $query;
    }
}
