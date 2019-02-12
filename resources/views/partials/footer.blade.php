<footer class="w100 d-block">
	<div class="container">
		<div class="row">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12 col-md-3">
						<h5 class="">@lang('app.company_title')</h5>
						<div class="footer-link">@lang('app.company_description')</div>
						<div class="footer-link"><i class="fa fa-map-marker fa-active"></i>@lang('app.company_address')</div>
						<div class="footer-link">
							<span><i class="fa fa-phone fa-active"></i>03-6228-6444</span>
						</div>
						<div class="footer-link">
							<span class="float"><i class="fa fa-print fa-active"></i>03-3538-1440</span>
						</div>
						<div class="footer-link">
							<a href = "mailto: epinfo_vn@east-person.com"><span><i class="fa fa-envelope-o fa-active"></i>epinfo_jp@east-person.com</span></a>
						</div>
					</div>

					<div class="col-xs-12 col-md-3">
						<div class="">
							<h5 class="">@lang('app.about_us_title')</h5>
							<div class="footer-link"><i class="fa fa-angle-double-right"></i>@lang('app.about_us_message')</div>
							<div class="footer-link"><i class="fa fa-angle-double-right"></i>@lang('app.about_us_policy')</div>
							<div class="footer-link"><i class="fa fa-angle-double-right"></i>@lang('app.about_us_profile')</div>
							<div class="footer-link"><i class="fa fa-angle-double-right"></i>@lang('app.about_us_employee')</div>
						</div>
					</div>

					<div class="col-xs-12 col-md-3">
						<div class="">
							<h5 class="">@lang('app.time_working_title')</h5>
							<div class="footer-link">
								<label>@lang('app.time_working_day')</label>
								<label>@lang('app.time_working_time')</label></div>
							<div class="footer-link">@lang('app.time_working_close')</div>
						</div>
					</div>

					<div class="col-xs-12 col-md-3">
						<div class="">
							<h5 class="">@lang('app.subcribe_title')</h5>
							<div class="footer-link">@lang('app.subcribe_description')</div>
							<div class="footer-link">
								<form class="subscribe-form" data-api="/subscribe_register">
									@csrf
									<div class="input-group">
										<input required type="email" name="email" class="form-control" placeholder="@lang('app.enter_email')">
										<div class="input-group-append">
											<a href="javascript:void(0);" class="btn-submit input-group-text"><i class="fa fa-envelope-o fa-secondary"></i></a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="w100 social-icons sm d-none d-block d-sm-block d-md-none d-inline-flex align-items-center justify-content-center">
				<a href="https://www.facebook.com/totwork/" target="_blank" class="d-block"><i class="circle fa fa-facebook"></i></a>
				<a href="#" class="d-block"><i class="circle fa fa-twitter"></i></a>
				<a href="#" class="d-block"><i class="circle fa fa-google-plus"></i></a>
				<a href="#" class="d-block"><i class="circle fa fa-instagram"></i></a>
			</div>
			<div class="d-block divider_dashed11"></div>
			
			<div class="w100 footer-copy-right footer-link">
				<div class="row">
					<div class="col-xs-12 col-md-6">@lang('app.lincense')</div>
					<div class="col-xs-12 col-md-6">
                    <div class="d-none d-md-block d-lg-block d-xl-block">
                        <div class="row no-gutters justify-content-end">
                            <a href="#" class="d-inline footer-divider">@lang('app.rules')</a>
                            <a href="#" class="d-inline footer-divider">@lang('app.introduce')</a>
                            <a href="#" class="d-inline footer-divider">@lang('app.policy')</a>
                            <a href="#" class="d-inline">@lang('app.contact')</a>
                        </div>
                    </div>
                    <div class="d-block d-sm-block d-md-none">
                        <div class="row no-gutters justify-content-center">
                            <a href="#" class="d-inline footer-divider">@lang('app.rules')</a>
                            <a href="#" class="d-inline footer-divider">@lang('app.introduce')</a>
                            <a href="#" class="d-inline footer-divider">@lang('app.policy')</a>
                            <a href="#" class="d-inline">@lang('app.contact')</a>
                        </div>
                    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>