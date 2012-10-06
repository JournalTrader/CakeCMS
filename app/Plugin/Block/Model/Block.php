<?php App::uses('AppModel', 'Model');

/**
 * Block Model
 *
 */
class Block extends AppModel 
{
    public $displayField = 'name';
    
    public function beforeSave()
    {
        if(!empty($this->data))
        {
            if(empty($this->data['Block']['name'])) { return false; }
            
            $this->data['Block']['name'] = AppSpecial::ucfirst($this->data['Block']['name']);
            $this->data['Block']['identifiant'] = strtolower(Inflector::slug($this->data['Block']['name'], '_'));
        }
    }
}
