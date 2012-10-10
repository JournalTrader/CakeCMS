<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PagesController
 *
 * @author nicolasmoricet
 */
class PageController extends PageAppController
{
    public function manager_index()
    {
        $aPages = $this->Page->find('all');
        
        $this->set('aPages', $aPages);
    }
    
    public function manager_add()
    {
        $isEdit = false;
        $params = $this->request->params;
        
        if(!empty($params['named']['id']))
        {
            $aPage = $this->Page->find('first', array(
                'conditions' => array(
                    'id' => $params['named']['id']
                )
            ));
            
            if(!empty($aPage))
            {
                $isEdit = true;
            }
        }
        
        if (!empty($this->data)) 
        {
            if($this->Page->save($this->data))
            {
                $this->Session->setFlash("La page est enregistrée !", 'alert');
                $this->redirect(array(
                    'manager' => true,
                    'plugin' => 'page',
                    'controller' => 'page',
                    'action' => 'index'
                ));
            }
        }
        
        $this->set('aParents', $this->Page->getParentsPages());
        
        if($isEdit)
        {
            $this->set('aPage', $aPage);
            $this->set('isEdit', $isEdit);
        }
    }
    
    public function manager_delete()
    {
        $params = $this->request->params;
        
        if (!empty($params['named']['id'])) 
        {
            $iId = $params['named']['id'];
            
            if($this->Page->delete($iId))
            {
                $this->Session->setFlash("La page est supprimée !", 'alert');
                $this->redirect($this->referer());
            }
        }
        
        return $this->render(false);
    }
    
    public function index()
    {
        
    }
}

?>
