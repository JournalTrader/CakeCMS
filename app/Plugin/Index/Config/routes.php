<?php
$base = array(
    'prefix' => 'public', 
    'plugin' => 'index', 
    'controller' => 'index', 
    'action' => 'index'
);

App::import('Model', 'Option');
        
$option = new Option();

$plugin_id = $option->getOption('plugin_id');
$page_id = $option->getOption('page_id');
$article_id = $option->getOption('article_id');

if(!empty($plugin_id))
{
    App::import('Model', 'Module.Plugin');
    
    $plugin = new Plugin();
    $aPlugin = $plugin->find('first', array(
        'conditions' => array(
            'id' => $plugin_id
        )
    ));
    
    $base['prefix'] = $aPlugin['Plugin']['prefix'];
    $base['plugin'] = $aPlugin['Plugin']['plugin'];
    $base['controller'] = $aPlugin['Plugin']['controller'];
    $base['action'] = $aPlugin['Plugin']['action'];
} else if(!empty($page_id)) {
    App::import('Model', 'Seo.Seo');
    
    $seo = new Seo();
    $aSeo = $seo->find('first', array(
        'conditions' => array(
            'table_id' => 'page_' . $page_id
        )
    ));
    
    $base['prefix'] = 'public';
    $base['plugin'] = 'page';
    $base['controller'] = 'page';
    $base['action'] = 'read';
    $base['id'] = $page_id;
    
    if(isset($aSeo['Seo']['slug']))
    {
        $base['slug'] = $aSeo['Seo']['slug'];
    }
} else if(!empty($article_id)) {
    App::import('Model', 'Seo.Seo');
    
    $seo = new Seo();
    $aSeo = $seo->find('first', array(
        'conditions' => array(
            'table_id' => 'article_' . $article_id
        )
    ));
    
    $base['prefix'] = 'public';
    $base['plugin'] = 'blog';
    $base['controller'] = 'article';
    $base['action'] = 'read';
    $base['id'] = $article_id;
    
    if(isset($aSeo['Seo']['slug']))
    {
        $base['slug'] = $aSeo['Seo']['slug'];
    }
}

Router::connect('/', $base);
Router::connect('/manager', array('prefix' => 'manager', 'plugin' => 'index', 'controller' => 'index', 'action' => 'index'));

?>
