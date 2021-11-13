<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class AgentRepository
 * @package App\Repositories
 * @version November 7, 2021, 8:08 am UTC
*/

class AgentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'tenant'
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
        return User::class;
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

            /** @var User $user */
            $user = User::create([
                'first_name'  => $input['first_name'],
                'last_name'   => $input['last_name'],
                'username'   => $input['username'],
                'email'       => $input['email'],
                'tenant'       => $input['tenant'],
                'user_type'       => User::USER_TYPE_AGENT,
                'password'    => Hash::make($input['password']),
            ]);
            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param array $input
     *
     * @param int $id
     *
     * @return User|Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        try {
            DB::beginTransaction();

            /** @var User $user */
            $user = User::find($id);
            $input['password'] = isset($input['password']) && $input['password'] ? Hash::make($input['password']) : $user->password;
            $user->update($input);

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
