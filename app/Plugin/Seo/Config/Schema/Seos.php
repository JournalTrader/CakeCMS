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
class SeosSchema extends CakeSchema
{
    public $name = 'seos';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) {
    }

    public $seos = array(
        'id' => array(
            'type' => 'integer', 
            'null' => false, 
            'default' => null, 
            'length' => 10, 
            'key' => 'primary'
        ),
        'slug' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 255
        ),
        'title' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 255
        ),
        'keywords' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 255
        ),
        'description' => array(
            'type' => 'text', 
            'null' => true,
            'default' => null
        ),
        'table_id' => array(
            'type' => 'string', 
            'null' => false,
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
