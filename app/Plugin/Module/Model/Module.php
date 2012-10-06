<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Module
 *
 * @author nicolasmoricet
 */
class Module extends ModuleAppModel
{
    public $belongsTo = array(
        'Plugin' => array(
            'className' => 'Module.Plugin',
            'foreignKey' => 'plugins_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    public function findModuleById($iId, $contain = array(), $fields = array())
    {
        return $this->find('first', array(
            'fields' => $fields,
            'contain' => $contain,
            'conditions' => array(
                'Module.id' => (int)$iId
            )
        ));
    }
    
    public function findModules($contain = array(), $fields = array())
    {
        return $this->find('all', array(
            'fields' => $fields,
            'contain' => $contain,
            'conditions' => array(
                'Module.is_active' => true
            )
        ));
    }
    
    public function findModulesTreeForSelect($contain = array(), $fields = array())
    {
        $aData = array();
        $aData[0] = "Choisir un module";
        
        $aModules = $this->findModules($contain, $fields);
        
        foreach($aModules as $aModule)
        {
            $aData[$aModule['Plugin']['id']] = $aModule['Module']['name'];
            
            if(!empty($aModule['Plugin']['ChildPlugin']))
            {
                foreach ($aModule['Plugin']['ChildPlugin'] as $aChildPlugin) 
                {
                    if($aChildPlugin['prefix'] != 'manager' && $aChildPlugin['prefix'] != 'public') { continue; }
                    
                    $aData[$aChildPlugin['id']] = '-- ' . $aChildPlugin['name'];
                }
            }
        }
        
        return $aData;
    }
}

?>
