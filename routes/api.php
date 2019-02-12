<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '/v1', 'middleware' => ['auth:api'], 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
    Route::post('change-password', 'ChangePasswordController@changePassword')->name('auth.change_password');
    Route::apiResource('rules', 'RulesController', ['only' => ['index']]);
    Route::apiResource('permissions', 'PermissionsController');
    Route::apiResource('roles', 'RolesController');
    Route::apiResource('users', 'UsersController');
    Route::apiResource('posts', 'PostsController');
    Route::apiResource('categories', 'CategoriesController');
    Route::apiResource('tags', 'TagsController');
    Route::apiResource('articles', 'ArticlesController');
    Route::apiResource('pages', 'PagesController');
    Route::apiResource('contactsus', 'ContactsUsController');
    Route::apiResource('registers', 'RegistersController');
	Route::get('user-actions', 'UserActionsController@index')->name('user-actions.index');
});
