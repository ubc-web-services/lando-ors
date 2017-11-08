(function ($) {
 	Drupal.behaviors.ubc_ckeditor_plugins = {
		attach: function (context) {
			/* Control Accordion Open / Close */
			$('.accordion', context).once('ubc_ckeditor_plugins', function () {
				$(this).find('.accordion-tab').first().click(function(e){
					e.preventDefault();
					//Expand or collapse this panel
					$(this).next().slideToggle('fast');
					$(this).parent().toggleClass('accordion-closed accordion-open');
				});
			});
			
			/* Separate expand / collapse buttons 
				Sample markup:
				<a class="open-accordions" href="#">Open Accordions</a> <a class="close-accordions" href="#">Close Accordions</a>
			*/
			$('.open-accordions', context).once('ubc_ckeditor_plugins', function () {
				$(this).click(function(e){
					e.preventDefault();
					$('.accordion-closed .accordion-content').slideDown('fast');
					$('.accordion').removeClass('accordion-closed').addClass('accordion-open');
				});
			});
			$('.close-accordions', context).once('ubc_ckeditor_plugins', function () {
				$(this).click(function(e){
					e.preventDefault();
					$('.accordion-open .accordion-content').slideUp('fast');
					$('.accordion').removeClass('accordion-open').addClass('accordion-closed');
				});
			});
			
			/* Single expand / collapse button 
				Sample markup:
				<a class="expandcollapse btn btn-mini btn-primary" href="#_" data-state="0"><i class="icon-chevron-down">&nbsp;</i> Expand All</a>
			*/
			$('.expandcollapse', context).once('ubc_ckeditor_plugins', function () {
				$(this).click(function(e){
					e.preventDefault();
					var newstate = $(this).attr('data-state') ^ 1,
						text = newstate ? "Close" : "Open";
						icon = newstate ? "up" : "down";

			        // if state=0, show all the accordion content on the page
			        if ( $(this).attr('data-state')==="0" ) {
			            console.log('1');
						$('.accordion-closed .accordion-content').slideDown('fast');
						$('.accordion').removeClass('accordion-closed').addClass('accordion-open');
			        }
			        // otherwise, collapse all the accordion content
			        else {
			            console.log('2');
						$('.accordion-open .accordion-content').slideUp('fast');
						$('.accordion').removeClass('accordion-open').addClass('accordion-closed');
			        }
					// toggle expand collapse text
			        $(this).html(text + ' All <span class="icon-chevron-' + icon + '">&nbsp;</span>');
					// update the state on the expandcollapse trigger
			        $(this).attr('data-state',newstate)
				});
			});
		}
	};
})(jQuery);
