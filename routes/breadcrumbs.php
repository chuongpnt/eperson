<?php

use App\Engine\Models\Post;
use App\Http\Resources\Post as PostResource;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('app.menus.home'), route('front.home'));
});

// Home > Service
Breadcrumbs::for('front.service', function ($trail) {
    $trail->parent('home');
    $trail->push(__('app.menus.service'), route('front.service'));
});

// Home > Service > Post
Breadcrumbs::for('front.service.detail', function ($trail, $slug) {
	$resource = new PostResource(Post::where('slug', $slug)->first());
    $trail->parent('front.service');
    $trail->push($resource->getBreadcrumbText(), route('front.service.detail', $resource->getBreadcrumbRoute()));
});

// Home > Our Strengths
Breadcrumbs::for('front.our_strengths', function ($trail) {
    $trail->parent('home');
    $trail->push(__('app.menus.our_strengths'), route('front.our_strengths'));
});

// Home > Support
Breadcrumbs::for('front.support', function ($trail) {
    $trail->parent('home');
    $trail->push(__('app.menus.support'), route('front.support'));
});

// Home > About us
Breadcrumbs::for('front.about_us', function ($trail) {
    $trail->parent('home');
    $trail->push(__('app.menus.about_us'), route('front.about_us'));
});

// Home > Company
Breadcrumbs::for('front.company_information', function ($trail) {
    $trail->parent('home');
    $trail->push(__('app.menus.company_information'), route('front.company_information'));
});

// Home > Blog
Breadcrumbs::for('front.blog', function ($trail) {
    $trail->parent('home');
    $trail->push(__('app.menus.blog'), route('front.blog'));
});

// Home > Blog > Post
Breadcrumbs::for('front.blog.detail', function ($trail, $slug) {
	$resource = new PostResource(Post::where('slug', $slug)->first());
    $trail->parent('front.blog');
    $trail->push($resource->getBreadcrumbText(), route('front.blog.detail', $resource->getBreadcrumbRoute()));
});

// Home > Contact us
Breadcrumbs::for('front.contact_us', function ($trail) {
    $trail->parent('home');
    $trail->push(__('app.menus.contact_us'), route('front.contact_us'));
});

Breadcrumbs::for('front.search', function ($trail) {
    $trail->parent('home');
    $trail->push(__('app.menus.search'), route('front.search'));
});