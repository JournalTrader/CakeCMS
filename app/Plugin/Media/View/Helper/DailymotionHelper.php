<?php App::import('Helper', 'Html'); 

class DailymotionHelper extends HtmlHelper
{
    var $apis = array( 
        'data'  => 'https://api.dailymotion.com/video/%s', // Location of dailymotion images 
        'image'  => 'http://www.dailymotion.com/thumbnail/video/%s', // Location of dailymotion images 
        'player' => 'http://www.dailymotion.com/video/%s'   // Location of dailymotion player 
    );
    
    public function thumbnail($url, $options)
    {
        $video_id = $this->getVideoId($url);
        
        $image_url = sprintf($this->apis['image'], $video_id); 
        
        return $this->image($image_url, $options);
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
    
    public function getData($url)
    {
        $video_id = $this->getVideoId($url);
    }
    
    public function getUrlThumbnail($url)
    {
        $size = 'small';
        
        $video_id = $this->getVideoId($url);
        
        return sprintf($this->apis['image'], $video_id); 
    }
}

?>
