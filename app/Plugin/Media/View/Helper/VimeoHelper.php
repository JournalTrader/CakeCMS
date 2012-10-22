<?php App::import('Helper', 'Html'); 

class VimeoHelper extends HtmlHelper 
{
    private $apis = array( 
        'data'  => 'http://vimeo.com/api/v2/video/%s.json', // Location of vimeo images 
        'image'  => 'http://vimeo.com/api/v2/video/%s.php', // Location of vimeo images 
        'player' => 'http://player.vimeo.com/video/video/%s'   // Location of vimeo player 
    );
    
    private $thumbnail = array(
        'small' => 'thumbnail_small',
        'medium' => 'thumbnail_medium',
        'large' => 'thumbnail_large'
    );
    
    public function thumbnail($url, $options)
    {
        $size = isset($options['size']) ? $options['size']:'small';
        
        $video_id = $this->getVideoId($url);
        
        $data = $this->getDatas($video_id);
        
        $data = $data[0];
        
        return $this->image($data[$this->thumbnail[$size]], $options);
    }
    
    public function video($url)
    {
        
    }
    
    public function getVideoId($url)
    {
        $path = parse_url($url, PHP_URL_PATH);
        
        $ex = explode('/', $path);
        $key = end($ex);
        
        return $key;
    }
    
    public function getDatas($video_id)
    {
        $dataUrl = sprintf($this->apis['data'], $video_id);
        $hash = json_decode(file_get_contents($dataUrl));
        
        return $hash[0];
    }
    
    public function getUrlThumbnail($url)
    {      
        $size = 'small';
        $video_id = $this->getVideoId($url);
        
        $data = $this->getDatas($video_id);
        
        return $data->{$this->thumbnail[$size]};
    }
}

?>
