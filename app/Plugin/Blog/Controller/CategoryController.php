<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryController
 *
 * @author Admin
 */
class CategoryController extends BlogAppController
{
    public $helpers = array(
        'Blog.Categories'
    );
    
    public $uses = array(
        'Blog.Term'
    );
    
    public function block_category()
    {
        $aTerms = $this->Term->find('all', array(
            'conditions' => array(
                'type' => 'category'
            )
        ));
        
        $this->set('aTerms', $aTerms);
    }
    
    public function manager_index()
    {
        $this->set('title', "Gestion des catégories");
        
        $aTerms = $this->Term->find('all', array(
            'fields' => array(
                'id',
                'title'
            ),
            'conditions' => array(
                'type' => 'category'
            )
        ));
        
        $this->set('aTerms', $aTerms);
    }
    
    public function manager_add()
    {
        $this->set('title', "Création d'une catégorie");
        
        $isEdit = false;
        $params = $this->request->params;
        
        if(!empty($this->data))
        {
            $data = $this->data;
            $data['Term']['type'] = 'category';
            
            if($this->Term->save($data))
            {
                $data['Table']['name'] = 'category';
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
                
                $this->Session->setFlash("La catégorie est sauvegardée !", 'alert');
                $this->redirect(array(
                    'manager' => true,
                    'plugin' => 'blog',
                    'controller' => 'category',
                    'action' => 'add',
                    'id' => 'category_' . $this->Term->id
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
        
        $aParents[0] = "Catégories parents";
        
        $aParents += $this->Term->generateTreeList(array(
            'type' => 'category'
        ), '{n}.Term.id','{n}.Term.title', '--');
        
        $this->set('aParents', $aParents);
        
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
            
            $data['Table']['name'] = 'category';
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
                $this->Session->setFlash("La catégorie est supprimée !", 'alert');
                $this->redirect($this->referer());
            }
        }
        
        return $this->render(false);
    }
}

?>
