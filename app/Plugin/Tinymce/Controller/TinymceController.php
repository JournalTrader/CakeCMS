<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TinymceController
 *
 * @author nicolasmoricet
 */
class TinymceController extends TinymceAppController
{
    public $uses = array(
        'Module.Module',
        'Module.Plugin',
        'Seo.Seo'
    );
    
    public function manager_index() 
    {
        $aLists = json_decode($this->Option->getOption('tinymce'));
        
        if(!empty($aLists))
        {
            foreach($aLists as $aKey => $aList)
            {
                $aLists[$aKey]->Plugin = $this->Plugin->getById($aList->plugin, array(
                    'id',
                    'name'
                ));
            }
        }        
        
        $this->set('aLists', $aLists); 
        
        $this->set('maxCount', count($aLists));
        
    }
    
    public function block_head() 
    {
        $params = $this->request->params;
        
        $aData = json_decode($this->Option->getOption('tinymce'));
        
        $data = array();
        
        foreach($aData as $aD)
        {
            $aPlugin = $this->Plugin->getById($aD->plugin, array(
                'prefix',
                'plugin',
                'controller',
                'action'
            ));
            
            if ($aPlugin['Plugin']['prefix'] == $params['named']['rPrefix']
                && $aPlugin['Plugin']['plugin'] == $params['named']['rPlugins']
                && $aPlugin['Plugin']['controller'] == $params['named']['rController']
                && $aPlugin['Plugin']['prefix'] . '_' . $aPlugin['Plugin']['action'] == $params['named']['rAction']) 
            {
                $jQuerySelector[] = '#' . $aD->field;
                
                $data = array(
                    'selector' => implode(', ', $jQuerySelector)
                );
            }
            
        }
        
        $this->set('aSelector', $data['selector']);
        
    }
    
    public function ajax_new_line()
    {
        $params = $this->request->params;
        
        $aModules = $this->Module->findModulesTreeForSelect(array(
            'Plugin' => array(
                'ChildPlugin'
            )
        ));
        
        $this->set('order', ($params['named']['order'] + 1));
        $this->set('aModules', $aModules);
    }
    
    public function ajax_new_option()
    {        
        $find = false;
        
        $aData = array();
        
        if(!empty($this->data))
        {
            $aLists = json_decode($this->Option->getOption('tinymce'));
            
            if(!empty($aLists) && array_key_exists(($this->data['Option']['order'] - 1), $aLists))
            {
                $aLists[($this->data['Option']['order'] - 1)]->field = $this->data['Option']['field'];
                $aLists[($this->data['Option']['order'] - 1)]->plugin = $this->data['Option']['plugin'];
            } else {
                $obj = new stdClass();
                $obj->field = $this->data['Option']['field'];
                $obj->plugin = $this->data['Option']['plugin'];
                
                $aLists[] = $obj;
                
            }
            
            $data['Option'] = array(
                'key' => 'tinymce',
                'value' => json_encode($aLists)
            );
            
            if($this->Option->updateAll(array(
                'Option.value' => '\'' . $data['Option']['value'] . '\''
            ), array(
                'Option.key' => $data['Option']['key']
            )))
            {
                echo json_encode(array(
                    'error' => AppController::TYPE_SUCCESS,
                    'message' => "L'option est sauvegardée !",
                    'data' => $data
                ));

                return $this->render(false);
            }
            
            echo json_encode(array(
                'error' => AppController::TYPE_WARNING,
                'message' => "L'option n'a pas pu être sauvegardée !"
            ));
        }
        
        return $this->render(false);
    }
    
    public function ajax_add_line()
    {
        if(empty($this->data))
        {   
            return $this->render(false);
        }
        
        $aLists = json_decode($this->Option->getOption('tinymce'));
        
        $aData = json_decode($this->data['Data']);
        
        $d = json_decode($aData->data->Option->value);
        
        $end = end($d);
        
        $end->Plugin = $this->Plugin->getById($end->plugin, array(
            'id',
            'name'
        ));
        
        $this->set('aCount', count($aLists));
        $this->set('aData', $end);
    }
    
    public function manager_delete()
    {
        $params = $this->request->params;
        
        if(!empty($params['named']['id']))
        {
            $aLists = json_decode($this->Option->getOption('tinymce'));
            
            foreach($aLists as $aKey => $aList)
            {
                if ($aList->field.$aList->plugin == $params['named']['id']) 
                {
                    unset($aLists[$aKey]);
                }
            }
            
            $data['Option'] = array(
                'key' => 'tinymce',
                'value' => json_encode($aLists)
            );
            
            if($this->Option->updateAll(array(
                'Option.value' => '\'' . $data['Option']['value'] . '\''
            ), array(
                'Option.key' => $data['Option']['key']
            ))) {
                $this->Session->setFlash("Le champ est supprimé !", 'alert');
                $this->redirect(array(
                    'manager' => true,
                    'plugin' => 'tinymce',
                    'controller' => 'tinymce',
                    'action' => 'index'
                ));
            } 
            
            $this->Session->setFlash("Le n'a pas été supprimé !", 'alert', array('type' => AppController::TYPE_WARNING));
            $this->redirect($this->referer());
        }
        
        return $this->render(false);
    }
    
    public function ajax_edit()
    {
        $params = $this->request->params;
        
        if(empty($params['named']['field']) || empty($params['named']['plugins_id']))
        {
            return $this->render(false);
        }
        
        $aModules = $this->Module->findModulesTreeForSelect(array(
            'Plugin' => array(
                'ChildPlugin'
            )
        ));
        
        $this->set('aModules', $aModules);
        $this->set('field', $params['named']['field']);
        $this->set('plugins_id', $params['named']['plugins_id']);
        $this->set('order', $params['named']['order']);
    }
    
    public function ajax_insert_link()
    {
        $aSeos = $this->Seo->find('all', array(
            'fields' => array(
                'id',
                'title',
                'slug',
                'table_id'
            )
        ));
        
        $this->set('aSeos', $aSeos);
    }
}

?>
