<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     *
     * @return User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'username'  => ['nullable', 'string', 'max:255', 'unique:users'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'tenant'      => ['required', 'string', 'max:255'],
            'password'   => $this->passwordRules(),
        ])->validate();

        try {
            DB::beginTransaction();

            /** @var User $user */
            $user = User::create([
                'first_name'  => $input['first_name'],
                'last_name'   => $input['last_name'],
                'username'   => $input['username'],
                'email'       => $input['email'],
                'tenant'       => $input['tenant'],
                'user_type'  => User::USER_TYPE_AGENT,
                'password'    => Hash::make($input['password']),
            ]);
            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
