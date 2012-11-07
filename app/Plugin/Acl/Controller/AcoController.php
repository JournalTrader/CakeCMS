<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AcoController
 *
 * @author nicolasmoricet
 */
class AcoController extends AclAppController
{
    public $uses = array(
        'Module.Plugin'
    );

    public function manager_index()
    {
        
    }
    
    public function manager_add()
    {
        $acos = array();
        
        $aPlugins = $this->Plugin->find('all', array(
            'contain' => array(
                'ChildPlugin'
            ), 
            array(
                'conditions' => array(
                    'parent_id' => 0
                )
            )
        ));
        
        foreach($aPlugins as $aPlugin)
        {      
            $alias = '';
            $alias = !empty($aPlugin['Plugin']['prefix']) ? $aPlugin['Plugin']['prefix'] . '/':null;
            $alias .= $aPlugin['Plugin']['plugin'] . '/' . $aPlugin['Plugin']['controller'] . '/'. $aPlugin['Plugin']['action'];
            
            $acos[] = array(
                'parent_id' => null,
                'model' => 'Plugin',
                'foreign_key' => $aPlugin['Plugin']['id'],
                'alias' => $alias
            );
            
            if(!empty($aPlugin['ChildPlugin']))
            {
                foreach($aPlugin['ChildPlugin'] as $aChildPlugin)
                {
                    $alias = '';
                    $alias = !empty($aChildPlugin['prefix']) ? $aChildPlugin['prefix'] . '/':null;
                    $alias .= $aChildPlugin['plugin'] . '/' . $aChildPlugin['controller'] . '/'. $aChildPlugin['action'];
                    
                    $acos[] = array(
                        'parent_id' => null,
                        'model' => 'Plugin',
                        'foreign_key' => $aChildPlugin['id'],
                        'alias' => $alias
                    );
                }
            }
            
        }
        
        $nAdd = 0;
        
        foreach($acos as $aco)
        {
            $aAco = $this->Acl->Aco->find('first', array(
                'conditions' => array(
                    'model' => $aco['model'],
                    'foreign_key' => $aco['foreign_key']
                )
            ));
            
            if(empty($aAco))
            {
                $nAdd++;
            }
            
            $aAco['Aco']['parent_id'] = $aco['parent_id'];
            $aAco['Aco']['model'] = $aco['model'];
            $aAco['Aco']['foreign_key'] = $aco['foreign_key'];
            $aAco['Aco']['alias'] = $aco['alias'];
            
            $this->Acl->Aco->create($aAco);
            
            if($this->Acl->Aco->save()) 
            {
                
            }
        }
        
        $message = ($nAdd != 1) ? sprintf("%s éléments ont étés ajoutés.", $nAdd):sprintf("%s élément a été ajouté.", $nAdd);
        
        $this->Session->setFlash($message, 'alert');
        $this->redirect(array(
            'manager' => true,
            'plugin' => 'acl',
            'controller' => 'aco',
            'action' => 'index'
        ));
        
    }
}

?>
