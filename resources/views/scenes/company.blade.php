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
				{!! $page->content !!}
			</div>
	</section>
	{{--<div class="w100">
		<div class="col-12">
			<div class="d-block mb-5">
				<div class="row pt-2 pb-2">
					<div class="border_title_bottom">
						<h2 class="text-uppercase">Giới thiệu về doanh nghiệp</h2>
					</div>
				</div>
				<div class="row pt-2 pb-2">
					<div class="col-2 text-bold">Số người</div>
					<div class="col-8">Số người tối đa được chấp nhận mỗi năm là 5% số lượng nhân viên(đơn vị công ty bao gồm một phần).</div>
				</div>
				<div class="row pt-2 pb-2">
					<div class="col-2 text-bold">Thời gian lưu trú</div>
					<div class="col-8">Thời hạn cư trú của tình trạng cư trú "Đào tạo kỹ thuật thực tập số 1" là một năm. Căn cứ vào quá trình chuyển đổi sang "Đào tạo kỹ thuật thực tập số 2" (kiểm tra và chứng nhận), có thể ở lại đến 3 năm(Sẽ chỉ 5 năm để chấp nhận là một công ty tốt, tổ chức giám sát tốt theo luật sửa đổi).</div>
				</div>
				<div class="row pt-2 pb-2">
					<div class="col-2 text-bold">Giới hạn doanh mục công việc</div>
					<div class="col-8">Trong khuôn khổ của một số người cố định, chúng tôi có thể chấp nhận liên tục. Chúng tôi sẽ nhận ra thực hành chính xác với sự hổ trợ toàn diện nhằm gần các thực tập sinh làm việc tại Nhật Bản lần đầu tiên</div>
				</div>
				<div class="row pt-2 pb-2">
					<div class="col-2 text-bold">mẫu tuyển dụng</div>
					<div class="col-8">Việc chấp nhận học viên thực tập sẽ đóng góp vào sự đóng góp quốc tế của chính phủ Nhật Bản và nó cũng sẽ là chổ đứng cho sự tương tác với các nước Đông Nam Á, là đất nước của các thực tập sinh.</div>
				</div>
			</div>
			<div class="d-block mb-5">
				<div class="border_title_bottom">
					<h2 class="text-uppercase">Triết lý kinh doanh</h2>
				</div>
				<ul class="card-description-detail list-none-style list-group">
					<li class="mb-1">1. Chuẩn bị hổ trợ cho công ty vay nhà ở</li>
					<li class="mb-1">2. Hổ trợ quản lý phong cách sống</li>
					<li class="mb-1">3. Giải trí kỳ nghỉ v.v...</li>
					<li class="mb-1">4. Phản ứng khẩn cấp</li>
					<li class="mb-1">5. Giải thích / hổ trợ dịch thuật theo yêu cầu của khách hàng</li>
					<li class="mb-1">6. Hổ trợ quản lý phong cách sống</li>
					<li class="mb-0">7. Giải trí kỳ nghỉ v.v...</li>
				</ul>
			</div>
			<div class="d-block">
				<div class="border_title_bottom">
					<h2 class="text-uppercase">Thông tin giám đốc</h2>
				</div>
				<p class="card-description-detail text-bold">
					Thời gian để tạm ứng quyết định và thời gian học tập thay đổi từ ngắn nhất khoảng 3 tháng đến tối đa 10 tháng theo yêu cầu của bạn
				</p>
			</div>
		</div>
	</div>--}}
@stop