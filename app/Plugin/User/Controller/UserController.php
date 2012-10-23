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
    
    public function beforeFilter() 
    {
        parent::beforeFilter();
        
//        $this->Auth->allow('*');
    }
    
    public function manager_index()
    {
        $aUsers = $this->User->find('all', array(
            'contain' => array(
                'Profile'
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
        
    }
    
    public function block_vertical_login()
    {
        
    }
}

?>
