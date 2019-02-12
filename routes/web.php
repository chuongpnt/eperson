<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Admin routes...
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
	// app()->setLocale('en');
    Route::get('/', 'AdminController@index');
    Route::get('/{any}', 'AdminController@index')->where('any', '.*');
});

// Frontend routes...
Route::group(['as' => 'front.', 'namespace' => 'Front'], function() {


    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/services', 'ServiceController@index')->name('service');
    Route::get('/services/{slug}', 'ServiceController@detail')->name('service.detail');
    Route::get('/strengths-of-us', 'OurStrengthsController@index')->name('our_strengths');
    Route::get('/company-information', 'CompanyController@index')->name('company_information');
    Route::get('/contact_us', 'ContactUsController@index')->name('contact_us');

    //Route::get('/support', 'SupportController@index')->name('support');
    //Route::get('/about-us', 'AboutUsController@index')->name('about_us');


    Route::get('/blog', 'BlogController@index')->name('blog');
    Route::get('/blog/{slug}', 'BlogController@detail')->name('blog.detail');

    Route::post('/search', 'SearchController@index')->name('search');
    Route::get('/search', 'SearchController@index')->name('search');
});

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');
// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');
// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');
// Elfinder Routes
Route::get('glide/{path}', function($path){
	$server = \League\Glide\ServerFactory::create([
		'source' => app('filesystem')->disk('public')->getDriver(),
		'cache' => storage_path('glide'),
	]);
	return $server->getImageResponse($path, Input::query());
})->where('path', '.+');

$this->post('subscribe_register', 'Front\SubscribeController@register')->name('front.subscribe');
$this->post('contactus_register', 'Front\ContactUsController@register')->name('front.contactus');