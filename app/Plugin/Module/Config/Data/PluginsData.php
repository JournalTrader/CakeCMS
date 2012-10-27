<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModulesData
 *
 * @author Admin
 */
class PluginsData 
{
    public $table = 'plugins';
    
    public $records = array(
        array(
            'id' => '1',
            'name' => 'Manager Module Index',
            'prefix' => 'manager',
            'plugin' => 'module',
            'controller' => 'module',
            'action' => 'index',
            'parent_id' => '0',
            'is_main' => true,
            'is_active' => true
        ),    
        array(
            'id' => '2',
            'name' => 'Manager Module Installer',
            'prefix' => 'manager',
            'plugin' => 'module',
            'controller' => 'module',
            'action' => 'installer',
            'parent_id' => 1,
            'is_main' => false,
            'is_active' => true
        ),    
        array(
            'id' => '3',
            'name' => 'Manager Module Uninstall',
            'prefix' => 'manager',
            'plugin' => 'module',
            'controller' => 'module',
            'action' => 'uninstall',
            'parent_id' => 1,
            'is_main' => false,
            'is_active' => true
        ),    
        array(
            'id' => '4',
            'name' => 'Manager Module Activate',
            'prefix' => 'ajax',
            'plugin' => 'module',
            'controller' => 'module',
            'action' => 'activate',
            'parent_id' => 1,
            'is_main' => false,
            'is_active' => true
        ),    
        array(
            'id' => '5',
            'name' => 'Manager Blocks Index',
            'prefix' => 'manager',
            'plugin' => 'block',
            'controller' => 'block',
            'action' => 'index',
            'parent_id' => 0,
            'is_main' => true,
            'is_active' => true
        ),    
        array(
            'id' => '6',
            'name' => 'Manager Blocks Add',
            'prefix' => 'manager',
            'plugin' => 'block',
            'controller' => 'block',
            'action' => 'add',
            'parent_id' => 5,
            'is_main' => false,
            'is_active' => true
        ),    
        array(
            'id' => '7',
            'name' => 'Manager Menu Index',
            'prefix' => 'manager',
            'plugin' => 'menu',
            'controller' => 'menu',
            'action' => 'index',
            'parent_id' => 0,
            'is_main' => true,
            'is_active' => true
        ),    
        array(
            'id' => '8',
            'name' => 'Manager Menu Add',
            'prefix' => 'manager',
            'plugin' => 'menu',
            'controller' => 'menu',
            'action' => 'add',
            'parent_id' => 7,
            'is_main' => false,
            'is_active' => true
        )    
    );    
}

?>
