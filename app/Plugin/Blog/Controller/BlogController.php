<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlogController
 *
 * @author nicolasmoricet
 */
class BlogController extends BlogAppController
{
//    public $uses = array(
//        'Blog.Article'
//    );
    
    public function manager_index()
    {
        $this->set('title', "Gestion du blog");
        
    }
}

?>
