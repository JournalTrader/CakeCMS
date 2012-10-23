<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PictureHelper
 *
 * @author Admin
 */
class MediaHelper extends AppHelper
{
    public $helpers = array(
        'Html',
        'Media.Video'
    );
    
    public function getUrl($url, $opt = 'picture')
    {
        switch ($opt)
        {
            case 'picture';
                $newUrl = $this->Video->getUrlThumbnail($url);
                break;
            case 'video';
                $newUrl = $this->Video->getUrlVideo($url);
                break;
        }
        
        
        if(is_null($newUrl))
        {
            $newUrl = $url;
        }
        
        return $newUrl;
    }
    
    public function pictureFile($media, $width, $height, $options)
    {
        $img = '';
        
        switch ($media['Media']['type'])
        {
            case 'pdf':
                $img = $this->Html->image('Media.pdf-128-128.png', array(
                    'alt' => 'Fichier PDF',
                    'class' => $options['class'],
                    'width' => $width
                ));
                break;
            case 'zip':
                $img = $this->Html->image('Media.zip-128-128.png', array(
                    'alt' => 'Fichier ZIP',
                    'class' => $options['class'],
                    'width' => $width
                ));
                break;
            case 'rar':
                $img = $this->Html->image('Media.rar-128-128.png', array(
                    'alt' => 'Fichier RAR',
                    'class' => $options['class'],
                    'width' => $width
                ));
                break;
            case 'mp4':
            case 'avi':
            case 'flv':
                $img = $this->Html->image('Media.video-128-128.png', array(
                    'alt' => 'Fichier Video',
                    'class' => $options['class'],
                    'width' => $width
                ));
                break;
        }
        
        return $img;
    }
    
    public function getPictureUrl($url)
    {
        $url = $this->getUrl($url);
        
        if(substr($url, 0, 7) == 'webroot')
        {
            return substr($url, 7);
        }
        
        return $url;
    }
    
    public function picture($media, $width, $height = null, $options)
    {
        $options['width'] = $width;
        
        if($media['Media']['location'] == 'local')
        {
            $exPath = explode(DS, $media['Media']['src']);
            $exFileName = explode('.', end($exPath));
            $ext = end($exFileName);
            
            unset($exFileName[count($exFileName) - 1]);
            unset($exPath[count($exPath) - 1]);
            
            $fileName = implode('.', $exFileName);
            
            $newPath = implode(DS, $exPath);
            
            unset($exPath[0]);
            $relativePath = '/' . implode('/', $exPath);
            
            $newPath = APP . $newPath;
            
            $newFileName = $this->setFileName(APP . DS . $media['Media']['src'], $width);
            
            if(!file_exists($newPath . DS . $newFileName))
            {
                $this->thumbnail(APP . $media['Media']['src'], $newPath, $fileName, $width);
            }
            
            $src = $relativePath . '/' . $newFileName;
            
        } else {
            $src = $this->getUrl($media['Media']['src']);
        }
        
        return $this->Html->image($src, $options);
    }
    
    public function heightRatioSize($size, $width)
    {
        $height = null;
        
        $ratio = (($width * 100)/$size[0]);
        $height = (is_null($height)) ? (($size[1] * $ratio)/100):$height;
        $height = floor($height);
        
        return $height;
    }

    public function setFileName($picture, $width, $height = null)
    {
        $exPath = explode(DS, $picture);
        $exFileName = explode('.', end($exPath));
        $ext = end($exFileName);
        unset($exFileName[count($exFileName) - 1]);
        
        $fileName = implode('.', $exFileName);
        
        $size = getimagesize($picture);
        
        if(is_null($height))
        {
            $height = $this->heightRatioSize($size, $width);
        }
        
        return $fileName . '-' . $width . '-' . $height . '.' . $ext;
    }
    
    /**
     *
     * @param type $picture - Chemin de l'image
     * @param type $path - Chemin de sauvegarde
     * @param type $name - Nom de la nouvelle image
     * @param type $width - largeur
     * @param type $height - hauter
     * @return boolean 
     */
    public function thumbnail($picture, $path, $name, $width = 100, $height = null, $autoRename = true)
    {
//        chmod($path, 0777);
        $ext = null;
        // On supprime l'extension du nom
        // $name = substr($name,0,-4);
        // 
        // On récupère les dimensions de l'image
        $size = getimagesize($picture);
        
        $ex = explode('.', strtolower($picture));
        $ext = end($ex);
        
        // On crer une image à partir du fichier récupéré
        switch($ext)
        {
            case 'jpeg':
            case 'jpg':
                $pict = imagecreatefromjpeg($picture);
                break;
            case 'png':
                $pict = imagecreatefrompng($picture);
                break;
            case 'gif':
                $pict = imagecreatefromgif($picture);
                break;
            default:
                return false;
        }
        
        $height = $this->heightRatioSize($size, $width);
        
        // Création des miniatures
        // On crer une image vide de la largeur et hauteur voulue
        $thumbnail = imagecreatetruecolor($width, $height); 
        
        // On va gérer la position et le redimensionnement de la grande image
        if($size[0] > ($width/$height) * $size[1] )
        { 
            $dimY = $height; 
            $dimX= $height * $size[0]/$size[1]; 
            $decalX = -($dimX - $height)/2; 
            $decalY = 0;
        }
        
        if($size[0] < ($width/$height) * $size[1])
        { 
            $dimX = $width; 
            $dimY = $height * $size[1]/$size[0]; 
            $decalY = -($dimY - $height)/2; 
            $decalX = 0;
        }
        
        if($size[0] == ($width/$height) * $size[1])
        { 
            $dimX = $width; 
            $dimY = $height; 
            $decalX = 0; 
            $decalY = 0;
        }
        
        $black = imagecolorallocate($pict, 0, 0, 0);
        
        imagecolortransparent($pict, $black);
        
        // on modifie l'image crée en y plaçant la grande image redimensionnée et décalée
        imagecopyresampled($thumbnail, $pict, $decalX, $decalY, 0, 0, $dimX, $dimY, $size[0], $size[1]);
        
        /**
         * Si le nom automatique est activé... 
         */
        if($autoRename === true)
        {
            $name = $name . '-' . $width . '-' . $height;
        }
        
        switch($ext)
        {
            case 'jpg':
            case 'jpeg':
                imagejpeg($thumbnail, $path . DS . $name . '.' . $ext, 90);
                break;
            case 'png':
                imagepng($thumbnail, $path . DS . $name . '.' . $ext, 90);
                break;
            case 'gif':
                imagegif($thumbnail, $path . DS . $name . '.' . $ext, 90);
                break;
        }
        
        
        /**
         * Libération de la memoire 
         */
        imagedestroy($thumbnail);
        
        return array(
            'filename' => $name . '.jpg'
        );
    }
}

?>
