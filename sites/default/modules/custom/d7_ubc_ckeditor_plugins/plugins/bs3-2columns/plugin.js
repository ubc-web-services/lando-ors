/**
 * Created by jotoole on 2015-06-06.
 */
(function($){

    CKEDITOR.plugins.add('bs3-2columns', {
        requires: 'widget',
        init: function( editor ) {

            // Add our plugin-specific CSS to style the widget within CKEditor.
            editor.addContentsCss( this.path + 'css/editor-bs3-2columns.css' );

            // Register the toolbar buttons for the CKEditor editor instance.
            editor.ui.addButton('bs3-2columns',
                {
                    label : 'Insert 2 Bootstrap v.3 Columns',
                    icon : this.path + 'bs3-2columns.png',
                    command : 'bs3-2columns'
                });

            // Register the widget.
            editor.widgets.add('bs3-2columns', {
                template:   '<div class="columns-2 row">' +
                            '<div class="col-md-6"><p>First Column</p></div>' +
                            '<div class="col-md-6"><p>Second Column</p></div>' +
                            '</div>',
                // Minimum HTML which is required by this widget to work.
                allowedContent: 'div(!columns-2,row);' +
                                'div(!col-md-6);',
                requiredContent: 'div(columns-2)',
                editables: {
                    col1: {
                        selector: 'div.columns-2 > div:nth-child(1)',
                        //allowedContent: 'p br ul ol li strong em img div'
                    },
                    col2: {
                        selector: 'div.columns-2 > div:nth-child(2)',
                        //allowedContent: 'p br ul ol li strong em img div'
                    }
                },

                upcast: function(element) {
                    return element.name == 'div' && element.hasClass('columns-2');
                }

            });

        }


    });

})(jQuery);
