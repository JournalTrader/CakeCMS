<?php
$apluginsLists = CakePlugin::loaded();

foreach($apluginsLists as $apluginsList)
{
    $btPlugin = APP . 'Plugin' . DS . $apluginsList . DS . 'Config' . DS . 'bootstrap.php';
    
    if(file_exists($btPlugin))
    {
        require_once $btPlugin;
    }
}

?>