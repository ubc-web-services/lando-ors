/**
 * Created by veades on 2015-04-17.
 */
(function($){

    CKEDITOR.plugins.add('threetabs', {
        requires: 'widget',

        init: function( editor ) {

            // Add our plugin-specific CSS to style the widget within CKEditor.
            editor.addContentsCss( this.path + 'css/editor-threetabs.css' );

            // Register the toolbar buttons for the CKEditor editor instance.
            editor.ui.addButton('threetabs',
                {
                    label : 'Insert 3 tabs',
                    icon : this.path + 'threetabs.png',
                    command : 'threetabs'
                });

            // Register the widget.
            editor.widgets.add('threetabs', {
                template:   '<div class="tabs-3 tab-wrapper">' +
                            '<ul class="tabs">' +
                            '<li class="active" rel="tab1">Title 1</li>' +
                            '<li rel="tab2">Title 2</li>' +
                            '<li rel="tab3">Title 3</li>' +
                            '</ul>' +
                            '<div class="tab_container tab-pane">' +
                            '<h5 class="tab_drawer_heading" rel="tab1">Title 1</h5>' +
                            '<div id="tab1" class="tab_content"><p>Tab 1 content</p></div>' +
                            '</div>' +
                            '<div class="tab_container tab-pane">' +
                            '<h5 class="tab_drawer_heading" rel="tab2">Title 2</h5>' +
                            '<div id="tab2" class="tab_content"><p>Tab 2 content</p></div>' +
                            '</div>' +
                            '<div class="tab_container tab-pane">' +
                            '<h5 class="tab_drawer_heading" rel="tab3">Title 3</h5>' +
                            '<div id="tab3" class="tab_content"><p>Tab 3 content</p></div>' +
                            '</div>' +
                            '</div>',
                allowedContent: 'div(!tabs-3,tab-wrapper);ul(!tabs);li(active);' +
                                'div(!tab-container);h5(!tab_drawer_heading);div(!tab_content)',
                // Minimum HTML which is required by this widget to work.
                requiredContent: 'div(tabs-3)',
                editables: {
                    content: {
                        selector: 'div.tabs-3'
                    }
                },
                upcast: function(element) {
                    return element.name == 'div' && element.hasClass('tabs-3');
                }
            });
        }
    });
})(jQuery);
