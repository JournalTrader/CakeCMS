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
}

?>
