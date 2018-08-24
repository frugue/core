// 2018-08-23
require(['jquery'], function($) {$(function() {
	var $compare = $('.header a.compare');
	var resize = function() {
		var w = $(window).width();
		$('.rd-navbar').children('.layout_1,layout_2,layout_3,layout_4,layout_5').toggleClass(
			'frugue-navbar-collapse'
			,w > 768 && w < ('none' == $compare.css('display') ? 992 : 1200)
		);
	};
	$(window).on('resize', resize);
	resize();
	// 2018-08-23 https://stackoverflow.com/a/16462443
	if ('undefined' != typeof MutationObserver) {
		var observer = new MutationObserver(function() {resize();});
		var target = document.querySelector('.header a.compare');
		// 2018-08-25
		// «Failed to execute 'observe' on 'MutationObserver': parameter 1 is not of type 'Node'»
		// https://github.com/frugue/core/issues/32
		if (target) {
			observer.observe(target, {attributes: true});
		}
	}
});});