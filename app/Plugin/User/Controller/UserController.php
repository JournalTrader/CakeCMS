<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author nicolasmoricet
 */
class UserController extends UserAppController 
{
    public $uses = array(
        'User.User',
        'User.Profile',
        'Acl.Group'
    );
    
    public function public_login($data = null)
    {
        if (!empty($this->data)) 
        {
            debug($this->data);
        }
        
//        debug($this->Session->read('Auth.User'));
    }
    
    public function manager_index()
    {
        
    }
    
    public function manager_add()
    {
        $isEdit = false;
        $params = $this->request->params;
        
        if(!empty($params['named']['id']))
        {
            $aUser = $this->User->getById($params['named']['id']);
            
            if(!empty($aUser))
            {
                $isEdit = true;
            }
        }
        
        if(!empty($this->data))
        {
            if($this->User->save($this->data))
            {
                $aProfile['Profile'] = $this->data['Profile'];
                $aProfile['Profile']['users_id'] = $this->User->id;
                
                if ($this->Profile->save($aProfile)) 
                {
                    $this->Session->setFlash("L'utilisateur est sauvegardé !", 'alert');
                    $this->redirect(array(
                        'manager' => true,
                        'plugin' => 'user',
                        'controller' => 'user',
                        'action' => 'index'
                    ));
                }
            }
        }
        
        $aGroups = $this->Group->getForSelect();
        
        $this->set('aGroups', $aGroups);
        
        if($isEdit)
        {
            $this->set('isEdit', $isEdit);
            $this->set('aUser', $aUser);
        }
    }
}

?>
