<?php App::import('Helper', 'Html'); 

class VideoHelper extends HtmlHelper
{
    public $helpers = array(
        'Media.Youtube',
        'Media.Dailymotion',
        'Media.Vimeo'
    );
    
    private $domains = array(
        'youtube' => array(
            'www.youtube.com',
            'youtube.com'
        ),
        'dailymotion' => array(
            'www.dailymotion.com',
            'dailymotion.com'
        ),
        'vimeo' => array(
            'vimeo.com',
            'www.vimeo.com'
        )
    );
    
    public $defaultOption = array(
        'size' => 'medium',
        'width' => 80
    );
    
    public function thumbnail($url, $options = array())
    {        
        $data = $this->defaultOption;
        
        if(!empty($options))
        {
            $data = array_merge($this->defaultOption, $options);
        }
        
        $defaultDomaine = $this->getHelperByHost($url);
        
        if(!is_null($defaultDomaine))
        {
            return $this->$defaultDomaine->thumbnail($url, $data);
        }
        
        return null;
    }
    
    public function getHelperByHost($url)
    {
        $defaultDomaine = null;
        $host = parse_url($url);
        
        foreach($this->domains as $key => $domain)
        {
            foreach ($domain as $value) 
            {
                if($host['host'] === $value)
                {
                    $defaultDomaine = ucfirst($key);
                }
            }
        }
        
        return $defaultDomaine;
    }
    
    public function getUrlThumbnail($url)
    {
        $defaultDomaine = $this->getHelperByHost($url);
        
        if(!is_null($defaultDomaine))
        {
            return $this->$defaultDomaine->getUrlThumbnail($url);
        }
        
        return null;
    }
    
    public function getUrlVideo($url)
    {
        $defaultDomaine = $this->getHelperByHost($url);
        
        if(!is_null($defaultDomaine))
        {
            return $this->$defaultDomaine->getUrlVideo($url);
        }
        
        return null;
    }
}
?>
