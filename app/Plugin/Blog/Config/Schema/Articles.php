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
class ArticlesSchema extends CakeSchema
{
    public $name = 'articles';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) {
    }

    public $articles = array(
        'id' => array(
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
