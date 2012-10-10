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
        'Module.Module'
    );
    
    public function block_index()
    {
        
    }
    
    public function block_menu()
    {
        $params = $this->request->params;
        
        if(empty($params['named']['alias']))
        {
            return $this->render(false);
        }
        
        $aBlocks = $this->Block->getBlockMenus($params['named']['alias']);
        
        $this->set('aBlocks', $aBlocks);
        $this->set('aRequests', $params['named']);
    }
    
    public function block_element()
    {
        $params = $this->request->params;
        
        if(empty($params['named']['alias']))
        {
            return $this->render(false);
        }
        
        return $this->render(false);
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
        $this->set('title', "Liaison d'un élément à un block");
        
        $this->set('aBlocks', $this->Module->getFindBlocksForSelect());
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
