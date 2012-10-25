<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database
 *
 * @author nicolasmoricet
 */
class DATABASE_CONFIG 
{
    public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => 'root',
        'database' => 'altal',
        'prefix' => '',
        'encoding' => 'UTF8',
        'port' => ''
    );

    public function __construct()
    {
        switch ($_SERVER['SERVER_ADDR'])
        {
            case '127.0.0.1':
                $this->default = $this->default;
                break;
        }
    }
}

?>
