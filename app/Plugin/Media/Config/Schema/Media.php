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
class MediaSchema extends CakeSchema
{
    public $name = 'media';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) {
    }

    public $media = array(
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
        'src' => array(
            'type' => 'string', 
            'null' => true,
            'default' => null,
            'length' => 255
        ),
        'type' => array(
            'type' => 'string', 
            'null' => true,
            'default' => null,
            'length' => 50
        ),
        'cateogry' => array(
            'type' => 'string', 
            'null' => true,
            'default' => null,
            'length' => 50
        ),
        'location' => array(
            'type' => 'string', 
            'null' => true,
            'default' => null,
            'length' => 50
        ),
        'description' => array(
            'type' => 'text', 
            'null' => true,
            'default' => null
        ),
        'size' => array(
            'type' => 'integer', 
            'null' => true, 
            'default' => null, 
            'length' => 10
        ),
        'created' => array(
            'type' => 'datetime',
            'null' => false, 
            'default' => null
        ),
        'modified' => array(
            'type' => 'datetime',
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
