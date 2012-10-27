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
class ProfilesSchema extends CakeSchema
{
    public $name = 'profiles';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) {
    }

    public $profiles = array(
        'id' => array(
            'type' => 'integer', 
            'null' => false, 
            'default' => null, 
            'length' => 10, 
            'key' => 'primary'
        ),
        'users_id' => array(
            'type' => 'integer', 
            'null' => false, 
            'default' => null, 
            'length' => 10, 
            'key' => 'primary'
        ),
        'last_name' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 50
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
