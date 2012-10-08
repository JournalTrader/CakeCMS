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
        $params = $this->request->params;
        $isEdit = false;
        
        if(!empty($this->data))
        {
            if($this->Block->save($this->data))
            {
                $this->Session->setFlash("Le block est sauvagardé", 'alert');
                $this->redirect($this->referer());
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
}

?>
