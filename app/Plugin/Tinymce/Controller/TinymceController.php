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
        'Module.Plugin'
    );
    
    public function manager_index() 
    {
        $aLists = json_decode($this->Option->getOption('tinymce'));
        
        foreach($aLists as $aKey => $aList)
        {
            $aLists[$aKey]->Plugin = $this->Plugin->getById($aList->plugin, array(
                'id',
                'name'
            ));
        }
        
        $this->set('aLists', $aLists);        
        
    }
    
    public function block_head() { }
    
    public function ajax_new_line()
    {
        $aModules = $this->Module->findModulesTreeForSelect(array(
            'Plugin' => array(
                'ChildPlugin'
            )
        ));
        
        $this->set('aModules', $aModules);
    }
    
    public function ajax_new_option()
    {
        $find = false;
        
        if(!empty($this->data))
        {
            $aLists = json_decode($this->Option->getOption('tinymce'));
            
            foreach($aLists as $aList)
            {
                $sData = $aList->field . $aList->plugin;
                
                if($sData == $this->data['Option']['field'].$this->data['Option']['plugin'])
                {
                    $find = true;
                }
            }
            
            if(!$find)
            {
                $obj = new stdClass();
                $obj->field = $this->data['Option']['field'];
                $obj->plugin = $this->data['Option']['plugin'];
                
                $aLists[] = $obj;
                
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
        }
        
        return $this->render(false);
    }
    
    public function ajax_add_line()
    {
        if(empty($this->data))
        {   
            return $this->render(false);
        }
        
        $aData = json_decode($this->data['Data']);
        
        $d = json_decode($aData->data->Option->value);
        
        $end = end($d);
        
        $end->Plugin = $this->Plugin->getById($end->plugin, array(
            'id',
            'name'
        ));
        
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
        
    }
}

?>
