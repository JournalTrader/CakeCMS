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
        $params = $this->request->params;
        
        return $this->requestAction(array(
            'block' => true,
            'plugin' => 'block',
            'controller' => 'block',
            'action' => 'menu'
        ), array(
            'return',
            'named' => array(
                'alias' => $alias,
                'rPrefix' => $params['prefix'],
                'rPlugins' => $params['plugin'],
                'rController' => $params['controller'],
                'rAction' => $params['action']
            )
        ));
    }
}

?>
