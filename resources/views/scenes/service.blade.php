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
			<div class="">
				{!! $page->content !!}
			</div>
		</div>
		<div class="container">
			<div class="">
			@foreach ($posts as $post)
				<div class="w-100 d-block mb-5">
					<div class="border_title_bottom">
						<h2 class="text-uppercase"><a href="{!! route('front.service.detail', ['slug' => $post->slug]) !!}" title="{{ $post->title }}">{{ $post->title }}</a></h2>
					</div>
					<p class="card-description-detail">{!! $post->content !!}</p>
				</div>
			@endforeach
			</div>
		</div>
	</section>

	{{--<div class="w100">
		<div class="col-12">
			<div class="d-block mb-5">
				<div class="border_title_bottom">
						<h2 class="text-uppercase">DỊCH VỤ CỦA CHÚNG TÔI</h2>
				</div>
				<p class="card-description-detail">Cơ quan điều phối địa phương và các tổ chức giám sát được chấp nhận của Nhật Bản
				có hình thức hoạt động và chất lượng của họ không đồng đều</p>
			</div>
			<div class="d-block mb-5">
				<div class="border_title_bottom">
						<h2 class="text-uppercase">DÀNH CHO CÔNG VIỆC</h2>
				</div>
				<p class="card-description-detail"> Trước khi rời Nhật Bản , chúng tôi đang tư vấn cho tổ chức công văn về trình độ thông thạo
				về trình độ tiếng nhật "N4"& giáo dục cho ngành công nghiệp sản xuất Nhật Bản </p>
			</div>
		</div>
	</div>--}}

@stop