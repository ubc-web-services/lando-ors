<?php  
// Colour options 
$color_option = theme_get_setting('clf_colour_option');
$color_option = theme_get_setting('clf_colour_option');
if (theme_get_setting('colourpicker')) {
print '<style scoped media="screen">';
print "/* Header Option Overrides */
div#ubc7-unit { background: #" . theme_get_setting('colourpicker') . "  !important;";
if (theme_get_setting('uglybg')) {
	print "box-shadow: inset 0px -10px 10px -10px #333333;
		-moz-box-shadow: inset 0px -10px 10px -10px #333333;
		-webkit-box-shadow: inset 0px -10px 10px -10px #333333;";
	} else {
	print "box-shadow: none !important;
		-moz-box-shadow: none !important;
		-webkit-box-shadow: none !important;";
	}
print '}</style>';
} 
?>

