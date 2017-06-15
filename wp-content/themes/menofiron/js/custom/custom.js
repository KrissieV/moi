(function($) {
	$(document).ready(function(){
      $('#nav-icon').click(function(){
        $(this).toggleClass('open');
      });
    });

    jQuery(document).ready(function($) {
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });
        });
})(jQuery);