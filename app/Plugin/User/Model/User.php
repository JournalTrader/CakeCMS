<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author nicolasmoricet
 */
class User extends AppModel 
{
    public $actsAs = array(
        'Acl' => array(
            'requester'
        )
    );
    
    public $belongsTo = array(
        'Group' => array(
            'className' => 'Acl.Group',
            'foreignKey' => 'groups_id'
        )
    );
    
    public $hasOne = array(
        'Profile' => array(
            'className' => 'User.Profile',
            'foreignKey' => 'users_id'
        )
    );
    
    function parentNode() 
    {
        if (!$this->id && empty($this->data)) 
        {
            return null;
        }
        
        if (isset($this->data['User']['group_id'])) 
        {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        
        if (!$groupId) 
        {
            return null;
        } else {
            return array('Group' => array(
                    'id' => $groupId
                )
            );
        }
    }
    
    public function getById($iId)
    {
        return $this->find('first', array(
            'contain' => array(
                'Profile'
            ),
            'conditions' => array(
                'User.id' => $iId
            )
        ));
    }
    
    public function beforeSave($options = array()) 
    {
        if(!empty($this->data))
        {
            if(!empty($this->data['User']['password']))
            {
                $this->data['User']['password'] = Security::hash($this->data['User']['password'], 'md5');
            }
        }
        
        return true;
    }
}

?>
