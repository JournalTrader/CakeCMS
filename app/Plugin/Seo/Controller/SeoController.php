<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SeoController
 *
 * @author nicolasmoricet
 */
class SeoController extends SeoAppController
{
    public function manager_index()
    {
        
    }
    
    public function block_form()
    {
        $isEdit = false;
        $params = $this->request->params;
        
        if ($this->data) 
        {
            $aDatas = $this->data;
            
            if(empty($this->data['Seo']['title']))
            {
                foreach($this->data as $key => $aData)
                {
                    if($key != 'Seo' && $key != 'BlockAlias' && $key != 'Table')
                    {
                        if(isset($aData['title']) && !empty($aData['title']))
                        {
                            $aDatas['Seo']['title'] = $aData['title'];
                        }
                    }
                }
            }
            
            $this->Seo->save($aDatas);
        }
        
        if(!empty($params['named']['id']))
        {
            $isEdit = true;
            
            $aSeo = $this->Seo->find('first', array(
                'conditions' => array(
                    'table_id' => $params['named']['id']
                )
            ));
        }
        
        if($isEdit)
        {
            $this->set('isEdit', $isEdit);
            $this->set('aSeo', $aSeo);
        }
    }
    
    public function block_delete()
    {
        if(!empty($this->data['Table']['table_id']))
        {
            $this->Seo->deleteAll(array(
                'table_id' => $this->data['Table']['table_id']
            ));
        }
    }
    
    public function block_head($id = null, $slug = null)
    {
        $params = $this->request->params;
        
        if(empty($params['named']['id']))
        {
            $aSeo = $this->Seo->find('first', array(
                'conditions' => array(
                    'slug' => $params['slug']
                )
            ));
            
            if(empty($aSeo['Seo']['table_id']))
            {
                return $this->render(false);
            }
            
            $ex = explode('_', $aSeo['Seo']['table_id']);
            
            $params['named']['slug'] = $params['slug'];
            $params['named']['id'] = end($ex);
        }
        
        $plugin = $params['named']['rController'];
        
        $table_id = $plugin . '_' . $params['named']['id'];
        
        $aSeo = $this->Seo->find('first', array(
            'conditions' => array(
                'table_id' => $table_id
            )
        ));
        
        if(!isset($params['named']['slug']) && empty($params['named']['slug']) && !empty($aSeo['Seo']['slug']))
        {
            $action = explode('_', $params['named']['rAction']);
            
            unset($action[0]);
            
            $this->redirect(array(
                'block' => false,
                $params['named']['rPrefix'] => true,
                'plugin' => $params['named']['rPlugins'],
                'controller' => $params['named']['rController'],
                'action' => implode('_', $action),
                'id' => $params['named']['id'],
                'slug' => $aSeo['Seo']['slug']
            ), 301);
        }
        
        if(!$aSeo)
        {
            return $this->render(false);
        }
        
        $this->set('title_for_layout', $aSeo['Seo']['title']);
        $this->set('description_for_layout', $aSeo['Seo']['description']);
        $this->set('keywords_for_layout', $aSeo['Seo']['keywords']);
    }
}

?>
