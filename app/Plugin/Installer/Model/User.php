<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Groupes $Groupes
 */
class User extends AppModel 
{
/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'groupes_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'mail' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
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
        ),
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
}
