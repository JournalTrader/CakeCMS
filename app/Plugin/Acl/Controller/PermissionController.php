<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PermissionController
 *
 * @author nicolasmoricet
 */
class PermissionController extends AclAppController
{
    public $uses = array(
        'Module.Module',
        'Acl.Group'
    );
    
    public function manager_index()
    {
        $aAcos = array();
        
        $aModules = $this->Module->findModules(array(
            'Plugin' => array(
                'ChildPlugin'
            )
        ));
        
        if (!empty($this->data)) 
        {
            foreach($this->data as $iId => $aros)
            {
                $iAro = $this->Acl->Aro->find('first', array(
                    'conditions' => array(
                        'id' => $iId
                    )
                ));
                
                $aGoupData = $this->Group->find('first', array(
                    'conditions' => array(
                        'id' => $iAro['Aro']['id']
                    )
                ));
                
                foreach($aros as $iIdAro => $aro)
                {
                    $iAco = $this->Acl->Aco->find('first', array(
                        'conditions' => array(
                            'id' => $iIdAro
                        )
                    ));
                    
                    if($aro)
                    {
                        $this->Acl->allow($aGoupData, $iAco['Aco']);
                    } else {
                        $this->Acl->deny($aGoupData, $iAco['Aco']);
                    }
                }
                
                
            }
        }
        
        foreach($aModules as $aKeyModule => $aModule)
        {
            $aPlugin = $aModule['Plugin'];
            
            $aAros = $this->Acl->Aro->find('all', array(
                'conditions' => array(
                    'model' => 'Group'
                )
            ));
            
            foreach ($aAros as $aroKey => $aAro)
            {
                $aGoup = $this->Group->find('first', array(
                    'conditions' => array(
                        'id' => $aAro['Aro']['foreign_key']
                    )
                ));
                
                $aAros[$aroKey]['Aro']['Group'] = $aGoup['Group'];
            }
            
            $aAco1 = $this->Acl->Aco->find('first', array(
                'conditions' => array(
                    'model' => 'Plugin',
                    'foreign_key' => $aModule['Plugin']['id']
                )
            ));
            
            if(!empty($aAco1))
            {
                if(!empty($aPlugin['ChildPlugin']))
                {
                    foreach($aPlugin['ChildPlugin'] as $aKey => $aChildPlugin)
                    {
                        $aAco2 = $this->Acl->Aco->find('first', array(
                            'conditions' => array(
                                'model' => 'Plugin',
                                'foreign_key' => $aChildPlugin['id']
                            )
                        ));
                        
                        if($aAco2)
                        {
                            $aModules[$aKeyModule]['Plugin']['ChildPlugin'][$aKey]['Aco'] = $aAco2['Aco'];
                        }
                    }
                }
                
                $aModules[$aKeyModule]['Plugin']['Aco'] = $aAco1['Aco'];
            }
        }
        
        $this->set('aModules', $aModules);
        $this->set('aAros', $aAros);
    }
}

?>
