<?php App::uses('AppModel', 'Model');

/**
 * Block Model
 *
 */
class Block extends AppModel 
{
    const TYPE_MENU = 'menu';
    
    const TYPE_ELEMENT = 'element';
    
    public $displayField = 'name';
    
    public function getAllMenus()
    {
        return $this->find('all', array(
            'conditions' => array(
                'type' => Block::TYPE_MENU
            )
        ));
    }
    
    public function getAllElements()
    {
        return $this->find('all', array(
            'conditions' => array(
                'type' => Block::TYPE_ELEMENT
            )
        ));
    }
    
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
