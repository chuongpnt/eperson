@extends('layouts.base')

@section('page_title', $post->title)
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
			<div class="">
				<div class="article-detail">
					<div class="d-block item-title hr">
						<h1>{{ $post->title }}</h1>
					</div>
					<div class="d-block item-detail">{!! $post->content !!}</div>
				</div>
			</div>
		</div>
	</section>
@stop