<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profile
 *
 * @author nicolasmoricet
 */
class Profile extends AppModel
{    
    public function beforeSave($options = array()) 
    {
        if (!empty($this->data))
        {
            if (!empty($this->data['Profile']['first_name'])) 
            {
                $this->data['Profile']['first_name'] = AppSpecial::ucfirst($this->data['Profile']['first_name']);
            }
            
            if (!empty($this->data['Profile']['last_name'])) 
            {
                $this->data['Profile']['last_name'] = AppSpecial::ucfirst(strtoupper($this->data['Profile']['last_name']));
            }
        }
        
        return true;
    }
}

?>
