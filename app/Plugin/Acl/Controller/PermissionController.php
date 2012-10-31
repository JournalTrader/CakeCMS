<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PermissionController
 *
 * @author nicolasmoricet
 */
class PermissionController extends AclAppController
{
    public $uses = array(
        'Module.Module',
        'Acl.Group'
    );
    
    public function manager_index()
    {
        $aModules = $this->Module->findModules(array(
            'Plugin' => array(
                'ChildPlugin'
            )
        ));
        
        $aGroups = $this->Group->find('all');
        
        $this->set('aModules', $aModules);
        $this->set('aGroups', $aGroups);
        
        if (!empty($this->data)) 
        {
            debug($this->data);
        }
    }
    
    public function manager_add()
    {
        
    }
}

?>
