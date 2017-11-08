// Register our custom "callout" widget plugin with CKEditor.
(function($){
	CKEDITOR.plugins.add('callout', {
	  requires: 'widget',
	  init: function(editor) {
			
      // Add our plugin-specific CSS to style the widget within CKEditor.
      editor.addContentsCss( this.path + 'css/editor-callout.css' );
			
	    // Register the toolbar buttons for the CKEditor editor instance.
	    editor.ui.addButton( 'callout', {
	      label : 'Insert callout box',
	      icon : this.path + 'callout.png',
	      command : 'callout'
	    });
	    // Register the widget.
	    editor.widgets.add('callout', {
	      
				template: '<div class="callout"><div class="callout-inner">Callout box contents here.</div></div>',
	      
				allowedContent: 'div(!callout);' +
												'div(!callout-inner)',
	      
				requiredContent: 'div(callout)',
				
				editables: {
	        contents: {
	          selector: '.callout-inner'
	        }
	      },
	      
				upcast: function(element) {
					 return element.name == 'div' && element.hasClass('callout');
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