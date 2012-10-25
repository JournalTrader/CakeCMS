<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserComponent
 *
 * @author nicolasmoricet
 */
class UserLogingComponent extends Object
{     
    public function initialize(&$controller, $settings = array())
    {
        $this->controller =& $controller;
    }
    
    function startup(&$controller)
    {
        $params = $this->controller->request->params;
        
        $groupe_id = $this->controller->Auth->user('User.groupes_id');

        $action = explode('_', $params['action']);
        
        if(count($action) == 1)
        {
            $action = $action[0];
        } else {
            $action = $action[1];
        }
        
        $aPlugin =  $this->controller->Plugin->find('first', array(
            'fields' => array(
                'id'
            ),
            'conditions' => array(
                'plugin' => $params['plugin'],
                'controller' => $params['controller'],
                'action' => $action
            )
        ));
        
        
        if(!empty($aPlugin) && !empty($groupe_id))
        {   
            $check = $this->controller->Acl->check(array(
                'model' => 'Groupe',
                'foreign_key' => $groupe_id
            ), array(
                'model' => 'Plugin',
                'foreign_key' => $aPlugin['Plugin']['id']
            ));
            
            if (!$check) 
            {
                $this->controller->Session->setFlash("Vous ne pouvez pas accéder à cette page !", 'alert', array(
                    'type' => AppController::TYPE_WARNING
                ));
                $this->controller->redirect('/');
            }
        }
    }
    
    function beforeRender(&$controller) { }
    
    function shutdown(&$controller) { }
    
    function beforeRedirect(&$controller, $url, $status=null, $exit=true) { }
    
    function redirectSomewhere($value) { }
}

?>
