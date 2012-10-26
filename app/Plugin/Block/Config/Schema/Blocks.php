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
class BlocksSchema extends CakeSchema
{
    public $name = 'blocks';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) {
    }

    public $blocks = array(
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
        'alias' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 100
        ),
        'type' => array(
            'type' => 'string', 
            'null' => true,
            'default' => null,
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
