<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            //111111
            ['id' => 1, 'name' => 'Admin', 'email' => 'chuongpnt@gmail.com', 'password' => '$2y$10$9RmXkwv0D7V9geJLxrA.puqPm03VUbUI7RqCUeeGdWoFyLWiLWige', 'remember_token' => 'HjoXcD8YEnPwdFmUbqUMhByZj5mrTLyV5ffTVsfpN3sGkMLh7skYv8bAKrfE',],

        ];

        foreach ($items as $item) {
            \App\Engine\Models\User::create($item);
        }
    }
}
