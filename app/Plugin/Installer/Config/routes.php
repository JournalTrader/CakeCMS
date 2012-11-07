<?php
$request = Router::getRequest();

if (strpos($request->url, 'installer') === false) 
{    
    Router::redirect('/*', array(
        'plugin' => 'installer' ,
        'controller' => 'installer'
    ), array(
        'status' => 307
    ));
}
?>
