@extends('layouts.base')

@section('page_title', $page->title)
@section('page_description', $page->description)
@section('page_keywords', $page->keywords)

@section('background')
<div class="background-img pt-5 pb-5 mb-5">
	<img class="img-fluid" src="https://builder.io/api/v1/image/assets%2F6HTjMKgUPJhJsuujpcoEtfI7I4k1%2Fb4b76fe9332a42b6bda80577a071cf76?width=1500&height=1500&quality=85"></img>
</div>
@stop

@section('content')
	<section class="main-page">
		<div class="container">
			<div class="row">
			@foreach ($posts as $post)
				<div class="article-block w-100">
					<div class="row">
						<div class="col-2">
							<div class="row align-items-center h-100">
								<div class="mx-auto"><span class="d-block cal-vertical cal-day">{{ $post->created_at->format('d') }}</span>
								<span class="d-block cal-vertical cal-month">{{ $post->created_at->format('F') }}</span></div>
							</div>
						</div>
						<div class="col-3">
							<img class="img-fluid" title="" alt="" src="{{ URL::asset('img/demo/IMG_0_blog.png') }}"></img>
						</div>
						<div class="col-7">
							<div class="article-detail">
								<div class="d-block item-title">
									<h5><a class="" href="{!! route('front.blog.detail', ['slug' => $post->slug]) !!}">{{ $post->title }}</a></h5>
								</div>
								<div class="d-block item-summary">{{ $post->summary }}</div>
								<div class="d-block item-more-info last-item">
									<span class="related"><i class="fa fa-user-o disabled"></i>{{ $post->user->name }}</span>
									<span class="related"><i class="fa fa-bookmark-o disabled"></i>{{ $post->category->title }}</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endforeach
			</div>
		</div>
	</section>
@stop