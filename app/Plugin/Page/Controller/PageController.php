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
class PageController extends PageAppController
{
    public function manager_index()
    {
        $aPages = $this->Page->find('all');
        
        $this->set('aPages', $aPages);
    }
    
    public function manager_add()
    {
        if (!empty($this->data)) 
        {
            $this->Page->save($this->data);
        }
        
        $this->set('aParents', $this->Page->getParentsPages());
    }
    
    public function index()
    {
        
    }
}

?>
