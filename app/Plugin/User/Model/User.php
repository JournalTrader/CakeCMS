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
    
    public function parentNode() 
    {
        if (!$this->id && empty($this->data)) 
        {
            return null;
        }
        
        if (isset($this->data['User']['groupes_id'])) 
        {
            $groupId = $this->data['User']['groupes_id'];
        } else {
            $groupId = $this->field('groupes_id');
        }
        
        if (!$groupId) 
        {
            return null;
        } else {
            return array(
                'Groupe' => array(
                    'id' => $groupId
                )
            );
        }
    }    
    
    public $hasOne = array(
        'Profile' => array(
            'className' => 'Profile',
            'foreignKey' => 'users_id'
        )
    );
    
    public $belongsTo = array(
        'Groupe' => array(
            'className' => 'Acl.Groupe',
            'foreignKey' => 'groupes_id'
        )
    );

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
        if (!empty($this->data)) 
        {
            $aUsers = $this->find('all', array(
                'fields' => array(
                    'id'
                )
            ));
            
            if(empty($this->data['User']['groupes_id']) && empty($aUsers))
            {
                $this->data['User']['groupes_id'] = 1;
            } else if(empty($this->data['User']['groupes_id'])) {
                $this->data['User']['groupes_id'] = 2;
            }
            
            if(!empty($this->data['User']['password']))
            {
                $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
            }
        }
        
        return true;
    }
}

?>
