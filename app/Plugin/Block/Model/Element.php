<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Element
 *
 * @author nicolasmoricet
 */
class Element extends AppModel
{    
    public $belongsTo = array(
        'Plugin' => array(
            'className' => 'plugin',
            'foreignKey' => 'plugins_id'
        )
    );
    
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        )
    );
    
    public function beforeSave($options = array()) 
    {
        if (!empty($this->data)) 
        {
            if(!empty($this->data['Element']['name']))
            {
                $this->data['Element']['name'] = AppSpecial::ucfirst($this->data['Element']['name']);
            }
            
        }
        
        return true;
    }
}

?>
