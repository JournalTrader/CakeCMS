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
    
    public $hasMany = array(
        'Menus' => array(
            'className' => 'Menu',
            'foreignKey' => 'blocks_id'
        )
    );
    
    public function getAllMenus($alias = null)
    {
        $select = 'all';
        
        $conditions = array(
            'type' => Block::TYPE_MENU
        );
        
        if(!is_null($alias))
        {
            $conditions['alias'] = $alias;
            $select = 'first';
        }
        
        return $this->find($select, array(
            'conditions' => $conditions
        ));
    }
    
    public function getBlockMenus($alias = null)
    {
        $aBlocks = $this->getAllMenus($alias);
        
        $aMenus = $this->Menus->find('all', array(
            'conditions' => array(
                'blocks_id' => $aBlocks['Block']['id'],
                'parent_id' => 0
            )
        ));
        
        foreach($aMenus as $aKey => $aMenu)
        {
            $aMenus[$aKey]['Menus']['ChildMenus'] = $this->Menus->find('all', array(
                'conditions' => array(
                    'parent_id' => $aMenu['Menus']['id']
                )
            ));
        }
        
        return $aMenus;
    }
    
    public function getAllMenusForSelect()
    {
        $aData = array();
        $aData[0] = "Choisir un emplacement";
        
        $aMenus = $this->getAllMenus();
        
        foreach ($aMenus as $aMenu) 
        {
            $aData[$aMenu['Block']['id']] = $aMenu['Block']['name'];
        }
        
        return $aData;
    }
    
    public function getAllElements()
    {
        return $this->find('all', array(
            'conditions' => array(
                'type' => Block::TYPE_ELEMENT
            )
        ));
    }
    
    public function getMenuBlockForTable()
    {
        $aList = array();
        
        $aBlocks = $this->find('all', array(
            'contain' => array(
                'Menus' => array(
                    'conditions' => array(
                        'parent_id' => 0
                    ),
                    'order' => array(
                        'order' => 'asc'
                    )
                )
            ),
            'conditions' => array(
                'type' => Block::TYPE_MENU
            )
        ));
        
        foreach($aBlocks as $aKey => $aBlock)
        {
            if(!empty($aBlock['Menus']))
            {
                foreach($aBlock['Menus'] as $bKey => $aMenu)
                {
                    $aBlocks[$aKey]['Menus'][$bKey]['ChildMenus'] =  $this->Menus->find('all', array(
                        'conditions' => array(
                            'parent_id' => $aMenu['id']
                        ),
                        'order' => array(
                            'order' => 'asc'
                        )
                    ));
                }
            }
        }
        
        return $aBlocks;
    }
    
    public function beforeSave()
    {
        if(!empty($this->data))
        {
            if(empty($this->data['Block']['name'])) { return false; }
            
            $this->data['Block']['name'] = AppSpecial::ucfirst($this->data['Block']['name']);
            $this->data['Block']['alias'] = strtolower(Inflector::slug($this->data['Block']['name'], '_'));
        }
    }
}
