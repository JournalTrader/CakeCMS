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
class PagesSchema extends CakeSchema
{
    public $name = 'pages';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) {
    }

    public $pages = array(
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
            'length' => 10, 
            'key' => 'primary'
        ),
        'title' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 255
        ),
        'content' => array(
            'type' => 'text', 
            'null' => true,
            'default' => null
        ),
        'status' => array(
            'type' => 'boolean', 
            'null' => true,
            'default' => 0
        ),
        'created' => array(
            'type' => 'datatime',
            'null' => false, 
            'default' => null
        ),
        'modified' => array(
            'type' => 'datatime',
            'null' => false, 
            'default' => null
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
