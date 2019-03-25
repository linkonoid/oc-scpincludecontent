<?php namespace Linkonoid\SCPIncludeContent\Classes;

use GuzzleHttp\Client;
//use GuzzleHttp\Psr7\Request;
use voku\helper\HtmlDomParser;
//use voku\helper\SimpleHtmlDom.php;
use Linkonoid\SCPIncludeContent\Models\Settings;

require_once 'vendor/autoload.php';

/**
 * @package linkonoid\scpincludecontent
 * @author Max Barulin (https://github.com/linkonoid)
 */  

class IncludeContent
{

    private function fileGetContentsCurl($url)
    {
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    
        $data = curl_exec($ch);
        curl_close($ch);
    
        return $data;
    }
    
    public static function getContents($url, $selector, $timeout)
    {      
        $urlParse = parse_url($url);
        if (!is_null(Settings::instance()->get('type'))) $type = Settings::instance()->get('type');
        if (!isset($urlParse['scheme'])) $type = 'simple';

        switch ($type) {
            case 'guzzle':
                $client = new Client(['base_uri' => $url,'timeout'  => $timeout]);       
                $response = $client->request('GET');
        
                $code = $response->getStatusCode(); // 200
                $reason = $response->getReasonPhrase(); // OK 
        
                if ($code=='200' && $reason=='OK'){     
                    $body = @$response->getBody();
                    //$content  = (string) $body;
                    $content = $body->getContents();            
                }                    
                break;
            case 'simple':
                $dom = HtmlDomParser::file_get_html($url);
                $body = @$dom->find('body',0);
                $content = $body->innertext;
                break;
            case 'curl':
                $content = $this->fileGetContentsCurl($url);
                $dom = HtmlDomParser::str_get_html($content);
                $body = @$dom->find('body',0);
                $content = $body->innertext;
        }

        if (empty($selector)) return $content;
 
        $dom = HtmlDomParser::str_get_html($content);

        $elem = $dom->find($selector);

        $content = ''; foreach ($elem as $value) $content .= $value->innertext;
        
        if (!is_null(Settings::instance()->get('substitution'))){ 
            $search = [];
            $replace = [];
            foreach (Settings::instance()->get('substitution') as $key => $substitution){
                $search[$key] = $substitution['search'];
                $replace[$key] = $substitution['replace'];
            }
            $content = str_replace($search, $replace, $content);
        }
        
        if (!is_null(Settings::instance()->get('addcontent'))) foreach (Settings::instance()->get('addcontent') as $addcontent) $content .= $addcontent['value'];

        return $content; 
    }
}
