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
                        $dom->load($fileParams);
                        
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
                        }
                        
                        $this->aModules[] = $aModule;
                    }                    
                }
            }
        }
    }
    
    public function manager_index()
    {
        foreach($this->aModules as $aKey => $aModule)
        {
//            debug($aModule);
            
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
            $aModule['Plugin'][] = $plugin;
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
        
        if($this->Module->save($dModule))
        {
            $this->Session->setFlash("Le module est installé !", 'alert');
            $this->redirect($this->referer());
        } else {
            $this->Session->setFlash("Le module n'a pas pu être enregistré !", 'alert', array('type' => AppController::TYPE_ERROR));
            $this->redirect($this->referer());
        }
        
        if(!$error)
        {
            $this->Session->setFlash("Le module n'a pas pu être installé complètement !", 'alert', array('type' => AppController::TYPE_WARNING));
            $this->redirect($this->referer());
        }
        
        return $this->render(false);
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
                
                if($this->Plugin->save($aPlugin, false))
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
