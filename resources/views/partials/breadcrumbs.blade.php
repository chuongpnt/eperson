@php
$breadcrumbs = Breadcrumbs::generate()
@endphp

@if (count($breadcrumbs))
	<div class="breadcrumb-wrapper">
		<ol class="breadcrumb justify-content-center text-capitalize">
			@foreach ($breadcrumbs as $breadcrumb)
				@if ($breadcrumb->url && $loop->first)
					<li class="breadcrumb-item"><i class="fa far fa-home"></i></i> <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
				@elseif ($breadcrumb->url && !$loop->last)
					<li class="breadcrumb-item"><i class="fa far fa-angle-double-right"></i> <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
				@else
					<li class="breadcrumb-item active"><i class="fa fa-angle-double-right"></i> {{ $breadcrumb->title }}</li>
				@endif

			@endforeach
		</ol>
	</div>
@endif