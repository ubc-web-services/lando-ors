!function($){Drupal.color={logoChanged:!1,callback:function(e,t,a,r,o,l){this.logoChanged||($("#preview #preview-logo img").attr("src",Drupal.settings.color.logo),this.logoChanged=!0),null==Drupal.settings.color.logo&&$("div").remove("#preview-logo"),$("#preview",a).css("backgroundColor",$('#palette input[name="palette[bg]"]',a).val()),$("#preview #preview-main h2, #preview .preview-content",a).css("color",$('#palette input[name="palette[text]"]',a).val()),$("#preview #preview-content a",a).css("color",$('#palette input[name="palette[link]"]',a).val()),$("#preview #preview-sidebar #preview-block",a).css("background-color",$('#palette input[name="palette[sidebar]"]',a).val()),$("#preview #preview-sidebar #preview-block",a).css("border-color",$('#palette input[name="palette[sidebarborders]"]',a).val()),$("#preview #preview-footer-wrapper",a).css("background-color",$('#palette input[name="palette[footer]"]',a).val());var p=$('#palette input[name="palette[top]"]',a).val(),i=$('#palette input[name="palette[bottom]"]',a).val();$("#preview #preview-header",a).attr("style","background-color: "+p+"; background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from("+p+"), to("+i+")); background-image: -moz-linear-gradient(-90deg, "+p+", "+i+");"),$("#preview #preview-site-name",a).css("color",$('#palette input[name="palette[titleslogan]"]',a).val())}}}(jQuery);