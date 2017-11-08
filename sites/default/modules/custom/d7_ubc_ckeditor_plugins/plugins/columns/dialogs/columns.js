/**
 * Created by veades on 2015-04-19.
 */

CKEDITOR.dialog.add( 'columns', function( editor ) {
    return {
        title: 'Select Column Options',
        minWidth: 400,
        minHeight: 300,
        contents: [
            {
                id: 'info',
                label: 'Basic Settings',
                elements: [
                    {
                        id: 'columnLayout',
                        type: 'select',
                        label: 'Select Column Layout',
                        items: [
                            [ '2 Equal', '2-equal' ],
                            [ '3 Equal', '3-equal' ],
                            [ '2 Left Siderail', '2-left' ],
                            [ '2 Right Siderail', '2-right' ],
                            [ '3 Middle Large', '3-middle' ],
                        ],
                        // When setting up this field, set its value to the "columnLayout" value from widget data.
                        // Note: Column Layout values used in the widget need to be the same as those defined in the "items" array above.
                        setup: function( widget ) {
                            this.setValue( widget.data.columnLayout );
                        },
                        // When committing (saving) this field, set its value to the widget data.
                        commit: function( widget ) {
                            widget.setData( 'columnLayout', this.getValue() );
                        }
                    }
                ]
            },

        ]
    };
} );


