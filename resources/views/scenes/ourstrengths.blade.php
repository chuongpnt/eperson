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
	</section>
	
	{{--<div class="w100">
		<div class="w-100 d-block">
			<p>Chúng tôi hổ trợ một loạt các tình hướng trong quá trình chuẩn bị chấp nhận cho thực tập sinh.</p>
		</div>
		<div class="w-100 d-block">
			<ul class="text-bold">
				<li>Chuẩn bị hổ trợ cho vay công ty nhà ở.</li>
				<li>Hổ trợ phong cách sống</li>
				<li>Giải trí, ký nghĩ, v.v...</li>
				<li>Phản ứng khẩn cấp</li>
				<li>Giải thích / hổ trợ dịch thuật theo yêu cầu của khách hàng</li>
			</ul>
		</div>
		<div class="w-100 d-block mb-5">Chúng tôi đang nổ lực đê giảm đáng kể mối quan tâm của khách hàng, chẳng hạn như các biện pháp phòng ngừa chống lại sự biến mất ở mức cao, chuẩn bị để ứng phó với biến động sản xuất.</div>
		<h5>Ví dụ về các biện pháp để ngăn chặn sự biến mất</h5>
		<div class="w-100 d-block">
			<p>Yếu tố mà thường học nghề để biến mất được coi là bốn người "xâm nhập của mục đích biến mất", "số lượng lớn các khoản nợ", "đối xử bất công trong doanh nghiệp", "không muốn trở về nhà".</p>
			<p>Tại e-person, các biện pháp được điều chỉnh theo từng yếu tố này để ngăn chặn rũi ro.</p>
			<p>Chúng tôi đã liên kết với nhóm quan sát cấp trên, chúng tôi có thể cung cấp thông tin mới nhất từ các chuyên gia liên quan đến pháp lý và có thể thông báo cho bạn về phán quyết chính xác.</p>
		</div>
	</div>--}}
@stop