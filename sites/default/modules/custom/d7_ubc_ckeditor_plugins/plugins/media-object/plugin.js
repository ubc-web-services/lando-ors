/**
 * Created by veades on 2015-04-17.
 */
(function($){

    CKEDITOR.plugins.add('media-object', {
        requires: 'widget',
        init: function( editor ) {

            // Add our plugin-specific CSS to style the widget within CKEditor.
            editor.addContentsCss( this.path + 'css/editor-media-object.css' );

            // Register the toolbar buttons for the CKEditor editor instance.
            editor.ui.addButton('media-object',
                {
                    label : 'Insert media object',
                    icon : this.path + 'media-object.png',
                    command : 'media-object'
                });

            // Register the widget.
            editor.widgets.add('media-object', {
							
                template:   '<div class="media">' +
                            '<div class="pull-left"><img class="media-image" alt="" src="http://placehold.it/150x150"></div>' +
                            '<div class="media-body">' +
                            '<h4 class="media-heading">Media heading</h4>' +
														'<div class="media-content"><p>Some content here</p></div>' +
                            '</div></div>',
               
                // Minimum HTML which is required by this widget to work.
                requiredContent: 'div(media)',
                
								editables: {
                  imagearea: {
	          				selector: '.pull-left',
										//allowedContent: 'img[src,class,data,alt],a[href,target,data]'
										disallowedContent: 'br; p',
                  },
                  title: {
	          				selector: '.media-heading',
										allowedContent: 'h4'
                  },
                  message: {
	          				selector: '.media-content',
										//allowedContent: 'p,a[href,target,data-*]'
                  },
                },
								
                allowedContent: 'div(!media);' +
																'div(!pull-left);' +
																'div(!media-body);' +
																'h4(!media-heading);'+
																'div(!media-content);' +
																'p;' +
																'img[src,class,data,alt];'+ 
																'a[href,target,data]',

                upcast: function(element) {
                    return element.name == 'div' && element.hasClass('media');
                }
            
						});
        
				}

    });

})(jQuery);
