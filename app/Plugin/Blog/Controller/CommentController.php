<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentController
 *
 * @author Admin
 */
class CommentController extends BlogAppController
{
    public $uses = array(
        'Blog.Comment',
        'Blog.Banner'
    );
    
    public $helpers = array(
        'Tools',
        'Blog.Articles',
        'Blog.Comments'
    );
    
    public function manager_index()
    {
        $aComments = $this->Comment->find('all', array(
            'contain' => array(
                'Article' => array(
                    'title',
                    'id'
                )
            ),
            'order' => array(
                'created' => 'DESC'
            )
        ));
        
        $this->set('aComments', $aComments);
    }
    
    public function manager_approved()
    {
        $approved = 1;
        $message = "Le commentaire est approuvé !";
        
        $params = $this->request->params;
        
        if(empty($params['named']['id']))
        {
            $this->Session->setFlash("Impossible d'approuver le commentaire !", 'alert', array(
                'type' => AppController::TYPE_WARNING
            ));
            $this->redirect($this->referer());
        }
        
        $ex = explode('_', $params['named']['id']);
        
        $iId = end($ex);
        
        $aComment = $this->Comment->find('first', array(
            'conditions' => array(
                'id' => $iId
            )
        ));
        
        if(empty($aComment))
        {
            $this->Session->setFlash("Impossible de modifier le commentaire !", 'alert', array(
                'type' => AppController::TYPE_WARNING
            ));
            $this->redirect($this->referer());
        }
        
        if(isset($params['named']['approved'])) 
        { 
            $approved = $params['named']['approved']; 
            $message = "Le commentaire n'est plus approuvé. Vous pouvez toujours choisir de le ré-approuver !";
        }
        
        $aComment['Comment']['approved'] = $approved;
        
        if($this->Comment->save($aComment))
        {
            $this->Session->setFlash($message, 'alert');
            $this->redirect($this->referer());
        }
        
        $this->Session->setFlash("Une erreur n'a pas permis d'approuver le commentaire !", 'alert', array(
            'type' => AppController::TYPE_ERROR
        ));
        
        $this->redirect($this->referer());
    }
    
    public function manager_undesirable()
    {
        $params = $this->request->params;
        $aBanner = array();
        
        if(empty($params['named']['id']))
        {
            $this->Session->setFlash("Impossible de bannir l'utilisateur du commentaire !", 'alert', array(
                'type' => AppController::TYPE_WARNING
            ));
            $this->redirect($this->referer());
        }
        
        $ex = explode('_', $params['named']['id']);
        
        $iId = end($ex);
        
        $aComment = $this->Comment->find('first', array(
            'conditions' => array(
                'id' => $iId
            )
        ));
        
        if(empty($aComment))
        {
            $this->Session->setFlash("Impossible de bannir l'utilisateur du commentaire !", 'alert', array(
                'type' => AppController::TYPE_WARNING
            ));
            $this->redirect($this->referer());
        }
        
        $conditions = array();
        
        if(isset($aComment['Comment']['mail']) && !empty($aComment['Comment']['mail']))
        {
            $aBanner['Banner']['mail'] = $aComment['Comment']['mail'];
            $conditions['mail'] = $aComment['Comment']['mail'];
        }
        
        if(isset($aComment['Comment']['ip']) && !empty($aComment['Comment']['ip']))
        {
            $aBanner['Banner']['ip'] = $aComment['Comment']['ip'];
            $conditions['ip'] = $aComment['Comment']['ip'];
        }
        
        if(!empty($aBanner))
        {
            $aBannerFind = $this->Banner->find('first', array(
                'conditions' => $conditions
            ));
            
            if(!$aBannerFind)
            {
                if($this->Banner->save($aBanner))
                {
                    $this->Session->setFlash("Le commentateur a été bannit !", 'alert');
                }
            }
            
        } else {
            $this->Session->setFlash("Le commentateur n'a pas pu être bannit !", 'alert');
        }
        
        if($this->Comment->delete($iId))
        {
            $this->Session->setFlash("Le commentaire est supprimé", 'alert');
            $this->redirect($this->referer());
        }
    }
    
    public function manager_delete()
    {
        $params = $this->request->params;
        
        if(empty($params['named']['id']))
        {
            $this->Session->setFlash("Impossible de supprimer le commentaire !", 'alert', array(
                'type' => AppController::TYPE_WARNING
            ));
            $this->redirect($this->referer());
        }
        
        $ex = explode('_', $params['named']['id']);
        
        $iId = end($ex);
        
        if($this->Comment->delete($iId))
        {
            $this->Session->setFlash("Le commentaire est supprimé", 'alert');
            $this->redirect($this->referer());
        }
        
        $this->Session->setFlash("Impossible de supprimer le commentaire !", 'alert', array(
            'type' => AppController::TYPE_ERROR
        ));
        $this->redirect($this->referer());
        
        return $this->render(false);
    }
    
    public function manager_add()
    {
        $params = $this->request->params;
        
        if(empty($params['named']['id']))
        {
            $this->Session->setFlash("Impossible de modifier le commentaire !", 'alert', array(
                'type' => AppController::TYPE_WARNING
            ));
            $this->redirect($this->referer());
        }
        
        $ex = explode('_', $params['named']['id']);
        
        $iId = end($ex);
        
        if(!empty($this->data))
        {
            /**
             * Utilise pour le traitement de paragraphes dans le Model Comment
             */
            $aData = $this->data;
            $aData['Data']['isPost'] = true;
            
            if($this->Comment->save($aData))
            {
                $this->Session->setFlash("Le commentaire est modifié !", 'alert');
                $this->redirect($this->referer());
            }
        }
        
        $aComment = $this->Comment->find('first', array(
            'conditions' => array(
                'id' => $iId
            )
        ));
        
        if(empty($aComment))
        {
            $this->Session->setFlash("Impossible de modifier le commentaire !", 'alert', array(
                'type' => AppController::TYPE_WARNING
            ));
            $this->redirect($this->referer());
        }
        
        $this->set('aComment', $aComment);
    }
    
    public function block_index()
    {
        $params = $this->request->params;
        
        $this->set('model', $params['named']['model']);
        $this->set('foreign_key', $params['named']['foreign_key']);
    }
    
    public function block_read()
    {
        $params = $this->request->params;
        
        $aComments = $this->Comment->find('all', array(
            'conditions' => array(
                'model' => $params['named']['model'],
                'foreign_key' => $params['named']['foreign_key'],
                'approved' => 1
            )
        ));
        
        $this->set('aComments', $aComments);
    }
    
    public function block_post()
    {        
        if(!empty($this->data))
        {
            $isValide = $this->Comment->save($this->data, array(
                'validate' => true
            ));
            
            $aBanner = $this->Banner->find('first', array(
                'conditions' => array(
                    'or' => array(
                        'mail' => $this->data['Comment']['mail'],
                        'ip' => $_SERVER['REMOTE_ADDR']
                    )
                )
            ));
            
            if($aBanner)
            {
                $this->Session->setFlash("Vous n'êtes plus autorisé à l'aisser de message sur ce blog !", 'alert', array(
                    'type' => AppController::TYPE_WARNING
                ));
                $this->redirect($this->referer());
            }
            
            if(!$isValide)
            {
                $this->Session->setFlash("Les champs précédés d'un astérisque sont obligatoire !", 'alert', array(
                    'type' => AppController::TYPE_WARNING
                ));
                $this->redirect($this->referer());
            }
            
            /**
             * Utilise pour le traitement de paragraphes dans le Model Comment
             */
            $aData = $this->data;
            $aData['Data']['isPost'] = true;
            
            if($this->Comment->save($aData))
            {
                $this->Session->setFlash("Votre commentaire est enregistré, il sera prochainement approuvé !", 'alert');
                $this->redirect($this->referer());
            }
        }
        
        return $this->render(false);
    }
}

?>
