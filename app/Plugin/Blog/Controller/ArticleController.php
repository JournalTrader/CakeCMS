<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticleController
 *
 * @author Admin
 */
class ArticleController extends BlogAppController
{
    public $uses = array(
        'Blog.Article',
        'Seo.Seo'
    );
    
    public $helpers = array(
        'Blog.Articles'
    );
    
    public function public_index()
    {
        $aArticles = $this->Article->find('all', array(
            'conditions' => array(
                'status' => 1
            )
        ));
        
        foreach($aArticles as $aKey => $aArticle)
        {
            $seo = $this->Seo->find('first', array(
                'conditions' => array(
                    'table_id' => 'article_' . $aArticle['Article']['id']
                )
            ));
            
            $aArticles[$aKey]['Seo'] = $seo['Seo'];
        }
        
        $this->set('aArticles', $aArticles);
    }

    public function public_read($id = null, $slug = null)
    {
        $params = $this->request->params;
        
        if(empty($params['named']['id']))
        {
            if(is_null($id) && empty($params['id']))
            {
                throw new NotFoundException("L'article que vous demandez n'existe pas !");
            }
            
            if(!is_null($id))
            {
                $params['named']['id'] = $id;
            }
            
            if(!empty($params['id']))
            {
                $params['named']['id'] = $params['id'];
            }
        }
        
        $aArticle = $this->Article->getByIdForBlog($params['named']['id']);
        
        if(empty($aArticle))
        {
            throw new NotFoundException("L'article que vous demandez n'existe pas !");
        }
        
        $this->set('aArticle', $aArticle);
        $this->set('iId', $params['named']['id']);
    }
    
    public function manager_index()
    {
        $this->set('title', "Gestion des articles");
        $aArticles = $this->Article->find('all');
        
        $this->set('aArticles', $aArticles);
    }
    
    public function manager_add()
    {
        $this->set('title', "Rédaction d'article");
        
        $isEdit = false;
        $params = $this->request->params;
        
        if(!empty($params['named']['id']))
        {
            $ex = explode('_', $params['named']['id']);
            
            $iId = $ex[1];
            
            $aArticle = $this->Article->find('first', array(
                'conditions' => array(
                    'id' => $iId
                )
            ));
            
            if(!empty($aArticle))
            {
                $isEdit = true;
            }
        }
        
        if(!empty($this->data))
        {
            if($this->Article->save($this->data))
            {
                $data = $this->data;
                
                $data['Table']['name'] = 'article';
                $data['Table']['table_id'] = $this->Article->id;
                
                $this->requestAction(array(
                    'manager' => false,
                    'block' => true,
                    'plugin' => 'block',
                    'controller' => 'block',
                    'action' => 'post'
                ), array(
                    'data' => $data
                ));
                
                $this->Session->setFlash("L'article est sauvegardé !", 'alert');
                $this->redirect(array(
                    'manager' => true,
                    'plugin' => 'blog',
                    'controller' => 'article',
                    'action' => 'add',
                    'id' => 'article_' . $this->Article->id
                ));
            }
        }
        
        if($isEdit)
        {
            $this->set('isEdit', $isEdit);
            $this->set('aArticle', $aArticle);
        }
    }
    
    public function manager_delete()
    {
        $params = $this->request->params;
        
        if (!empty($params['named']['id'])) 
        {
            $ex = explode('_', $params['named']['id']);
            $iId = $ex[1];
            
            $data['Table']['name'] = 'article';
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
            
            if($this->Article->delete($iId))
            {
                $this->Session->setFlash("La l'article est supprimée !", 'alert');
                $this->redirect($this->referer());
            }
        }
        
        return $this->render(false);
    }
}

?>
