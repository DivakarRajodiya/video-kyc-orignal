<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Visitor;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class VisitorRepository
 * @package App\Repositories
 * @version November 7, 2021, 8:08 am UTC
 */

class VisitorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
      'id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Visitor::class;
    }
}
