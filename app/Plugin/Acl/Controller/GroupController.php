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
        $aGroups = $this->Group->find('all', array(
            'contain' => array(
                'GroupChild'
            ),
            'conditions' => array(
                'parent_id' => 0
            )
        ));
        
        $this->set('aGroups', $aGroups);
    }
    
    public function manager_add()
    {
        $isEdit = false;
        $params = $this->request->params;
        
        if(!empty($params['named']['id']))
        {
            $aGroup = $this->Group->getById($params['named']['id']);
            
            if (!empty($aGroup)) 
            {
                $isEdit = true;
            }
        }
        
        $this->set('title', "Ajout d'un groupe utilisateur");
        
        if(!empty($this->data))
        {
            if($this->Group->save($this->data))
            {
                $this->Session->setFlash("Le groupe est enregistré !", 'alert');
                $this->redirect(array(
                    'manager' => true,
                    'plugin' => 'acl',
                    'controller' => 'group',
                    'action' => 'index'
                ));
            }
        }
        
        $aGroups = $this->Group->getForSelect();
        
        $this->set('aGroups', $aGroups);
        
        if($isEdit)
        {
            $this->set('isEdit', $isEdit);
            $this->set('aGroup', $aGroup);
        }
    }
}

?>
