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
class UsersSchema extends CakeSchema
{
    public $name = 'users';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) {
    }

    public $users = array(
        'id' => array(
            'type' => 'integer', 
            'null' => false, 
            'default' => null, 
            'length' => 10, 
            'key' => 'primary'
        ),
        'groupes_id' => array(
            'type' => 'integer', 
            'null' => false, 
            'default' => null, 
            'length' => 10
        ),
        'mail' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 255
        ),
        'password' => array(
            'type' => 'string', 
            'null' => false,
            'default' => null,
            'length' => 50
        ),
        'last_login' => array(
            'type' => 'datetime', 
            'null' => false, 
            'default' => null
        ),
        'last_activity' => array(
            'type' => 'datetime', 
            'null' => false, 
            'default' => null
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
