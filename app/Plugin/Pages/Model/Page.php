<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Page
 *
 * @author nicolasmoricet
 */
class Page extends PagesAppModel
{
    public $actsAs = array(
        'Containable',
        'Tree'
    );
    
    public function getParentsPages()
    {
        $aPages = array(
            0 => 'Choisir une page'
        );
        
        return $aPages;
    }
}

?>
