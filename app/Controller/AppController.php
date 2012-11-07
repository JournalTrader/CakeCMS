<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller 
{
    const TYPE_SUCCESS = 0;
    
    const TYPE_INFO = 1;
    
    const TYPE_WARNING = 2;
    
    const TYPE_ERROR = 3;
    
    public $components = array( 
        'Session',
        'Acl',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'username' => 'mail',
                        'password' => 'password'
                    )
                )
            ),
            'loginAction' => array(
                'public' => true,
                'plugin' => 'user',
                'controller' => 'user',
                'action' => 'login'
            ),
            'userModel' => 'User.User'
        )        
    );
    
    public $uses = array(
        'Option',
        'Module.Plugin',
        'Acl.Group'
    );
    
    public $helpers = array(
        'Block.Block',
        'Tools'
    );
    
    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);
        
//        Router::connect('/', array(
//            'prefix' => 'public',
//            'plugin' => 'blog',
//            'controller' => 'article',
//            'action' => 'index'
//        ));
    }
    
    public function beforeFilter()
    {      
//        $this->initAcl();
//        $this->Auth->logout();
        
        $this->Auth->allow('*');
        $this->layout = strtolower($this->params['prefix']);
        
        if(empty($this->layout))
        {
            $this->layout = 'public';
        }
        
        switch($this->params['prefix'])
        {
            case 'manager':
                break;
            default:
        }
        
        $this->setOptions();
    }
    
    public function setOptions()
    {
        $this->set('option', $this->Option);
    }
    
    /**
     * Permet de verifier les permission
     * @return type
     */
    private function initAcl()
    {
        $params = $this->request->params;
        
        if($params['plugin'] == 'block')
        {
            $this->Auth->allow('*');
            return;
        }
        
        $aAction = explode('_', $params['action']);
        
        unset($aAction[0]);
        $action = implode('_', $aAction);
        
        $aPlugin = $this->Plugin->find('first', array(
            'conditions' => array(
                'prefix' => $params['prefix'],
                'plugin' => $params['plugin'],
                'controller' => $params['controller'],
                'action' => $action
            )
        ));
        
        $aAco = array(
            'Aco' => array(
                'model' => 'Plugin',
                'foreign_key' => (int) $aPlugin['Plugin']['id']
            )
        );
        
        $aAro = $this->Acl->Aro->find('first', array(
            'recursive' => '-1',
            'conditions' => array(
                'Aro.model' => 'Group',
                'Aro.foreign_key' => 3
            )
        ));
        
        if($this->Acl->check($aAro['Aro'], $aAco['Aco']))
        {
            $this->Auth->allow('*');
        } else {
            $this->Auth->loginRedirect;
        }
    }
    public function beforeRender() 
    {
        parent::beforeRender();
        $params = $this->request->params;
        
        if($this->layout == 'public' || $this->layout == 'manager' && $this->name != 'CakeError')
        {
            $this->viewPath = $this->viewPath . DS . 'Default';
        }
    }
}
