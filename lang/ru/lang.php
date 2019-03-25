<?php return [

    'plugin' => [           
        'name' =>'SCPIncludeContent',
        'description' => 'Include content from other site or file in your page',        
        'settings' => [
            'label' => 'Внедрение контента',            
            'description' => 'Включение контента с другого сайта или из файла в вашу страницу',
            'category' => 'Shortcodes',
            'keywords' => 'shortcodes, short, code, BBCode, plugin, settings, include, content',
            'permissions' => [
                'tab'   => 'Разрешения для IncludeContent',
                'label' => 'Показывать плагин IncludeContent в панели управления во вкладке настроек плагина', 
            ],  
        ],
    ],

    'settings' => [

        'grab' => [
            'tab' => 'Настройки граббера',
            'type' => 'Выбор библиотеки граббера',
            'timeout' => 'Таймаут по умолчанию',            
        ],

        'replacer' => [
            'tab' => 'Настройки подмены',
            'substitution' => 'Подмена контента',
            'substitution-search' => 'Строка поиска',
            'substitution-replace' => 'Строка замены',
            'substitution-add' => 'Добавить новую подстановку',            
            'addcontent' => 'Добавление контента',
            'addcontent-add' => 'Добавить в конец новый Html-контент',            
            'addcontent-value' => 'Html-код контента',
        ],

    ],

    'component_includecontent' => [
        'property_url' =>[
            'title' => 'Путь',
            'description' => 'Полный Url (включая протокол) или путь к локальному файлу',
        ],
        'property_selector' => [
            'title' => 'Grub selector',
            'description' => 'Название тега или css-класс',
        ],        
        'property_timeout' => [
            'title' => 'Timeout',
            'description' => 'Таймаут на запрос',
        ]
    ]   

];