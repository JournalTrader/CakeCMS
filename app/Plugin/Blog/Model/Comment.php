<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property Users $Users
 */
class Comment extends AppModel 
{
    public $displayField = 'name';
    
    public $validate = array(
        'content' => array(
            'notempty' => array(
                'rule' => array('notempty'),
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
        'name' => array(
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
        'Users' => array(
            'className' => 'Users',
            'foreignKey' => 'users_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Article' => array(
            'className' => 'Article',
            'foreignKey' => 'foreign_key'
        )
    );
    
    public function beforeSave($options = array()) 
    {
        if(!empty($this->data))
        {
            if(!empty($this->data['Comment']['content']) && $this->data['Data']['isPost'] == true)
            {
                $ex = explode(PHP_EOL, $this->data['Comment']['content']);
                
                foreach($ex as $key => $data)
                {
                    if(!empty($data))
                    {
                        $ex[$key] = '<p>' . $data . '</p>';
                    } else {
                        $ex[$key] = '<br />';
                    }
                    
                }
                
                $content = implode(PHP_EOL, $ex);
                
                $this->data['Comment']['content'] = $content;
            }
            
            if(!empty($this->data['Comment']['name']))
            {
                $this->data['Comment']['name'] = AppSpecial::ucfirst($this->data['Comment']['name']);
            }
            
            if(empty($this->data['Comment']['id']))
            {
                $this->data['Comment']['ip'] = $_SERVER["REMOTE_ADDR"];
            }
        }
        
        return true;
    }
}
