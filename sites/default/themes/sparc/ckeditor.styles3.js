/*
Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/*
 * This file is used/requested by the 'Styles' button.
 * The 'Styles' button is not enabled by default in DrupalFull and DrupalFiltered toolbars.
 */
if(typeof(CKEDITOR) !== 'undefined') {
    CKEDITOR.addStylesSet( 'drupal',
    [

            /* Object Styles */
            
            // TEXT VARIANTS
            {
                    name : 'H2: Light',
                    element : 'h2',
                    attributes :
                    {
                            'class' : 'light'
                    }
            },
            {
                    name : 'H3: Light',
                    element : 'h3',
                    attributes :
                    {
                            'class' : 'light'
                    }
            },
            {
                    name : 'H4: Light',
                    element : 'h4',
                    attributes :
                    {
                            'class' : 'light'
                    }
            },
            {
                    name : 'P: Lead',
                    element : 'p',
                    attributes :
                    {
                            'class' : 'lead'
                    }
            },
            {
                    name : 'P: Footnote',
                    element : 'p',
                    attributes :
                    {
                            'class' : 'note'
                    }
            },
            
            
            // BUTTONS
            {
                    name : 'Unit Button',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit'
                    }
            },
            {
                    name : 'Unit Button: Small',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit btn-small'
                    }
            },
            {
                    name : 'Unit Button: Mini',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit btn-mini'
                    }
            },
            {
                    name : 'Unit Button: Large',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit btn-large'
                    }
            },
            
            {
                    name : 'Unit Button: Reverse',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit btn-unit-reverse'
                    }
            },
            {
                    name : 'Unit Button: Small, Reverse',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit btn-unit-reverse btn-small'
                    }
            },
            {
                    name : 'Unit Button: Mini, Reverse',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit btn-unit-reverse btn-mini'
                    }
            },
            {
                    name : 'Unit Button: Large, Reverse',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit btn-unit-reverse btn-large'
                    }
            },
            
            {
                    name : 'Secondary Unit Button',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit-secondary'
                    }
            },
            {
                    name : 'Secondary Unit Button: Small',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit-secondary btn-small'
                    }
            },
            {
                    name : 'Secondary Unit Button: Mini',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit-secondary btn-mini'
                    }
            },
            {
                    name : 'Secondary Unit Button: Large',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit-secondary btn-large'
                    }
            },
            {
                    name : 'Secondary Unit Button: Reverse',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit-secondary btn-unit-reverse'
                    }
            },
            {
                    name : 'Secondary Unit Button: Small, Reverse',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit-secondary btn-unit-reverse btn-small'
                    }
            },
            {
                    name : 'Secondary Unit Button: Mini, Reverse',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit-secondary btn-unit-reverse btn-mini'
                    }
            },
            {
                    name : 'Secondary Unit Button: Large, Reverse',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'btn btn-unit-secondary btn-unit-reverse btn-large'
                    }
            },
            
            
            // LISTS
            {
                    name : 'Checklist',
                    element : 'ul',
                    attributes :
                    {
                            'class' : 'checklist'
                    }
            },
            {
                    name : 'Checklist: Ordered List',
                    element : 'ol',
                    attributes :
                    {
                            'class' : 'checklist'
                    }
            },
			
			// BOX STYLES 
			
			{ 
					name: 'Light Blue Background', 
					type: 'widget', 
					widget: 'ctarowtwo', 
					attributes: { 
						'class': 'bg-light' 
					} 
			},
			{ 
					name: 'Dark Blue Background', 
					type: 'widget', 
					widget: 'ctarowtwo', 
					attributes: { 
						'class': 'bg-dark' 
					} 
			},
			{ 
					name: 'Light Blue Background', 
					type: 'widget', 
					widget: 'ctarowthree', 
					attributes: { 
						'class': 'bg-light' 
					} 
			},
			{ 
					name: 'Dark Blue Background', 
					type: 'widget', 
					widget: 'ctarowthree', 
					attributes: { 
						'class': 'bg-dark' 
					} 
			},
		   

            
            // IMAGES
            {
                    name : 'Image',
                    element : 'img',
                    attributes :
                    {
                            'class' : 'thumbnail'
                    }
            },
            {
                    name : 'Image: Left',
                    element : 'img',
                    attributes :
                    {
                            'class' : 'thumbnail pull-left'
                    }
            },
            {
                    name : 'Image: Centered',
                    element : 'img',
                    attributes :
                    {
                            'class' : 'thumbnail img-center'
                    }
            },
            {
                    name : 'Image: Right',
                    element : 'img',
                    attributes :
                    {
                            'class' : 'thumbnail pull-right'
                    }
            }
                        
    ]);
}