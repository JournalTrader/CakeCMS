<?php

class DATABASE_CONFIG {
    public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => 'root',
        'database' => 'metaflex',
        'prefix' => '',
        'encoding' => 'UTF8',
        'port' => '',
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
