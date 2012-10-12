<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Groups
 *
 * @author Admin
 */
class GroupsSchema extends CakeSchema
{
    public $name = 'groups';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) {
    }

    public $groups = array(
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
            'length' => 255
        ),
        'order' => array(
            'type' => 'integer', 
            'null' => false, 
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