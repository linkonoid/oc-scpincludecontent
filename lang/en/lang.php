<?php return [

    'plugin' => [           
        'name' =>'SCPIncludeContent',
        'description' => 'Include content from other site or file in your page',        
        'settings' => [
            'label' => 'Include content',            
            'description' => 'Include content from other site or file in your page',
            'category' => 'Shortcodes',
            'keywords' => 'shortcodes, short, code, BBCode, plugin, settings, include, content',
            'permissions' => [
                'tab'   => 'Permissions for IncludeContent plugin settings',
                'label' => 'Show IncludeContent plugin settings tab in control panel', 
            ],  
        ],
    ],
    
    'settings' => [

        'grab' => [
            'tab' => 'Grab settings',
            'type' => 'Select grub engine',
            'timeout' => 'Default timeout',            
        ],

        'replacer' => [
            'tab' => 'Replacer settings',
            'substitution' => 'Content replace',
            'substitution-search' => 'Search data',
            'substitution-replace' => 'Replace data',
            'substitution-add' => 'Add new replace data',            
            'addcontent' => 'Content adding',
            'addcontent-add' => 'Add new content on end',            
            'addcontent-value' => 'Adding Html code',
        ],

    ],

    'component_includecontent' => [
        'property_url' =>[
            'title' => 'Path',
            'description' => 'Full remote Url (with protocol) or local Path',
        ],
        'property_selector' => [
            'title' => 'Grub selector',
            'description' => 'Tag element or Css class',
        ],        
        'property_timeout' => [
            'title' => 'Timeout',
            'description' => 'Get content timeout',
        ]
    ]
];