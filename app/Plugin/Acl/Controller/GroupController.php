<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupController
 *
 * @author Admin
 */
class GroupController extends AclAppController
{
    public function manager_index()
    {

    }
    
    public function manager_add()
    {
        $this->set('title', "Ajout d'un groupe utilisateur");
        
        $aGroups = $this->Group->getForSelect();
        
        $this->set('aGroups', $aGroups);
    }
}

?>
