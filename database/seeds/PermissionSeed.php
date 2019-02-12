<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            // menus
            ['id' => 1, 'title' => 'user_management_access',],
            // sub-menus user_management_access
            ['id' => 2, 'title' => 'permission_access',],
            ['id' => 3, 'title' => 'permission_create',],
            ['id' => 4, 'title' => 'permission_edit',],
            ['id' => 5, 'title' => 'permission_view',],
            ['id' => 6, 'title' => 'permission_delete',],
            ['id' => 7, 'title' => 'role_access',],
            ['id' => 8, 'title' => 'role_create',],
            ['id' => 9, 'title' => 'role_edit',],
            ['id' => 10, 'title' => 'role_view',],
            ['id' => 11, 'title' => 'role_delete',],
            ['id' => 12, 'title' => 'user_access',],
            ['id' => 13, 'title' => 'user_create',],
            ['id' => 14, 'title' => 'user_edit',],
            ['id' => 15, 'title' => 'user_view',],
            ['id' => 16, 'title' => 'user_delete',],
            
            
            ['id' => 100, 'title' => 'application_access',],
            // sub-menus application_access
            ['id' => 101, 'title' => 'post_access',],
            ['id' => 102, 'title' => 'post_create',],
            ['id' => 103, 'title' => 'post_edit',],
            ['id' => 104, 'title' => 'post_view',],
            ['id' => 105, 'title' => 'post_delete',],
            ['id' => 106, 'title' => 'category_access',],
            ['id' => 107, 'title' => 'category_create',],
            ['id' => 108, 'title' => 'category_edit',],
            ['id' => 109, 'title' => 'category_view',],
            ['id' => 110, 'title' => 'category_delete',],
            ['id' => 111, 'title' => 'tag_access',],
            ['id' => 112, 'title' => 'tag_create',],
            ['id' => 113, 'title' => 'tag_edit',],
            ['id' => 114, 'title' => 'tag_view',],
            ['id' => 115, 'title' => 'tag_delete',],
            ['id' => 116, 'title' => 'article_access',],
            ['id' => 117, 'title' => 'article_create',],
            ['id' => 118, 'title' => 'article_edit',],
            ['id' => 119, 'title' => 'article_view',],
            ['id' => 120, 'title' => 'article_delete',],
            ['id' => 121, 'title' => 'page_access',],
            ['id' => 122, 'title' => 'page_create',],
            ['id' => 123, 'title' => 'page_edit',],
            ['id' => 124, 'title' => 'page_view',],
            ['id' => 125, 'title' => 'page_delete',],
        ];

        foreach ($items as $item) {
            \App\Engine\Models\Permission::create($item);
        }
    }
}
