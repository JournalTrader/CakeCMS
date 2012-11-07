<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Option
 *
 * @author nicolasmoricet
 */
class Option extends AppModel
{
    public function getOption($key)
    {
        $option = $this->find('first', array(
            'conditions' => array(
                'key' => $key
            )
        ));
        
        return $option['Option']['value'];
    }
    
    public function saveOptions($data)
    {
        foreach($data['Option'] as $key => $option)
        {
            $isEdit = true;
            
            $aOption = $this->find('first', array(
                'conditions' => array(
                    'key' => $key
                )
            ));
            
            if(empty($aOption))
            {
                $isEdit = false;
                $aOption['Option']['key'] = $key;
                $aOption['Option']['value'] = $option;
            } 
            
            if($isEdit)
            {
                $aOption['Option']['value'] = $option;
               
                if(!$this->updateAll(array(
                    'Option.value' => '\'' . $aOption['Option']['value'] . '\''
                ), array(
                    'Option.key' => $aOption['Option']['key']
                )))
                {
                    return false;
                }
            } else {
                if(!$this->save($aOption))
                {
                    return false;
                }
            }
        }
        
        return true;
    }
}

?>
