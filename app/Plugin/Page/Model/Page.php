<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Page
 *
 * @author nicolasmoricet
 */
class Page extends PageAppModel
{
    public $actsAs = array(
        'Containable',
        'Tree'
    );
    
    public function getParentsPages()
    {
        $aPages = array(
            0 => 'Choisir une page'
        );
        
        return $aPages;
    }
    
    public function beforeSave($options = array())
    {
        if(!empty($this->data['Page']))
        {
            if(!empty($this->data['Page']['title']))
            {
                $this->data['Page']['title'] = AppSpecial::ucfirst($this->data['Page']['title']);
            }
            
            if(empty($this->data['Page']['parent_id']))
            {
                $this->data['Page']['parent_id'] = 0;
            }
        }
        
        return true;
    }
}

?>
