<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user           = new User;
        $user->email    = env('DB_EMAIL');
        $user->password = bcrypt(env('DB_PW'));
        $user->admin    = true;
        $user->save();
    }
}
