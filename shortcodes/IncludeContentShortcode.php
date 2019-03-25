<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Linkonoid\SCPIncludeContent\Models\Settings;
use Linkonoid\SCPIncludeContent\Classes\IncludeContent;

/**
 * @package linkonoid\scpincludecontent
 * @author Max Barulin (https://github.com/linkonoid)
 */  

class IncludeContentShortcode extends Shortcode
{

    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function init()
    {
        $this->manager->getHandlers()->add('includecontent', function(ShortcodeInterface $sc) {
            $url = $sc->getParameter('includecontent', $sc->getBbCode());
            $selector = $sc->getParameter('selector', $sc->getBbCode());
            $timeout = $sc->getParameter('timeout', $sc->getBbCode());
            if(empty($timeout)) if (!is_null(Settings::instance()->get('timeout'))) $timeout = Settings::instance()->get('timeout');
            return IncludeContent::getContents($url, $selector, $timeout);
        });
    }

}
