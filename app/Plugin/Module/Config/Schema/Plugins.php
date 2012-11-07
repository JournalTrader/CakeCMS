<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author nicolasmoricet
 */
class PluginsSchema extends CakeSchema
{
    public $name = 'plugins';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) {
    }

    public $plugins = array(
        'id' => array(
            'type' => 'integer', 
            'null' => false, 
            'default' => null, 
            'length' => 10, 
            'key' => 'primary'
        ),
        'parent_id' => array(
            'type' => 'integer', 
            'null' => false, 
            'default' => null, 
            'length' => 10
        ),
        'name' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 50
        ),
        'prefix' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 50
        ),
        'plugin' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 50
        ),
        'controller' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 50
        ),
        'action' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 50
        ),
        'is_main' => array(
            'type' => 'boolean', 
            'null' => false,
            'default' => 0,
            'length' => 50
        ),
        'is_active' => array(
            'type' => 'boolean', 
            'null' => false,
            'default' => 0,
            'length' => 50
        ),
        'indexes' => array(
            'PRIMARY' => array(
                'column' => 'id', 
                'unique' => 1
            )
        ),
        'tableParameters' => array(
            'charset' => 'utf8', 
            'collate' => 'utf8_general_ci', 
            'engine' => 'InnoDB'
        )
    );
}

?>
