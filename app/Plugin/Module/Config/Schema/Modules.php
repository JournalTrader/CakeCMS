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
class ModulesSchema extends CakeSchema
{
    public $name = 'modules';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) {
    }

    public $modules = array(
        'id' => array(
            'type' => 'integer', 
            'null' => false, 
            'default' => null, 
            'length' => 10, 
            'key' => 'primary'
        ),
        'plugins_id' => array(
            'type' => 'integer', 
            'null' => false, 
            'default' => null, 
            'length' => 10, 
            'key' => 'primary'
        ),
        'name' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 50
        ),
        'description' => array(
            'type' => 'text', 
            'null' => true,
            'default' => null
        ),
        'author' => array(
            'type' => 'string', 
            'null' => true,
            'default' => null,
            'length' => 50
        ),
        'version' => array(
            'type' => 'string', 
            'null' => true,
            'default' => null,
            'length' => 50
        ),
        'site' => array(
            'type' => 'string', 
            'null' => true,
            'default' => null,
            'length' => 50
        ),
        'url' => array(
            'type' => 'string', 
            'null' => true,
            'default' => null,
            'length' => 50
        ),
        'core' => array(
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
