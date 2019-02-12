(function () {
	'use strict';

	var $subscribeForm = $('.subscribe-form');
	app.form($subscribeForm, $subscribeForm.find('.btn-submit'));
	
	var $slider = $('.slider-home-bg');
	let w_min = '0px';
	let w_max = $slider.width() + 'px';
	var h_slider = $slider.height() + 'px';
	
	if ($slider.length) {
		$slider.css({'width': w_max, 'height': h_slider})
			.find('.slider-home-data').css({
				'visibility': 'inherit', 'position': 'absolute', 'opacity': '1',
				'clip': 'rect(0px, 0px, '+h_slider+', 0px)'}
			);

		setTimeout(function(){
			$slider.find('.slider-home-data').css({'clip': 'rect(0px, '+w_max+', '+h_slider+', 0px)'});
		}, 1000);
	}
})();