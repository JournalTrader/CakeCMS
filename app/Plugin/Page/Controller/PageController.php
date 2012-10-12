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
            $ex = explode('_', $params['named']['id']);
            
            $aPage = $this->Page->find('first', array(
                'conditions' => array(
                    'id' => $ex[1]
                )
            ));
            
            if(!empty($aPage))
            {
                $isEdit = true;
            }
        }
        
        if (!empty($this->data)) 
        {
            if($this->Page->save($this->data, false))
            {
                $data = $this->data;
                
                $data['Table']['name'] = 'page';
                $data['Table']['table_id'] = $this->Page->id;
                
                $this->requestAction(array(
                    'manager' => false,
                    'block' => true,
                    'plugin' => 'block',
                    'controller' => 'block',
                    'action' => 'post'
                ), array(
                    'data' => $data
                ));

                $this->Session->setFlash("La page est enregistrée !", 'alert');
                $this->redirect(array(
                    'manager' => true,
                    'plugin' => 'page',
                    'controller' => 'page',
                    'action' => 'add',
                    'id' => 'page_' . $this->Page->id
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
            $ex = explode('_', $params['named']['id']);
            $iId = $ex[1];
            
            $data['Table']['name'] = 'page';
            $data['Table']['table_id'] = $params['named']['id'];

            $data += $this->data;
            
            $this->requestAction(array(
                'manager' => false,
                'block' => true,
                'plugin' => 'block',
                'controller' => 'block',
                'action' => 'delete'
            ), array(
                'data' => $data
            ));
            
            

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
