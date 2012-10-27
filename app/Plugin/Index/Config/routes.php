<?php

Router::connect('/', array('prefix' => 'public', 'plugin' => 'index', 'controller' => 'index', 'action' => 'index'));
Router::connect('/manager', array('prefix' => 'manager', 'plugin' => 'index', 'controller' => 'index', 'action' => 'index'));

?>
