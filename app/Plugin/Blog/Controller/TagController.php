<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TagController
 *
 * @author Admin
 */
class TagController extends BlogAppController
{
    public $uses = array(
        'Blog.Term'
    );
    
    public function manager_index()
    {
        $this->set('title', "Gestion de tags");
        
        $aTerms = $this->Term->find('all', array(
            'fields' => array(
                'id',
                'title'
            ),
            'conditions' => array(
                'type' => 'tag'
            )
        ));
        
        $this->set('aTerms', $aTerms);
    }
    
    public function manager_add()
    {
        $this->set('title', "Ajout d'un tag");
        
        $isEdit = false;
        $params = $this->request->params;
        
        if(!empty($this->data))
        {
            $data = $this->data;
            $data['Term']['type'] = 'tag';
            
            if($this->Term->save($data))
            {
                $data['Table']['name'] = 'tag';
                $data['Table']['table_id'] = $this->Term->id;
                
                $this->requestAction(array(
                    'manager' => false,
                    'block' => true,
                    'plugin' => 'block',
                    'controller' => 'block',
                    'action' => 'post'
                ), array(
                    'data' => $data
                ));
                
                $this->Session->setFlash("Le tag est sauvegardée !", 'alert');
                $this->redirect(array(
                    'manager' => true,
                    'plugin' => 'blog',
                    'controller' => 'tag',
                    'action' => 'add',
                    'id' => 'tag_' . $this->Term->id
                ));
            }
        }
        
        if(!empty($params['named']['id']))
        {
            $ex = explode('_', $params['named']['id']);
            $iId = $ex[1];
            
            $aTerm = $this->Term->find('first', array(
                'conditions' => array(
                    'id' => $iId
                )
            ));
            
            if(!empty($aTerm))
            {
                $isEdit = true;
            }
        }
        
        if($isEdit)
        {
            $this->set('isEdit', $isEdit);
            $this->set('aTerm', $aTerm);
        }
    }
    
    public function manager_delete()
    {
        $params = $this->request->params;
        
        if (!empty($params['named']['id'])) 
        {
            $ex = explode('_', $params['named']['id']);
            $iId = $ex[1];
            
            $data['Table']['name'] = 'tag';
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
            
            if($this->Term->deleteAll(array(
                'id' => $iId
            ), false))
            {
                $this->Session->setFlash("Le tag est supprimée !", 'alert');
                $this->redirect($this->referer());
            }
        }
        
        return $this->render(false);
    }
}

?>
