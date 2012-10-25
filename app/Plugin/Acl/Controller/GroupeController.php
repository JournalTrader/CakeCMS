<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupeController
 *
 * @author nicolasmoricet
 */
class GroupeController extends AclAppController
{
    public function manager_index()
    {
        $aGroupes = $this->Groupe->find('all', array(
            'order' => array(
                'order' => 'ASC'
            )
        ));
        
        $this->set('aGroupes', $aGroupes);
    }
    
    public function manager_add()
    {
        $isEdit = false;
        $params = $this->request->params;
        
        if(!empty($params['named']['id']))
        {
            $ex = explode('_', $params['named']['id']);
            $iId = end($ex);
            
            $aGroupe = $this->Groupe->getById($iId);
            
            if(!empty($aGroupe))
            {
                $isEdit = true;
            }
        }
        
        if(!empty($this->data))
        {
            if($this->Groupe->save($this->data))
            {
                $this->Session->setFlash("Le groupe est enregistré !", 'alert');
                $this->redirect(array(
                    'manager' => true,
                    'plugin' => 'acl',
                    'controller' => 'groupe',
                    'action' => 'index'
                ));
            }
        }
        
        if($isEdit)
        {
            $this->set('isEdit', $isEdit);
            $this->set('aGroupe', $aGroupe);
        }
    }
    
    public function ajax_orderingUpdate()
    {
        $error = false;
        
        if(!empty($this->data))
        {
            foreach($this->data['Groupe'] as $order => $id)
            {
                $data = array();

                $data = $this->Groupe->find('first', array(
                    'conditions' => array(
                        'id' => $id['id']
                    )
                ));
                
                $data['Groupe']['order'] = $order + 1;
                
                $this->Groupe->create();
                
                if(!$this->Groupe->save($data, false))
                {
                    $error = true;
                }
            }
        
            if(!$error)
            {
                echo json_encode(array(
                    'message' => "Ordre sauvegardé !",
                    'error' => AppController::TYPE_SUCCESS
                ));
            } else {
                echo json_encode(array(
                    'message' => "L'ordre n'est pas correctement enregistré !",
                    'error' => AppController::TYPE_WARNING
                ));
            }
        }
        
        return $this->render(false);        
    }
    
    public function block_permission()
    {
        $aGroupes = $this->Groupe->find('all');
        
        $this->set('aGroupes', $aGroupes);        
    }
}

?>
