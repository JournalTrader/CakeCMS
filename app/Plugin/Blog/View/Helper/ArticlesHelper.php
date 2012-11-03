<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticlesHelper
 *
 * @author Admin
 */
class ArticlesHelper extends AppHelper
{
    public $helpers = array(
        'Text'
    );
    
    public function extract($content)
    {
        $content = $this->Text->truncate(strip_tags($content), 255, array(
            'ending' => '...',
            'exact' => false
        ));
        
        return $content;
    }
    
    public function content($content)
    {
        $find = preg_match_all("#{%(.*)%}#", $content, $out, PREG_PATTERN_ORDER);
        
        if($find)
        {
            foreach($out[1] as $link)
            {
                debug($link);
            }
        }
        
        return $content;
    }
}

?>
