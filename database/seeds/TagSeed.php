<?php

use Illuminate\Database\Seeder;

class TagSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Blog', 'recommend' => 1, 'hot' => 0, 'new' => 1,],
            ['id' => 2, 'name' => 'Doremon', 'recommend' => 1, 'hot' => 0, 'new' => 1,],

        ];

        foreach ($items as $item) {
            \App\Engine\Models\Tag::create($item);
        }
    }
}
