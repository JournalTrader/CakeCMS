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
    
    public function menu($alias, $options = array('type' => 'horizontal-nav-bar'))
    {
        return $this->requestMethod($alias, 'menu', $options);
    }
    
    public function element($alias)
    {
        return $this->requestMethod($alias, 'element');
    }
    
    private function requestMethod($alias, $type, $options = array())
    {
        $params = $this->request->params;
//        debug($params);
        $named = array(
            'alias' => $alias,
            'options' => $options,
            'rPrefix' => $params['prefix'],
            'rPlugins' => $params['plugin'],
            'rController' => $params['controller'],
            'rAction' => $params['action'],
        );
        
        $named += $params['named'];
        
        return $this->requestAction(array(
            'block' => true,
            'plugin' => 'block',
            'controller' => 'block',
            'action' => $type
        ), array(
            'return',
            'named' => $named,
            'pass' => $params['pass'],
            'id' => (isset($params['id'])) ? $params['id']:null,
            'slug' => (isset($params['slug'])) ? $params['slug']:null
        ));
    }
}

?>
