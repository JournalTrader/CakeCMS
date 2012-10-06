<?php 

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author nicolasmoricet
 */
class BlockController extends BlockAppController
{
    public function manager_index()
    {
        $this->set('title', "Gestionnaire de blocks");
        
        $aMenus = $this->Block->getAllMenus();
        $aElements = $this->Block->getAllElements();
        
        $this->set('aMenus', $aMenus);
        $this->set('aElements', $aElements);
    }
}

?>
