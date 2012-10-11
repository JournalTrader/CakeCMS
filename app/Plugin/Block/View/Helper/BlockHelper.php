<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlockHelper
 *
 * @author Admin
 */
class BlockHelper extends AppHelper
{
    public $uses = array(
        'Block.Block'
    );
    
    public function menu($alias)
    {
        return $this->requestMethod($alias, 'menu');
    }
    
    public function element($alias)
    {
        return $this->requestMethod($alias, 'element');
    }
    
    private function requestMethod($alias, $type)
    {
        $params = $this->request->params;
        
        $named = array(
            'alias' => $alias,
            'rPrefix' => $params['prefix'],
            'rPlugins' => $params['plugin'],
            'rController' => $params['controller'],
            'rAction' => $params['action']
        );
        
        $named += $params['named'];
        
        return $this->requestAction(array(
            'block' => true,
            'plugin' => 'block',
            'controller' => 'block',
            'action' => $type
        ), array(
            'return',
            'named' => $named
        ));
    }
}

?>
