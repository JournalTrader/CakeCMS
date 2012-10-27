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
class TermsSchema extends CakeSchema
{
    public $name = 'terms';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) {
    }

    public $terms = array(
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
        'title' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 255
        ),
        'type' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 50
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
