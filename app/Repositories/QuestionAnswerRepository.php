<?php

namespace App\Repositories;

use App\Models\QuestionAnswer;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class QuestionAnswerRepository
 * @package App\Repositories
 * @version November 7, 2021, 8:08 am UTC
 */

class QuestionAnswerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'question',
        'status',
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
        return QuestionAnswer::class;
    }

    /**
     * @param array $input
     *
     * @return User|Model
     */
    public function create($input)
    {
        try {
            DB::beginTransaction();

            /** @var QuestionAnswer $questionAnswer */
            $questionAnswer = QuestionAnswer::create($input);
            DB::commit();

            return $questionAnswer;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param array $questionAnswer
     *
     * @param int $input
     *
     * @return array|Builder|Builder[]|Collection|Model
     */
    public function update($questionAnswer, $input)
    {
        try {
            DB::beginTransaction();

            $questionAnswer->update($input);

            DB::commit();

            return $questionAnswer;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
