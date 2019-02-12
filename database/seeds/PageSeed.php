<?php

use Illuminate\Database\Seeder;

class PageSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'code' => 'home', 'name' => __('app.menus.home', [], 'vi'), 'name_jp' => __('app.menus.home', [], 'ja'),],
            ['id' => 2, 'code' => 'services', 'name' => __('app.menus.service', [], 'vi'), 'name_jp' => __('app.menus.service', [], 'ja'),],
            ['id' => 3, 'code' => 'strength-of-us', 'name' => __('app.menus.our_strengths', [], 'vi'), 'name_jp' => __('app.menus.our_strengths', [], 'ja'),],
            ['id' => 4, 'code' => 'about-us', 'name' => __('app.menus.company_information', [], 'vi'), 'name_jp' => __('app.menus.company_information', [], 'ja'),],
            ['id' => 5, 'code' => 'contact-us', 'name' => __('app.menus.contact_us', [], 'vi'), 'name_jp' => __('app.menus.contact_us', [], 'ja'),],
            ['id' => 6, 'code' => 'search', 'name' => __('app.menus.search', [], 'vi'), 'name_jp' => __('app.menus.search', [], 'ja'),],

        ];

        foreach ($items as $item) {
            \App\Engine\Models\Page::create($item);
        }
    }
}
