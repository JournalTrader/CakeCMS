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
class MenusSchema extends CakeSchema
{
    public $name = 'menus';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) {
    }

    public $menus = array(
        'id' => array(
            'type' => 'integer', 
            'null' => false, 
            'default' => null, 
            'length' => 10, 
            'key' => 'primary'
        ),
        'name' => array(
            'type' => 'string', 
            'null' => true,
            'default' => null,
            'length' => 50
        ),
        'blocks_id' => array(
            'type' => 'integer', 
            'null' => true, 
            'default' => null, 
            'length' => 10,
            'key' => 'primary'
        ),
        'plugins_id' => array(
            'type' => 'integer', 
            'null' => true, 
            'default' => null, 
            'length' => 10,
            'key' => 'primary'
        ),
        'articles_id' => array(
            'type' => 'integer', 
            'null' => true, 
            'default' => null, 
            'length' => 10,
            'key' => 'primary'
        ),
        'order' => array(
            'type' => 'integer', 
            'null' => true, 
            'default' => null, 
            'length' => 10
        ),
        'is_active' => array(
            'type' => 'integer', 
            'null' => true, 
            'default' => null, 
            'length' => 1
        ),
        'parent_id' => array(
            'type' => 'integer', 
            'null' => true, 
            'default' => null, 
            'length' => 10,
            'key' => 'primary'
        ),
        'lft' => array(
            'type' => 'integer', 
            'null' => true, 
            'default' => null, 
            'length' => 10
        ),
        'rght' => array(
            'type' => 'integer', 
            'null' => true, 
            'default' => null, 
            'length' => 10
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
