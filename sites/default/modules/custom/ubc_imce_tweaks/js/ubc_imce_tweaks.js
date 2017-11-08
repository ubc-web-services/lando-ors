
// Allow for expanding and contracting of the sidebar navigation
Drupal.behaviors.ubcImceTweaks = function(context) {
  $('.navigation-text').append('<a class="imce-close-nav" title="Close Navigation" href="#">X</a>');
  $('.imce-close-nav').click(function(){
    $('#navigation-wrapper').css('width','0');
  });
}
