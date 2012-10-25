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
        'User.Profile'
    );
    
    public function manager_index()
    {
        $aUsers = $this->User->find('all', array(
            'contain' => array(
                'Profile',
                'Groupe'
            )
        ));
        
        $this->set('aUsers', $aUsers);
    }
    
    public function manager_add()
    {
        $isEdit = false;
        $params = $this->request->params;
        
        if(!empty($params['named']['id']))
        {
            $ex = explode('_', $params['named']['id']);
            
            $iId = $ex[1];
            
            $aUser = $this->User->getById($iId);
            
            if(!empty($aUser))
            {
                $isEdit = true;
            }
        }
        
        if (!empty($this->data)) 
        {         
            $data = $this->data;
            
            $aUser = $this->User->find('all', array(
                'fields' => array(
                    'id'
                )
            ));
            
            if($this->User->save($this->data))
            {        
                $profile['Profile'] = $this->data['Profile'];
                
                if (empty($profile['Profile']['users_id'])) 
                {
                    $profile['Profile']['users_id'] = $this->User->id;
                }
                
                if($this->Profile->save($profile))
                {
                    $this->Session->setFlash("Les données sont mises à jours !", 'alert');
                    $this->redirect($this->referer());
//                    debug(md5('nickleus'));
                }
            }
        }
        
        if($isEdit)
        {
            $this->set('isEdit', $isEdit);
            $this->set('aUser', $aUser);
        }
    }
    
    public function login()
    {
        if(!empty($this->data))
        {
            $aUser = $this->User->find('first', array(
                'contain' => array(
                    'Profile'
                ),
                'conditions' => array(
                    'mail' => $this->data['User']['mail'],
                    'password' => $this->Auth->password($this->data['User']['password'])
                )
            ));
            
            if(!empty($aUser))
            {
                $aUser['User']['last_login'] = date('Y-m-d H:i:s');
                
                $this->Auth->login($aUser);
                $this->redirect($this->Auth->loginRedirect);
            }
        }
    }
    
    public function manager_logout() 
    {
        $this->Auth->logout();
        $this->redirect($this->Auth->loginAction);
    }
    
    public function block_vertical_login()
    {
        
    }   
}

?>
