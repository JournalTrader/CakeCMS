<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * http://www.youtube.com/watch?v=UGtKGX8B9hU
 * Description of PermissionsController
 *
 * @author nicolasmoricet
 */
class PermissionController extends AclAppController
{
    public $uses = array(
        'Acl.Groupe',
        'Acl.ArosAco',
        'User.User',
        'Module.Module',
        'Module.Plugin'
    );
    
    public function beforeFilter() 
    {
        parent::beforeFilter();
        
//        $this->Auth->allow('*');
    }
    
    public function manager_index()
    {        
        $aGroupes = $this->Groupe->find('all', array(
            'order' => array(
                'order' => 'ASC'
            )
        ));
        
        if (!empty($this->data)) 
        {
            foreach($this->data['Groupe'] as $idGroupe => $aPlugins)
            { 
                foreach($aPlugins as $idPlugin => $access)
                {
                    $aAco = $this->Acl->Aco->find('first', array(
                        'fields' => array(
                            'id',
                            'model',
                            'foreign_key',
                            'alias'
                        ),
                        'conditions' => array(
                            'model' => 'Plugin',
                            'foreign_key' => $idPlugin
                        )
                    ));
                    
                    $groupe =& $this->User->Groupe;
                    $groupe->id = $idGroupe;
                    
                    if(empty($aAco)) { continue; }
                    if($access)
                    {
                        $this->Acl->allow($groupe, array(
                            'model' => 'Plugin',
                            'foreign_key' => $aAco['Aco']['foreign_key']
                        ));
                    } else {
                        $this->Acl->deny($groupe, array(
                            'model' => 'Plugin',
                            'foreign_key' => $aAco['Aco']['foreign_key']
                        ));
                    }
                }
            }
        }
        
        $aModules = $this->Module->findModules(array(
            'Plugin' => array(
                'ChildPlugin'
            )
        ));
        
        foreach($aModules as $keyModule => $aModule)
        {
            $aAcos = $this->Acl->Aco->find('all', array(
                'conditions' => array(
                    'model' => 'Plugin',
                    'foreign_key' => $aModule['Plugin']['id']
                )
            ));
            
            $aModules[$keyModule]['Plugin']['Acl'] = $aAcos;
            
            if(!empty($aModule['Plugin']['ChildPlugin']))
            {
                foreach($aModule['Plugin']['ChildPlugin'] as $aKey => $aChildPlugin)
                {
                    $aAcos = $this->Acl->Aco->find('all', array(
                        'conditions' => array(
                            'model' => 'Plugin',
                            'foreign_key' => $aChildPlugin['id']
                        )
                    ));
                    
                    $aModules[$keyModule]['Plugin']['ChildPlugin'][$aKey]['Acl'] = $aAcos;
                }
            }
//            debug($aAcos);
        }
        
//        debug($aModules);
        
//        $this->setModule($aModules);
        
        $this->set('aGroupes', $aGroupes);
        $this->set('aModules', $aModules);
    }   
    
    public function manager_add()
    {
        
    }
    
    private function setModule($aModules)
    {
//        $this->Acl->Aco->create();
//        $this->Acl->Aco->save(array('parent_id' => null, 'alias' => 'controleurs'));
            
        foreach($aModules as $aModule)
        {
            $alias = $aModule['Plugin']['plugin'] . '/' . $aModule['Plugin']['controller'] . '/' . $aModule['Plugin']['prefix'] . '_' . $aModule['Plugin']['action'];
            
            $aAco = array(
                'Aco' => array(
                    'parent_id' => null,
                    'model' => 'Plugin',
                    'foreign_key' => $aModule['Plugin']['id'],
                    'alias' => $alias
                )
            );
            
            debug($aAco);
            $this->Acl->Aco->create();
            $this->Acl->Aco->save($aAco);
            
            if(!empty($aModule['Plugin']['ChildPlugin']))
            {
                foreach($aModule['Plugin']['ChildPlugin'] as $aPlugin)
                {
                    $alias = $aPlugin['plugin'] . '/' . $aPlugin['controller'] . '/' . $aPlugin['prefix'] . '_' . $aPlugin['action'];
                    
                    $aAco = array(
                        'Aco' => array(
//                            'parent_id' => $aModule['Plugin']['id'],
                            'model' => 'Plugin',
                            'foreign_key' => $aPlugin['id'],
                            'alias' => $alias
                        )
                    );
                    
                    $this->Acl->Aco->create();
                    $this->Acl->Aco->save($aAco);
                    debug($aAco);
                }
            }
//            debug($aModule);
        }
    }
}

?>
