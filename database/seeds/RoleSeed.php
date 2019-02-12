<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Administrator',],
            ['id' => 2, 'title' => 'User',],
            ['id' => 3, 'title' => 'Guest',],

        ];

        foreach ($items as $item) {
            \App\Engine\Models\Role::create($item);
        }
    }
}
