// Register our custom "callout" widget plugin with CKEditor.
(function($){
	CKEDITOR.plugins.add('listgroup', {
	  requires: 'widget',
	  init: function(editor) {
			
      // Add our plugin-specific CSS to style the widget within CKEditor.
      editor.addContentsCss( this.path + 'css/editor-listgroup.css' );
			
	    // Register the toolbar buttons for the CKEditor editor instance.
	    editor.ui.addButton( 'listgroup', {
	      label : 'Insert a list-group',
	      icon : this.path + 'listgroup.png',
	      command : 'listgroup'
	    });
	    // Register the widget.
	    editor.widgets.add('listgroup', {
	      
				template: '<div class="list-group">' +
    								'<div class="heading-area">' +
      								'<h4 class="list-group-item-heading">Insert a title</h4>' +
      								'<p class="list-group-item-text">insert a subtitle</p>' +
    								'</div>' +
    								'<div class="list-group-contents"><a href="#">Insert some links here</a></div>' +
  								'</div>',
	      	      
				requiredContent: 'div(list-group)',
				
				editables: {
	        heading: {
	          selector: '.list-group-item-heading',
						allowedContent: 'em'
	        },
	        subtitle: {
	          selector: '.list-group-item-text',
						allowedContent: 'em'
	        },
	        contents: {
	          selector: '.list-group-contents',
						allowedContent: 'a[href,target]'
	        }
	      },
				
				allowedContent: 'div(!list-group,widget); div(!heading-area); h4(!list-group-item-heading); p(!list-group-item-text); div(!list-group-contents);a[href,target]',
				disallowedContent: 'br; p',
	      
				upcast: function(element) {
					 return element.name == 'div' && element.hasClass('list-group');
				 }
	        /*
					if (element.name == 'div' && element.hasClass('callout')) {
	          return true;
	        }
	        else {
	          return false;
	        }
	      }
					*/
	    });
	  }
	});
})(jQuery);