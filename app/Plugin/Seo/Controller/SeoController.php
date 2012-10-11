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
            $this->Seo->save($this->data);
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
}

?>
