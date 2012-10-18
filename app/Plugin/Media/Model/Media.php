<?php
App::uses('AppModel', 'Model');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Media
 *
 * @author nicolasmoricet
 */
class Media extends AppModel
{    
    public function getById($iId)
    {
        return $this->find('first', array(
            'conditions' => array(
                'id' => $iId
            )
        ));
    }
    
    public function beforeSave($options = array()) 
    {
        if($this->data)
        {
            if(!empty($this->data['Media']['name']))
            {
                $this->data['Media']['name'] = AppSpecial::ucfirst($this->data['Media']['name']);
            }
        }
        
        return true;
    }
}

?>
