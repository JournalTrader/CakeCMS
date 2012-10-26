<?php
$apluginsLists = CakePlugin::loaded();

foreach($apluginsLists as $apluginsList)
{
    $btPlugin = APP . 'Plugin' . DS . $apluginsList . DS . 'Config' . DS . 'bootstrap.php';
    $btRoutes = APP . 'Plugin' . DS . $apluginsList . DS . 'Config' . DS . 'routes.php';
    
    if(file_exists($btPlugin))
    {
        require_once $btPlugin;
    }
    
    if(file_exists($btRoutes))
    {
        require_once $btRoutes;
    }
}

?>