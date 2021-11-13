<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'  => 'Super',
            'last_name'   => 'Admin',
            'username'   => 'admin',
            'email'       => 'admin@admin.com',
            'tenant'       => 'lsv_mastertenant',
            'user_type'       => User::USER_TYPE_AGENT,
            'email_verified_at'       => Carbon::now(),
            'password'    => Hash::make(123456),
        ]);
    }
}
