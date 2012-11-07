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
class OptionsSchema extends CakeSchema
{
    public $name = 'options';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) {
    }

    public $options = array(
        'key' => array(
            'type' => 'string', 
            'null' => false, 
            'default' => null, 
            'length' => 255, 
            'key' => 'primary'
        ),
        'value' => array(
            'type' => 'text', 
            'null' => false,
            'default' => null
        ),
        'indexes' => array(
            'PRIMARY' => array(
                'column' => 'key', 
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
