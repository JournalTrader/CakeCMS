<?php

$pluginsDirectories = scandir(APP . 'Plugin');

if(!empty($pluginsDirectories))
{
    foreach($pluginsDirectories as $pluginsDirectory)
    {
        if($pluginsDirectory != '.' && $pluginsDirectory != '..' && $pluginsDirectory != 'Installer')
        {
            CakePlugin::load($pluginsDirectory);
        }
    }
}

?>