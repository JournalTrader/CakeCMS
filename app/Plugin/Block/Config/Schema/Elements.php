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
class ElementsSchema extends CakeSchema
{
    public $name = 'elements';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) {
    }

    public $elements = array(
        'id' => array(
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
            'length' => 100
        ),
        'plugins_id' => array(
            'type' => 'integer', 
            'null' => false, 
            'default' => null, 
            'length' => 10
        ),
        'blocks_id' => array(
            'type' => 'integer', 
            'null' => false, 
            'default' => null, 
            'length' => 10,
        ),
        'display' => array(
            'type' => 'integer', 
            'null' => false, 
            'default' => null, 
            'length' => 10
        ),
        'display_absolute' => array(
            'type' => 'boolean', 
            'null' => false, 
            'default' => null
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
