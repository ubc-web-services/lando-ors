(function($){

CKEDITOR.plugins.add('accordiontoggle', {
  requires: 'widget',
  init: function(editor) {
    // Register the toolbar buttons for the CKEditor editor instance.
    editor.ui.addButton('accordiontoggle',
    {
      label : 'Insert Accordion Open | Close All Button',
      icon : this.path + 'icon-accordiontoggle.png',
      command : 'accordiontoggle'
    });

    // Add our plugin-specific CSS to style the widget within CKEditor.
    editor.addContentsCss( this.path + 'css/editor-accordiontoggle.css' );

    // Register the widget.
    editor.widgets.add('accordiontoggle', {
      template:
        '<a class="expandcollapse btn btn-mini btn-primary" href="#" data-state="0">Open All <span class="icon-chevron-down">&nbsp;</span></a>',
      editables: {
		  content: {
          selector: '.expandcollapse'
        }
      },

      allowedContent: 'a(!expandcollapse,*)[*]',
			
      upcast: function(element) {
        return element.name == 'a' && element.hasClass('accordiontoggle');
      }

    });

  }

});
 

})(jQuery);
