<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Groupe
 *
 * @author nicolasmoricet
 */
class Groupe extends AppModel
{
    public $actsAs = array(
        'Acl' => array(
            'type' => 'requester'
        )
    );
    
    public function parentNode() 
    {
        return null;
    }
    
    public function getById($iId)
    {
        return $this->find('first', array(
            'conditions' => array(
                'Groupe.id' => $iId
            )
        ));
    }
        
    public function getMaxOrder()
    {
        $oMax = $this->find('first', array(
            'fields' => array(
                'MAX(Groupe.order) AS OrderMax'
            )
        ));

        return $oMax[0]['OrderMax'];
    }
    
    public function beforeSave($options = array()) 
    {
        if (!empty($this->data['Groupe'])) 
        {
            if(empty($this->data['Groupe']['order']) || $this->data['Groupe']['order'] == 0)
            {
                $orderMax = $this->getMaxOrder();

                if(empty($orderMax)) 
                { 
                    $orderMax = 1; 
                } else { 
                    $orderMax = $orderMax + 1; 
                }

                $this->data['Groupe']['order'] = $orderMax;
            }

            if (!empty($this->data['Groupe']['name'])) 
            {
                $this->data['Groupe']['name'] = AppSpecial::ucfirst($this->data['Groupe']['name']);
            }
        }
    }
}

?>
