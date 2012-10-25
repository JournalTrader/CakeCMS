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
        'Acl',
        'Auth' => array(
            'loginAction' => array(
                'plugin' => 'user',
                'controller' => 'user',
                'action' => 'login',
                'manager' => false
            ),
            'loginRedirect' => '/',
            'logoutRedirect' => array(
                'plugin' => 'user',
                'controller' => 'user',
                'action' => 'login',
                'manager' => false
            )
        ),
        'Session',
        'User.UserLoging'
    );
    
    public $uses = array(
        'Option',
        'Module.Plugin',
    );
    
    public $helpers = array(
        'Block.Block',
        'Tools'
    );
    
    public function beforeFilter()
    {       
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
    }
}
