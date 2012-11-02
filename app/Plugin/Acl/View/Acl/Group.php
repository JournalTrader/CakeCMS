<?php
App::uses('AppModel', 'Model');

class Group extends AppModel 
{    
    public $actsAs = array(
        'Tree'
    );
    
    public $displayField = 'name';
    
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
}
