<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PagesController
 *
 * @author nicolasmoricet
 */
class PagesController extends PagesAppController
{
    public function manager_index()
    {
        
    }
    
    public function manager_add()
    {
        if (!empty($this->data)) 
        {
            debug($this->data);
        }
        
        $this->set('aParents', $this->Page->getParentsPages());
    }
    
    public function index()
    {
        
    }
}

?>
