/**
 * Created by veades on 2015-04-17.
 */

CKEDITOR.plugins.add('columns', {
    requires: 'widget,dialog',
    icons: 'columns',
    init: function( editor ) {

        CKEDITOR.dialog.add('columns', this.path + 'dialogs/columns.js');

        // Add our plugin-specific CSS to style the widget within CKEditor.
        editor.addContentsCss( this.path + 'css/editor-columns.css' );

        // Register the widget.
        editor.widgets.add('columns', {
            // Allow all HTML elements, classes, and styles that this widget requires.
            // Read more about the Advanced Content Filter here:
            // * http://docs.ckeditor.com/#!/guide/dev_advanced_content_filter
            // * http://docs.ckeditor.com/#!/guide/plugin_sdk_integration_with_acf
            allowedContent: 'div(!columns,clearfix,row-fluid);' +
                            'div(!column,span3,span4,span6,span8,span9);',
            // Minimum HTML which is required by this widget to work.
            requiredContent: 'div(columns)',
            editables: {
                // Define CSS selector used for finding the element inside widget element.
                content: 'div.columns',
                /*content1: 'div.columns > div:nth-child(1) div.column',
                content2: 'div.columns > div:nth-child(2) div.column',
                content3: 'div.columns > div:nth-child(3) div.column'*/
            },
            parts: {
                content: 'div.columns',
                column1: 'div.columns > div:nth-child(1) div.column',
                column2: 'div.columns > div:nth-child(2) div.column',
                column3: 'div.columns > div:nth-child(3) div.column'
            },
            template: '<div class="columns clearfix row-fluid">' +
                      '<div class="column">First Column</div>' +
                      '<div class="column">Second Column</div>' +
                      '<div class="column">Third Column</div>' +
                      '</div>',
            button: 'Insert columns',
            dialog: 'columns',
            upcast: function(element) {
                return element.name == 'div' && element.hasClass('columns');
            },
            init: function() {
                this.setData('columnLayout','3-equal');
            },
            data: function() {
                //alert(this.data.columnLayout);
                var layout = this.data.columnLayout;
                /*var column1 = this.parts.column1;
                var column2 = this.parts.column2;
                var column3 = this.parts.column3;*/
                var content = this.parts.content;
                //alert(layout);
                /*if(layout == '2-equal' || layout == '2-left'){
                    column3.remove();
                }*/
                if(layout == '2-equal'){
                    content.append('<div class="column span6">First Column</div>');
                    content.append('<div class="column span6">Second Column</div>');
                }
               /* if(layout == '2-left'){
                    column2.setAttribute('class', 'column span8');
                }
                if(layout == '2-right'){
                    column2.setAttribute('class','column span4');
                    column1.setAttribute('class', 'column span8');
                }
                if(layout == '3-middle'){
                    column1.setAttribute('class','column span3');
                    column2.setAttribute('class', 'column span6');
                    column3.setAttribute('class','column span3');
                }*/
            }

        });

    }


});
