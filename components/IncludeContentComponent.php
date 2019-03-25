<?php namespace Linkonoid\SCPIncludeContent\Components;

use Event;
use Cache;
use Flash;
use Cms\Classes\ComponentBase;
use RainLab\Translate\Classes\Translator;
use Linkonoid\SCPIncludeContent\Models\Settings;
use Linkonoid\SCPIncludeContent\Classes\IncludeContent;

/**
 * @package linkonoid\scpincludecontent
 * @author Max Barulin (https://github.com/linkonoid)
 */ 

class IncludeContentComponent extends ComponentBase
{

    public function componentDetails()
	{
		return [
			'name'			=> 'IncludeContent',
            'description'	=> 'Include Content from url'
		];
	}

    public function defineProperties()
    {
        return [
            'url' => [
                'title' => 'linkonoid.scpincludecontent::lang.component_includecontent.property_url.title',
                'description' => 'linkonoid.scpincludecontent::lang.component_includecontent.property_url.description',
                'type' => 'string',
                'default' => ''
            ],
            'selector' => [
                'title' => 'linkonoid.scpincludecontent::lang.component_includecontent.property_selector.title',
                'description' => 'linkonoid.scpincludecontent::lang.component_includecontent.property_selector.description',
                'type' => 'string',                
                'default' => ''
            ],
            'timeout' => [
                'title' => 'linkonoid.scpincludecontent::lang.component_includecontent.property_timeout.title',
                'description' => 'linkonoid.scpincludecontent::lang.component_includecontent.property_timeout.description',
                'type' => 'string',                
                'default' => 2
            ]
        ];
    }

    public function onRender()
    {
        $this->page['get_url'] = $this->property('url') ? $this->property('url') : '';
        $this->page['get_selector'] = $this->property('selector') ? $this->property('selector') : '';       
        if(empty($this->property('get_timeout'))) { 
            if (!is_null(Settings::instance()->get('timeout'))) $this->page['get_timeout'] = Settings::instance()->get('timeout');
        } else $this->page['get_timeout'] = $this->property('timeout');
        
        if (!empty($this->page['get_url'])) {
            $this->page['get_content'] = IncludeContent::getContents($this->page['get_url'], $this->page['get_selector'], $this->page['get_timeout']);
        }
    }

    /**
     * Change property
     */
    public function changeProperty($propertyName, $propertyValue) {

        if($this->propertyExists($propertyName)) {
            $this->setProperty($propertyName, $propertyValue);
        }
    }

}