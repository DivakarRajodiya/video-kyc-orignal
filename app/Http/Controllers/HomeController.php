<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class HomeController extends AppBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $agent = User::where('user_type', User::USER_TYPE_AGENT)->count();
        $user = User::where('user_type', User::USER_TYPE_USER)->count();
        $room = Room::all()->count();

        return view('home', compact('agent', 'user', 'room'));
    }

    /**
     * @param User $user
     *
     * @param Request $request
     *
     * @return User
     *
     * @throws ValidationException
     */
    public function updateProfile(User $user, Request $request)
    {
        $input = $request->all();
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'tenant'      => ['required', 'string', 'max:255'],
        ])->validate();

        try {
            DB::beginTransaction();

            $input['password'] = isset($input['password']) && $input['password'] ? Hash::make($input['password']) : $user->password;
            $user->update($input);

            DB::commit();

            return $this->sendResponse($user, 'Profile update successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
