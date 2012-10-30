<?php
App::uses('AppModel', 'Model');

class Group extends AppModel 
{    
    public $actsAs = array(
        'Tree',
        'Acl' => array(
            'type' => 'requester'
        )
    );
    
    public $displayField = 'name';
    
    public $hasMany = array(
        'GroupChild' => array(
            'className' => 'Group',
            'foreignKey' => 'parent_id'
        ),
        'User' => array(
            'className' => 'User.User',
            'foreignKey' => 'groups_id'
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
            ),
        ),
        'order' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        )
    );
    
    public function parentNode() {
        return null;
    }
    
    public function getById($iId)
    {
        return $this->find('first', array(
            'conditions' => array(
                'id' => (int) $iId
            )
        ));
    }
    
    public function getForSelect($iId = null)
    {
        $conditions = null;
        
        $aGroups = array(
            0 => 'Choisir une groupe'
        );
        
        if(!is_null($iId))
        {
            $conditions = array(
                'id !=' =>  $iId
            );
        }
        
        $aGroups += $this->generateTreeList($conditions, '{n}.Group.id','{n}.Group.name', '--');
        
        return $aGroups;
    }
    
    public function getMaxOrder()
        {
            $oMax = $this->find('first', array(
                'fields' => array(
                    'MAX(Group.order) AS OrderMax'
                )
            ));
            
            return $oMax[0]['OrderMax'];
        }
    
    public function beforeSave($options = array()) 
    {
        if(!empty($this->data))
        {
            if(empty($this->data['Group']['order']) || $this->data['Group']['order'] == 0)
            {
                $orderMax = $this->getMaxOrder();

                if(empty($orderMax)) 
                { 
                    $orderMax = 1; 
                } else { 
                    $orderMax = $orderMax + 1; 
                }

                $this->data['Group']['order'] = $orderMax;
            }
            
            
            if(!empty($this->data['Group']['name'])) 
            {
                $this->data['Group']['name'] = AppSpecial::ucfirst($this->data['Group']['name']);
            }
        }
    }
}
