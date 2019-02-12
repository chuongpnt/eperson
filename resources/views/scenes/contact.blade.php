@extends('layouts.base')

@section('page_title', $page->title)
@section('page_description', $page->description)
@section('page_keywords', $page->keywords)

@section('background')
<div class="background-img pt-5 pb-5 mb-5">
	<img class="img-fluid" src="https://builder.io/api/v1/image/assets%2F6HTjMKgUPJhJsuujpcoEtfI7I4k1%2Fb4b76fe9332a42b6bda80577a071cf76?width=1500&height=1500&quality=85"></img>
</div>
@stop

@section('javascript_extra')
<script type="text/javascript" charset="utf-8">
    
	function myMap() {
		function toggleBounce() {
			if (marker.getAnimation() !== null) {
				marker.setAnimation(null);
			} else {
				marker.setAnimation(google.maps.Animation.BOUNCE);
			}
		}
		
		var icon = '/img/pin.png';
        var mapProp= {
            center:new google.maps.LatLng({{ env('GG_LAT') }},{{ env('GG_LNG') }}),
            zoom:{{ env('GG_ZOOM') }},
        };
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
		
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng({{ env('GG_LAT') }},{{ env('GG_LNG') }}),
			animation: google.maps.Animation.DROP,
			map: map,
			icon: icon,
			title: 'E-Person'
		  });
		marker.addListener('click', toggleBounce);
    }
</script>
@stop
@section('javascript')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GG_KEY') }}&language={{ App::getLocale() }}&region={{ App::getLocale() }}&callback=myMap"></script>
@stop

@section('content')
<section class="main-page">
	<div class="container">
		<div class="row">
			{!! $page->content !!}
			
			<div id="googleMap" style="width:100%;height:400px;margin-bottom: 2rem;"></div>
		
			<div class="col-12 d-none d-md-block">
				<div class="row justify-content-center">
					<div class="col text-center contact-infos">
						<div class="d-flex justify-content-center mb-3">
							<a href="javascript:void(0);" class="input-group-text icon-circle-contact mobile"><i class="fa fa-mobile-phone fa-2x fa-secondary"></i></a>
						</div>
						<h5 class="">@lang('app.tel_title')</h5>
						<p class="m-0 p-0">@lang('app.tel_num')</p>
						<p class="m-0 p-0">@lang('app.fax_num')</p>
					</div>

					<div class="col text-center contact-infos">
						<div class="d-flex justify-content-center mb-3">
							<a href="javascript:void(0);" class="input-group-text icon-circle-contact marker"><i class="fa fa-map-marker fa-2x fa-secondary"></i></a>
						</div>
						<h5 class="">@lang('app.address_title')</h5>
						<p class="m-0 p-0">@lang('app.address_detail')</p>
					</div>
					
					<div class="col text-center contact-infos">
						<div class="d-flex justify-content-center mb-3">
							<a href="javascript:void(0);" class="input-group-text icon-circle-contact"><i class="fa fa-envelope-o fa-2x fa-secondary"></i></a>
						</div>
						<h5 class="">@lang('app.time_working_title')</h5>
						<p class="m-0 p-0">@lang('app.time_working_time')</p>
						<p class="m-0 p-0">(@lang('app.time_working_close'))</p>
					</div>
				</div>
			</div>
		</div>
</section>
	
{{--<div class="w100">
		<div class="col-12">
			<div class="d-block mb-5">
				<div class="col-12 col-xl-12 text-center text-uppercase">
					<h2 class="title_bottom center">TRƯỚC KHI LIÊN HỆ VỚI CHÚNG TÔI</h2>
				</div>
				
				<div class="row justify-content-center">
					<div class="col-xs-12 col-md-8 text-center">
						<p>Càng nhiều càng tốt,vui lòng ghi rõ nội cung của cuộc điều tra càng nhiều càng tốt</p>
						<p>Tùy thuộc vào nội dung , có thể mất thời gian để trả lời hoặc trả lời. Hơn nữa chúng tôi có thể  không phản hồi chị định việc trả lời hoặc yêu cầu khẩn cấp ,nhưng hãy hiểu</p>
						<p>Thông tin cá nhân được cugn cấp bởi khách hàng sẽ không được sử dụng cho các mục đích khác ngoài việc chuẩn bị câu trả lời . Ngoài ra loại trừ theo quy định của pháp luật và các quy định , chúng tôi sẽ không tiết lộ cho bên thứ ba mà không có sự đồng ý của bạn </p>
					</div>
				</div>
			</div>

		</div>
	</div>--}}

@stop