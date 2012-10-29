<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Groupes $Groupes
 */
class User extends AppModel 
{
    public $actsAs = array(
        'Acl' => array(
            'requester'
        )
    );
    
    public $validate = array(
        'groupes_id' => array(
            'numeric' => array(
                    'rule' => array('numeric'),
                    //'message' => 'Your custom message here',
                    //'allowEmpty' => false,
                    //'required' => false,
                    //'last' => false, // Stop validation after this rule
                    //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'mail' => array(
            'notempty' => array(
                    'rule' => array('notempty'),
                    //'message' => 'Your custom message here',
                    //'allowEmpty' => false,
                    //'required' => false,
                    //'last' => false, // Stop validation after this rule
                    //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'password' => array(
            'notempty' => array(
                    'rule' => array('notempty'),
                    //'message' => 'Your custom message here',
                    //'allowEmpty' => false,
                    //'required' => false,
                    //'last' => false, // Stop validation after this rule
                    //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        )
    );
    
    public $belongsTo = array(
        'Groupes' => array(
            'className' => 'Groupes',
            'foreignKey' => 'groupes_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    public function parentNode() 
    {    if (!$this->id && empty($this->data)) 
        {        
            return null;    
        }    
        
        $data = $this->data;  
        
        if (empty($this->data)) 
        {        
            $data = $this->read();    
        }    
        
        if (!$data['User']['groups_id']) 
        {        
            return null;  
        } else {        
            return array(
                'Group' => array(
                    'id' => $data['User']['groups_id']
                )
            );    
        }
    }
}
