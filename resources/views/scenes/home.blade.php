<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    @include('partials.head')
</head>


<body class="hold-transition skin-blue sidebar-mini">
<div id="wrapper" class="home-pg">
@include('partials.topbar')
	<div class="homebackground">
		<div class="centered">
			<div class="row no-gutters justify-content-center">
				<div class="col-md-12">
					<div class="slider-home-bg">
						<div class="slider-home-data">
							<h1>@lang('app.silder_title')</h1>
							<p>@lang('app.silder_des')</p>
						
							<div>
								<button type="button" class="btn btn-cus-primary angle-right">@lang('app.register_now')</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@if(!empty($posts))
	@foreach ($posts as $k => $post)
		@if ($k % 2 == 0)
		<!-- start service -->
			<div class="w100 parallel-services">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="row justify-content-start">
								<div class="card border-none">
                                @if ($post->media[0])
									<img class="img-fluid" src='{{ asset("storage/".$post->media[0]->id."/".$post->media[0]->file_name) }}' title="{{ $post->title }}" alt="{{ $post->title }}">
                                @else
                                <img class="img-fluid" src='' title="{{ $post->title }}" alt="{{ $post->title }}">
                                @endif
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="row">
								<div class="col-xs-12 col-md-12 col-xl-12">
									<div class="row justify-content-start">
										<div class="card border-none">
											<div class="card-body">
												<h2 class="card-title text-uppercase text-bold">{{ $post->title }}</h2>

												<div class="card-text card-description">{!! $post->content !!}</div>
												<button type="button" class="btn btn-cus-secondary text-capitalize"><a href="{!! route('front.service.detail', ['slug' => $post->slug]) !!}" title="{{ $post->title }}">@lang('app.discovery')</a></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end service -->
		@else
		<!-- start strength -->
			<div class="w100 parallel-strengths">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="row justify-content-end">
								<div class="col-xs-12 col-md-12 col-xl-12">
									<div class="row justify-content-end">
										<div class="card border-none text-right">
											<div class="card-body text-left-sm">
												<h2 class="card-title text-uppercase text-bold">{{ $post->title }}</h2>
												<div class="card-text card-description">{!! $post->content !!}</div>
												<button type="button" class="btn btn-cus-secondary text-capitalize">@lang('app.discovery')</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="row">
								<div class="card border-none">
									@if ($post->media[0])
									<img class="img-fluid" src='{{ asset("storage/".$post->media[0]->id."/".$post->media[0]->file_name) }}' title="{{ $post->title }}" alt="{{ $post->title }}">
                                @else
                                <img class="img-fluid" src='' title="{{ $post->title }}" alt="{{ $post->title }}">
                                @endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end strength -->
		@endif
	@endforeach
	@endif




	


	<div class="w100 parallel-news">
		<div class="container">
			<div class="row">
				<img class="img-fluid" src="{{ URL::asset('img/homepage_3.jpg') }}" alt="Card image cap">
			</div>
		</div>
	</div>
	
	@include('partials.footer')
	
</div>

@include('partials.javascripts')
</body>
</html>