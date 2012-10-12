<?php 

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author nicolasmoricet
 */
class ModuleController extends ModuleAppController
{
    private $aModules = array();
    
    public $uses = array(
        'Module.Module',
        'Module.Plugin'
    );
    
    public function beforeFilter() 
    {
        parent::beforeFilter();
        
        $appPlugin = APP . 'Plugin' . DS;
        $aDirs = scandir($appPlugin);
        
        $dbModule = $this->Module->find('all');
        
        foreach($aDirs as $aDir)
        {
            if($aDir != '.' && $aDir != '..')
            {
                if(is_dir($appPlugin . $aDir))
                {
                    $fileParams = $appPlugin . $aDir . DS . Configure::read('Module.filename.params');
                    
                    if(file_exists($fileParams))
                    {
                        $aModule = array();
                        
                        $dom = new DOMDocument();
                        
                        if(!@$dom->load($fileParams))
                        {
                            continue;
                        }
                        
                        $elements = $dom->getElementsByTagName('module');
                        
                        foreach($elements as $element)
                        {
                            $aModule['is_installed'] = false;
                            $aModule['is_main'] = false;
                            $aModule['name'] = (!empty($element->getElementsByTagname('name')->item(0)->nodeValue)) ? $element->getElementsByTagname('name')->item(0)->nodeValue:null;
                            $aModule['description'] = (!empty($element->getElementsByTagname('description')->item(0)->nodeValue)) ? $element->getElementsByTagname('description')->item(0)->nodeValue:null;
                            $aModule['version'] = (!empty($element->getElementsByTagname('version')->item(0)->nodeValue)) ? $element->getElementsByTagname('version')->item(0)->nodeValue:null;
                            $aModule['author'] = (!empty($element->getElementsByTagname('author')->item(0)->nodeValue)) ? $element->getElementsByTagname('author')->item(0)->nodeValue:null;
                            $aModule['site'] = (!empty($element->getElementsByTagname('site')->item(0)->nodeValue)) ? $element->getElementsByTagname('site')->item(0)->nodeValue:null;
                            $aModule['url'] = (!empty($element->getElementsByTagname('url')->item(0)->nodeValue)) ? $element->getElementsByTagname('url')->item(0)->nodeValue:null;
                            $aModule['core'] = (!empty($element->getElementsByTagname('core')->item(0)->nodeValue)) ? $element->getElementsByTagname('core')->item(0)->nodeValue:false;
                            
                            $plugins = $element->getElementsByTagname('plugin');
                            
                            $aPlugins = array();
                            
                            foreach($plugins as $plugin)
                            {
                                $active = $plugin->getAttribute('active');
                                $main = $plugin->getAttribute('main');
                                
                                $d = array();
                                $d['Plugin']['name'] = ucfirst($plugin->getElementsByTagname('name')->item(0)->nodeValue);
                                $d['Plugin']['prefix'] = (!empty($plugin->getElementsByTagname('prefix')->item(0)->nodeValue)) ? strtolower($plugin->getElementsByTagname('prefix')->item(0)->nodeValue):'public';
                                $d['Plugin']['plugin'] = strtolower($plugin->getElementsByTagname('plugin_name')->item(0)->nodeValue);
                                $d['Plugin']['controller'] = strtolower($plugin->getElementsByTagname('controller')->item(0)->nodeValue);
                                $d['Plugin']['action'] = (!empty($plugin->getElementsByTagname('action')->item(0)->nodeValue)) ? strtolower($plugin->getElementsByTagname('action')->item(0)->nodeValue):'index';
                                $d['Plugin']['is_main'] = (!empty($main) && $main == 'true') ? true:false;
                                $d['Plugin']['is_active'] = (!empty($active) && $active == 'true') ? true:false;
                                
                                if($d['Plugin']['is_main'])
                                {
                                    $aModule['is_main'] = $d['Plugin']['is_main'];
                                    $aModule['is_active'] = $d['Plugin']['is_active'];
                                }
                                
                                $aPlugins[] = $d;
                            }
                            
                            $aModule['plugins'] = $aPlugins;
                            
                            $tables = $element->getElementsByTagname('table');
                            
                            $aModels = array();
                            
                            foreach($tables as $table)
                            {
                                $aModel = array();
                                $model = $table->getElementsByTagname('model')->item(0)->nodeValue;
                                
                                $aData = $table->getElementsByTagname('data');
                                
                                foreach ($aData as $data) 
                                {
                                    $aModel[$model] = array();
                                    
                                    foreach($data->childNodes  as $node)
                                    {
                                        if($node instanceof DOMElement)
                                        {
                                            $aModel[$model][$node->nodeName] = $node->nodeValue;
                                        }
                                    }
                                    
                                    $aModels[] = $aModel;
                                }
                            }
                            
                            $aModule['models'] = $aModels;
                        }
                        
                        $this->aModules[] = $aModule;
                    }                    
                }
            }
        }
        
//        debug($this->aModules);
        
        if(!empty($this->params['named']['unload']))
        {
            CakePlugin::unload(ucfirst($plugin));
        }
    }
    
    public function manager_index()
    {
        $this->set('title', "Gestionnaire de module");
        
        foreach($this->aModules as $aKey => $aModule)
        {
            foreach($aModule['plugins'] as $aPlugin)
            {
                $bPlugin = $this->Plugin->findByStructureAndMain($aPlugin);
                
                if(!empty($bPlugin['Module']))
                {
                    $this->aModules[$aKey]['is_installed'] = true;
                    $this->aModules[$aKey]['id'] = $bPlugin['Module']['id'];
                    $this->aModules[$aKey]['plugins_id'] = $bPlugin['Module']['plugins_id'];
                }
            }
        }
        
        $this->set('aModules', $this->aModules);
    }
    
    /**
     * Permet d'installer un plugin dans la base de données
     */
    public function manager_installer()
    {
        $error = false;
        $named = $this->params['named'];
        
        if(empty($named['id']))
        {
            $this->Session->setFlash("Impossible d'installer le module !", 'alert', array('type' => AppController::TYPE_WARNING));
            $this->redirect($this->referer());
        }
        
        $iId = ($named['id'] - 1);
        
        if(!array_key_exists($iId, $this->aModules))
        {
            $this->Session->setFlash("Impossible d'installer le module !", 'alert', array('type' => AppController::TYPE_WARNING));
            $this->redirect($this->referer());
        }
        
        $dModule = $this->aModules[$iId];
        
        $aModule['Module']['is_main'] = $dModule['is_main'];
        $aModule['Module']['name'] = $dModule['name'];
        $aModule['Module']['description'] = $dModule['description'];
        $aModule['Module']['version'] = $dModule['version'];
        $aModule['Module']['author'] = $dModule['author'];
        $aModule['Module']['site'] = $dModule['site'];
        $aModule['Module']['url'] = $dModule['url'];
        $aModule['Module']['is_active'] = $dModule['is_active'];
        
        foreach($dModule['plugins'] as $plugin)
        {      
            if($plugin['Plugin']['is_main'] == true) { $pluginMain = $plugin['Plugin']['plugin']; }
            $aModule['Plugin'][] = $plugin;
        }
        
        $aModule['Models'] = $dModule['models'];
        
        foreach($aModule['Models'] as $model)
        {
            $arrayKeys = array_keys($model);
            $modelName = ucfirst($arrayKeys[0]);
                        
            if(!in_array(ucfirst($pluginMain) . '.' . $modelName, $this->uses))
            {
                $this->uses[] = ucfirst($pluginMain) . '.' . $modelName;
            }
            
            $this->{$modelName}->create();
            
            if(!$this->{$modelName}->save($model, false))
            {
                $error = true;
            }
        }
        
        foreach($aModule['Plugin'] as $aPlugin)
        {
            $this->Plugin->create();
            
            if(isset($parent_id) && !empty($parent_id))
            {
                $aPlugin['Plugin']['parent_id'] = $parent_id;
            }
            
            if($this->Plugin->save($aPlugin))
            {
                if($aPlugin['Plugin']['is_main'] == true)
                {
                    $aModule['Module']['plugins_id'] = $this->Plugin->id;
                    $parent_id = $this->Plugin->id;
                }
            } else {
                $error = true;
            }
        }
        
        $dModule['Module'] = $aModule['Module'];
        
        $reponse = $this->installTables($dModule);
        
        if ($reponse['error'] == AppController::TYPE_SUCCESS) 
        {
            if($this->Module->save($dModule))
            {   
                $this->Session->setFlash("Le module est installé !", 'alert');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash("Le module n'a pas pu être enregistré !", 'alert', array('type' => AppController::TYPE_ERROR));
                $this->redirect($this->referer());
            }   
        }
        
        if(!$error)
        {
            $this->Session->setFlash("Le module n'a pas pu être installé complètement !", 'alert', array('type' => AppController::TYPE_WARNING));
            $this->redirect($this->referer());
        }
        
        return $this->render(false);
    }
    
    private function installTables($aModule)
    {
        $response = array(
            'error' => AppController::TYPE_SUCCESS
        );
        
        App::uses('CakeSchema', 'Model');
        App::uses('ConnectionManager', 'Model');
        
        $db = ConnectionManager::getDataSource('default');
        $brokenSequence = $db instanceof Postgres;
        
        foreach($aModule['plugins'] as $aPlugin)
        {
            if($aPlugin['Plugin']['is_main'] === true)
            {
                $pluginName = ucfirst($aPlugin['Plugin']['plugin']);
                $pluginPath = APP . 'Plugin' . DS . $pluginName . DS;
                $pluginSchema = $pluginPath . 'Config' . DS . 'Schema' . DS;
                
                $aSchemas = glob($pluginSchema . '*.php');
                
                foreach($aSchemas as $aSchema)
                {
                    $ex = explode(DS, $aSchema);
                    $f = end($ex);

                    $fileName = explode('.', $f);
                    $fileName = $fileName[0];
                    
                    require_once $aSchema;
                    
                    $className = $fileName . 'Schema';
            
                    $obj = new $className;

                    $schema =& new CakeSchema(array(
                        'name' => $obj->name,
                        'path' => $obj->path,
                        'file' => $obj->file,
                        'plugin' => $obj->plugin,
                        'tables' => $obj->tables,
                    ));
                    
                    $schema = $schema->load();
                    
                    foreach ($schema->tables as $table => $fields)
                    {
                        $create = $db->createSchema($schema, $table);

                        try {
                            $db->execute($create);
                        } catch (PDOException $e) { 
                            $response['error'] = AppController::TYPE_ERROR;
                            $response['message'][] = sprintf("la table %s n'a pas pu être installé", $table);
                        }
                    }
                }
             }
        }
        
        return $response;
    }
    
    public function manager_uninstall()
    {
        $error = false;
        $named = $this->params['named'];
        
        if(empty($named['id']))
        {
            $this->Session->setFlash("Impossible de désintaller le module !", 'alert', array('type' => AppController::TYPE_WARNING));
            $this->redirect($this->referer());
        }
        
        
        $aModule = $this->Module->findModuleById($named['id'], array(
            'Plugin' => array(
                'fields' => array(
                    'id',
                    'plugin',
                    'parent_id'
                ),
                'ChildPlugin' => array(
                    'fields' => array(
                        'id',
                        'parent_id'
                    )
                )
            )
        ), array(
            'id',
            'plugins_id'
        ));
        
        foreach($aModule['Plugin']['ChildPlugin'] as $aChildPlugin)
        {
            if(!$this->Plugin->delete($aChildPlugin['id'], false))
            {
                $error = true;
            }
        }
        
        if(!$this->Plugin->delete($aModule['Plugin']['id']))
        {
            $error = true;
        }
        
        if(!$this->Module->delete($aModule['Module']['id']))
        {
            $this->Session->setFlash("Le module n'a pas pu être désinstallé !", 'alert', array('type' => AppController::TYPE_ERROR));
            $this->redirect($this->referer());
        }
        
        if($error)
        {
            $this->Session->setFlash("Le Module à mal été désinstallé !", 'alert', array('type' => AppController::TYPE_ERROR));
            $this->redirect($this->referer());
        } else {
            if(!empty($this->params->query['dir']) && $this->params->query['dir'] == 'true')
            {
                $dirPlugin = APP . 'Plugin' . DS . ucfirst($aModule['Plugin']['plugin']);
        
                if(file_exists($dirPlugin))
                {
                    App::import('Vendor', 'Tools/ToolsDirectory');
                    
                    if(!ToolsDirectory::delete($dirPlugin))
                    {
                        $this->Session->setFlash("Le dossier contenant les modules n'a pas pu être supprimer !", 'alert', array('type' => AppController::TYPE_WARNING));
                        $this->redirect(array(
                            'manager' => true,
                            'plugin' => 'module',
                            'controller' => 'module',
                            'action' => 'index',
                            'unload' => $aModule['Plugin']['plugin']
                        ));
                    }
                }
            }
        }
        
        $this->Session->setFlash("Le module est désinstallé", 'alert');
        $this->redirect($this->referer());
        
        return $this->render(false);
    }
    
    public function ajax_activate()
    {
        $named = $this->params['named'];
        
        if(empty($named['id']))
        {
            echo json_encode(array(
                'message' => "Impossible de paramètrer l'activation !",
                'type' => AppController::TYPE_WARNING
            ));
            return $this->render(false);
        }
        
        if(!empty($this->data))
        {
            $error = false;
            
            foreach($this->data['Module']['id'] as $aKey => $aValue)
            {
                $aModule = $this->Module->findModuleById($aKey);
                
                if($aModule['Module']['is_active'] == $aValue) { continue; }
                
                $aModule['Module']['is_active'] = $aValue;
                
                if(!$this->Module->save($aModule, false))
                {
                    $error = true;
                }
            }
            
            if($error)
            {
                echo json_encode(array(
                    'message' => "Impossible de mettre à jour le status d'activation du module !",
                    'type' => AppController::TYPE_WARNING
                ));
                
                return $this->render(false);
            }
            
            if(empty($this->data['Plugin'])) { return $this->render(false); }
            
            foreach($this->data['Plugin']['id'] as $aKey => $aValue)
            {
                $aPlugin = $this->Plugin->find('first', array(
                    'conditions' => array(
                        'id' => $aKey
                    )
                ));
                
                if($aPlugin['Plugin']['is_active'] == $aValue) { continue; }
                
                $aPlugin['Plugin']['is_active'] = ($aValue == 1) ? true:false;
                
                if(!$this->Plugin->save($aPlugin, false))
                {
                    $error = true;
                }
            }
             
            if($error)
            {
                echo json_encode(array(
                    'message' => "Impossible de mettre à jour certains status d'activation des modules !",
                    'type' => AppController::TYPE_WARNING
                ));
                
                return $this->render(false);
            } else {
                echo json_encode(array(
                    'message' => "Mise à jour de l'activation du module effectué !",
                    'type' => AppController::TYPE_SUCCESS
                ));
                
                return $this->render(false);
            }     
            
        }
        
        $aModule = $this->Module->findModuleById($named['id'], array(
            'Plugin' => array(
                'fields' => array(
                    'id',
                    'name',
                    'is_active'
                ),
                'ChildPlugin' => array(
                    'fields' => array(
                        'id',
                        'name',
                        'parent_id',
                        'is_active'
                    )
                )
            )
        ), array(
            'id',
            'plugins_id',
            'name',
            'is_active'
        ));
        
        $this->set('aModule', $aModule);
    }
}

?>
