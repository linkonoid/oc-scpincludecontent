<?php namespace Linkonoid\SCPIncludeContent;

use Event;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use Linkonoid\SCPIncludeContent\Components\IncludeContentComponent;

/**
 * @package linkonoid\scpincludecontent
 * @author Max Barulin (https://github.com/linkonoid)
 */ 

class Plugin extends PluginBase
{	    

    public function pluginDetails()
    {
        return [
            'name' => 'SCPIncludeContent',
            'description' => 'Include content on page from other site or file',
            'author' => 'Linkonoid',
			'icon' => 'icon-code',
			'homepage'    => 'https://github.com/linkonoid'
        ];
    }
      
	public function registerComponents()
    {
        return [
            IncludeContentComponent::class => 'includeContent',
        ];
    } 

    public function registerPermissions()
    {      
 		return [
            'linkonoid.scpincludecontent.access_settings'  => [
                'tab'   => 'linkonoid.scpincludecontent::lang.plugin.settings.permissions.tab',
                'label' => 'linkonoid.scpincludecontent::lang.plugin.settings.permissions.label',
			],
        ];
    }

    public function registerSettings()
    {	
        return [
            'settings' => [
                'label' => 'linkonoid.scpincludecontent::lang.plugin.settings.label',
                'description' => 'linkonoid.scpincludecontent::lang.plugin.settings.description',
                'category' => 'Shortcodes',
                'icon' => 'icon-code',
                'class' => 'Linkonoid\SCPIncludeContent\Models\Settings',
				'keywords' => 'linkonoid.scpincludecontent::lang.plugin.settings.keywords',
                'order' => 550,               
                'permissions' => ['linkonoid.scpincludecontent.access_settings']
            ]
        ];
	}

	public function boot()
    {    
        Event::listen('linkonoid.shortcodesengine.onshortcodeHandlers', function ($shortcodes) {
            return $shortcodes->registerAllshortcodes(__DIR__.'/shortcodes',$shortcodes);            
        });
    }
       
}
