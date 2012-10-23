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
class BlockController extends BlockAppController
{
    public $uses = array(
        'Menu.Menu',
        'Block.Block',
        'Block.Element',
        'Module.Plugin',
        'Module.Module'
    );
    
    public function block_index()
    {
        
    }
    
    public function block_menu()
    {
        $sClass = null;
        $params = $this->request->params;
        
        if(empty($params['named']['alias']))
        {
            return $this->render(false);
        }
        
        $aBlocks = $this->Block->getBlockMenus($params['named']['alias']);
        
        $this->set('aBlocks', $aBlocks);
        $this->set('aRequests', $params['named']);
        
        switch($params['named']['options']['type'])
        {
            case 'collapse-nav-bar':
                $sClass = ' nav-tabs nav-stacked';  
                break;
        }
        
        $this->set('sClass', $sClass);
    }
    
    public function block_element()
    {
        $params = $this->request->params;
        
        if(empty($params['named']['alias']))
        {
            return $this->render(false);
        }
        
        $aBlocks = $this->Block->getElementsBlockByAlias($params['named']['alias']);
        
        $this->set('alias', $params['named']['alias']);
        $this->set('named', $params['named']);
        
        if($aBlocks)
        {
            $this->set('aRequests', $params['named']);
            $this->set('aElements', $aBlocks['Element']);
            return $this->render('block_element');
        }
        
        return $this->render(false);
    }
    
    public function block_post()
    {
        if(!empty($this->data['BlockAlias']))
        {   
            $data = $this->data;
            
            foreach($data as $t => $d)
            {
                if($t == 'Table' || $t == 'BlockAlias') { continue; } 
                
                $d['table'] = $data['Table']['name'];
                $d['table_id'] = $data['Table']['name'] . '_' . $data['Table']['table_id'];
                
                $data[$t] = $d;
            }
            
            foreach($data['BlockAlias'] as $aBlockAlias)
            {
                $aBlocks = $this->Block->getElementsBlockByAlias($aBlockAlias);
                
                foreach($aBlocks['Element'] as $aBlock)
                {
                    $this->requestAction(array(
                        'manager' => false,
                        $aBlock['Plugin']['prefix'] => true,
                        'plugin' => $aBlock['Plugin']['plugin'],
                        'controller' => $aBlock['Plugin']['controller'],
                        'action' => $aBlock['Plugin']['action']
                    ), array(
                        'data' => $data
                    ));
                }
            }
        }
    }
    
    public function block_delete()
    {
        $data = $this->data;
        
        foreach($data as $aKey => $d)
        {
            if($aKey == 'Table') { continue; }
            
            $exBlocks = explode(',', $d['blocks']);
            
            if(!empty($exBlocks))
            {
                foreach($exBlocks as $block)
                {
                    $aBlocks = $this->Block->getElementsBlockByAlias($block);

                    foreach($aBlocks['Element'] as $aBlock)
                    {
                        $this->requestAction(array(
                            'manager' => false,
                            $aBlock['Plugin']['prefix'] => true,
                            'plugin' => $aBlock['Plugin']['plugin'],
                            'controller' => $aBlock['Plugin']['controller'],
                            'action' => 'delete'
                        ), array(
                            'data' => $data
                        ));
                    }
                }
            }
            
        }
    }
    
    public function manager_index()
    {
        $this->set('title', "Gestionnaire de blocks");
        
        $aMenus = $this->Block->getAllMenus();
        $aElements = $this->Block->getAllElements();
        
        $this->set('aMenus', $aMenus);
        $this->set('aElements', $aElements);
    }
    
    public function manager_add()
    {
        $this->set('title', "Ajout d'un block");
        $params = $this->request->params;
        $isEdit = false;
        
        if(!empty($this->data))
        {
            if($this->Block->save($this->data))
            {
                $this->Session->setFlash("Le block est sauvagardé", 'alert');
                $this->redirect(array(
                    'manager' => true,
                    'plugin' => 'block',
                    'controller' => 'block',
                    'action' => 'index'
                ));
            }
        }
        
        if(!empty($params['named']['id']))
        {
            $aBlock = $this->Block->findById($params['named']['id']);
            
            if(!empty($aBlock))
            {
                $isEdit = true;
            }
        }
        
        if($isEdit)
        {
            $this->set('aBlock', $aBlock);
        }
    }
    
    public function manager_add_element()
    {
        $params = $this->request->params;
        $isEdit = false;
        $this->set('title', "Liaison d'un élément à un block");
        
        if (empty($params['named']['id'])) 
        {
            $this->Session->setFlash("Le block que vous demndez n'exite pas.", 'alert', array('type' => AppController::TYPE_WARNING));
            $this->redirect(array(
                'manager' => true,
                'plugin' => 'block',
                'controller' => 'block',
                'action' => 'index'
            ));
        }
        
        if(!empty($params['named']['element_id']))
        {
            $aElement = $this->Element->find('first', array(
                'conditions' => array(
                    'id' => $params['named']['element_id']
                )
            ));
            
            if(!empty($aElement))
            {
                $isEdit = true;
            }
        }
        
        $iId = $params['named']['id'];
        
        if (!empty($this->data)) 
        {            
            if(empty($this->data['Element']['blocks_id']))
            {
                $this->Session->setFlash("L'élement n'a pas pu être lié.", 'alert', array('type' => AppController::TYPE_WARNING));
                $this->redirect(array(
                    'manager' => true,
                    'plugin' => 'block',
                    'controller' => 'block',
                    'action' => 'view_element',
                    'id' => $iId
                ));
            }
            
            if ($this->Element->save($this->data)) 
            {
                $this->Session->setFlash("L'élément est lié au block.", 'alert');
                $this->redirect(array(
                    'manager' => true,
                    'plugin' => 'block',
                    'controller' => 'block',
                    'action' => 'view_element',
                    'id' => $iId
                ));
            }
        }
        
        $aModules = $this->Module->findModulesTreeForSelect(array(
            'Plugin' => array(
                'ChildPlugin'
            )
        ));
        
        $this->set('aModules', $aModules);
        
        $this->set('iId', $iId);
        $this->set('aBlocks', $this->Module->getFindBlocksForSelect());
        
        if($isEdit)
        {
            $this->set('isEdit', $isEdit);
            $this->set('aElement', $aElement);
        }
    }
    
    public function manager_delete_element()
    {
        $params = $this->request->params;
        
        if(!empty($params['named']['element_id']))
        {
            $aElement = $this->Element->find('first', array(
                'conditions' => array(
                    'id' => $params['named']['element_id']
                )
            ));
            
            if (!empty($aElement)) 
            {
                if ($this->Element->delete($aElement['Element']['id'])) 
                {
                    $this->Session->setFlash("L'élément est supprimé !", 'alert');
                    $this->redirect(array(
                        'manager' => true,
                        'plugin' => 'block',
                        'controller' => 'block',
                        'action' => 'index'
                    ));
                }
            }
            
            $this->Session->setFlash("Impossible de supprimer l'élément !", 'alert', array('type' => AppController::TYPE_WARNING));
            $this->redirect($this->referer());
        }
        
        return $this->render(false);
    }
    
    public function manager_view_element()
    {
        $params = $this->request->params;
        $this->set('title', "Liste des éléments liés au block");
        
        if (empty($params['named']['id'])) 
        {
            $this->Session->setFlash("Le block que vous demndez n'exite pas.", 'alert', array('type' => AppController::TYPE_WARNING));
            $this->redirect(array(
                'manager' => true,
                'plugin' => 'block',
                'controller' => 'block',
                'action' => 'index'
            ));
        }   
        
        $iId = $params['named']['id'];
        
        $this->set('iId', $iId);
        $this->set('aElements', $this->Block->getElementBlockForTable($iId));
    }
    
    public function manager_delete()
    {
        $params = $this->request->params;
        
        if(empty($params['named']['id']))
        {
            $this->Session->setFlash("Impossible de supprimer le block selectionné !", 'alert', array('type' => AppController::TYPE_WARNING));
            $this->redirect($this->referer());
        }
        
        $aBlock = $this->Block->find('first', array(
            'fields' => array(
                'id'
            ),
            'contain' => array(
                'Menu' => array(
                    'fields' => array(
                        'id',
                        'blocks_id'
                    )
                )
            ),
            'conditions' => array(
                'id' => $params['named']['id']
            )
        ));
        
        foreach($aBlock['Menu'] as $aMenu)
        {
            $this->Menu->delete($aMenu['id']);
        }
        
        $this->Block->delete($aBlock['Block']['id']);
        
        return $this->render(false);
    }
            
}

?>
