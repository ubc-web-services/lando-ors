/**
 * Created by veades on 2015-04-17.
 */
(function($){

    CKEDITOR.plugins.add('bs3-3columns', {
        requires: 'widget',

        init: function( editor ) {

            // Add our plugin-specific CSS to style the widget within CKEditor.
            editor.addContentsCss( this.path + 'css/editor-bs3-3columns.css' );

            // Register the toolbar buttons for the CKEditor editor instance.
            editor.ui.addButton('bs3-3columns',
                {
                    label : 'Insert 3 Bootstrap v.3 columns',
                    icon : this.path + 'bs3-3columns.png',
                    command : 'bs3-3columns'
                });

            // Register the widget.
            editor.widgets.add('bs3-3columns', {
                template:   '<div class="columns-3 row">' +
                            '<div class="col-md-4"><p>First Column</p></div>' +
                            '<div class="col-md-4"><p>Second Column</p></div>' +
                            '<div class="col-md-4"><p>Third Column</p></div>' +
                            '</div>',
                allowedContent: 'div(!columns-3,row);' +
                                'div(!col-md-4);',
                // Minimum HTML which is required by this widget to work.
                requiredContent: 'div(columns-3)',
                editables: {
                    col1: {
                        selector: 'div.columns-3 > div:nth-child(1)',
                        //allowedContent: 'p br ul ol li strong em img div'
                    },
                    col2: {
                        selector: 'div.columns-3 > div:nth-child(2)',
                        //allowedContent: 'p br ul ol li strong em img div'
                    },
                    col3: {
                        selector: 'div.columns-3 > div:nth-child(3)',
                        //allowedContent: 'p br ul ol li strong em img div'
                    }
                },

                upcast: function(element) {
                    return element.name == 'div' && element.hasClass('columns-3');
                }

            });

        }


    });

})(jQuery);
