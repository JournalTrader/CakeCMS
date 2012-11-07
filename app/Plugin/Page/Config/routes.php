<?php
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */

Router::connect('/:slug', array(
    'public' => true, 
    'plugin' => 'page', 
    'controller' => 'page', 
    'action' => 'read'
), array(
    'pass' => array(
        'id',
        'slug'
    ),
    'id' => '[0-9]+',
    'slug' => '[a-zA-Z0-9\-]+'
));
//	
//	Router::connect('/manager', array('prefix' => 'manager', 'plugin' => 'index', 'controller' => 'index', 'action' => 'index'));
