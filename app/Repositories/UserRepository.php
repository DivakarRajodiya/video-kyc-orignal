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
 * Class UserRepository
 * @package App\Repositories
 * @version November 7, 2021, 8:08 am UTC
 */

class UserRepository extends BaseRepository
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

            $input['is_blocked'] = isset($input['is_blocked']) && $input['is_blocked'] ? true : false;

            /** @var User $user */
            $user = User::create([
                'first_name'  => $input['first_name'],
                'last_name'   => $input['last_name'],
                'email'       => $input['email'],
                'password'    => Hash::make($input['password']),
                'user_type'       => User::USER_TYPE_USER,
                'is_blocked' => $input['is_blocked'],
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
            $input['is_blocked'] = isset($input['is_blocked']) && $input['is_blocked'] ? true : false;
            $user->update($input);

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
