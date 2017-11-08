(function ($) {
  Drupal.behaviors.vpri_homeslides = {
    attach: function (context, settings) {
      
	    $('.flexslider').flexslider({
	      animation: "fade", 
	      slideshowSpeed: 3500,           //Integer: Set the speed of the slideshow cycling, in milliseconds
	      animationSpeed: 800,            //Integer: Set the speed of animations, in milliseconds
	      initDelay: 0,
	    });
      
    }
  };
  
  
})(jQuery);