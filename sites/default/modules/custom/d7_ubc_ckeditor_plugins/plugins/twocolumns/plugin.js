/**
 * Created by veades on 2015-04-17.
 */
(function($){

    CKEDITOR.plugins.add('twocolumns', {
        requires: 'widget',
        init: function( editor ) {

            // Add our plugin-specific CSS to style the widget within CKEditor.
            editor.addContentsCss( this.path + 'css/editor-twocolumns.css' );

            // Register the toolbar buttons for the CKEditor editor instance.
            editor.ui.addButton('twocolumns',
                {
                    label : 'Insert 2 Columns',
                    icon : this.path + 'twocolumns.png',
                    command : 'twocolumns'
                });

            // Register the widget.
            editor.widgets.add('twocolumns', {
                template:   '<div class="columns-2 clearfix row-fluid">' +
                            '<div class="span6"><p>First Column</p></div>' +
                            '<div class="span6"><p>Second Column</p></div>' +
                            '</div>',
                // Minimum HTML which is required by this widget to work.
                allowedContent: 'div(!columns-2,clearfix,row-fluid);' +
                                'div(!span6);',
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
