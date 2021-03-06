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
}

?>
