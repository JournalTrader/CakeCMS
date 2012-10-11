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
        'Menu' => array(
            'className' => 'Menu',
            'foreignKey' => 'blocks_id'
        ),
        'Element' => array(
            'className' => 'Element',
            'foreignKey' => 'blocks_id'
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
        'alias' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'type' => array(
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
    
    public function findById($iId)
    {
        return $this->find('first', array(
            'conditions' => array(
                'id' => (int) $iId
            )
        ));
    }
    
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
        
        $aMenus = $this->Menu->find('all', array(
            'conditions' => array(
                'blocks_id' => $aBlocks['Block']['id'],
                'parent_id' => 0
            ),
            'order' => array(
                'order' => 'asc'
            )
        ));
        
        foreach($aMenus as $aKey => $aMenu)
        {                    
            $plugin = ClassRegistry::init('Module.Plugin');
            
            $aPlugin = $plugin->find('first', array(
                'conditions' => array(
                    'id' => $aMenu['Menu']['plugins_id'],
                    'parent_id' => 0
                )
            ));
            
            $aMenus[$aKey]['Menu']['Plugin'] = $aPlugin['Plugin'];
            
            $aMenus[$aKey]['Menu']['ChildMenus'] = $this->Menu->find('all', array(
                'conditions' => array(
                    'parent_id' => $aMenu['Menu']['id']
                ),
                'order' => array(
                    'order' => 'asc'
                )
            ));
            
            if(!empty($aMenus[$aKey]['Menu']['ChildMenus']))
            {
                foreach($aMenus[$aKey]['Menu']['ChildMenus'] as $bKey => $aChildMenus)
                {
                    $aPlugin = $plugin->find('first', array(
                        'conditions' => array(
                            'id' => $aChildMenus['Menu']['plugins_id']
                        )
                    ));
                    
                    $aMenus[$aKey]['Menu']['ChildMenus'][$bKey]['Plugin'] = $aPlugin['Plugin'];
                }
                
                // ksort($aMenus[$aKey]['Menu']['ChildMenus']);
            }
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
                'Menu' => array(
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
            if(!empty($aBlock['Menu']))
            {
                foreach($aBlock['Menu'] as $bKey => $aMenu)
                {
                    $aBlocks[$aKey]['Menu'][$bKey]['ChildMenus'] =  $this->Menu->find('all', array(
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
    
    public function getElementBlockForTable($iId)
    {
        $aElements = $this->find('first', array(
            'contain' => array(
                'Element'
            ),
            'conditions' => array(
                'type' => Block::TYPE_ELEMENT,
                'id' => $iId
            )
        ));
        
        return $aElements;
    }
    
    public function getElementsBlockByAlias($alias)
    {
        $hasPlugin = false;
        
        $aElements = $this->find('first', array(
            'fields' => array(
                'id',
                'type'
            ),
            'contain' => array(
                'Element' => array(
                    'fields' => array(
                        'id',
                        'plugins_id',
                        'blocks_id'
                    )
                )
            ),
            'conditions' => array(
                'type' => Block::TYPE_ELEMENT,
                'alias' => $alias
            )
        ));
        
        if(!empty($aElements['Element']))
        {
            foreach($aElements['Element'] as $aKey => $aElement)
            {
                $plugin = ClassRegistry::init('Module.Plugin');

                $aPlugin = $plugin->find('first', array(
                    'fields' => array(
                        'id',
                        'prefix',
                        'plugin',
                        'controller',
                        'action'
                    ),
                    'conditions' => array(
                        'id' => $aElement['plugins_id'],
                        'is_active' => true
                    )
                ));

                if(!empty($aPlugin))
                {
                    $hasPlugin = true;
                    $aElements['Element'][$aKey]['Plugin'] = $aPlugin['Plugin'];
                }
            }
        }
                
        if($hasPlugin)
        {
            return $aElements;
        }
        
        return false;
    }
    
    public function beforeSave($options = array())
    {
        if(!empty($this->data))
        {
            if(empty($this->data['Block']['name'])) { return false; }
            
            $this->data['Block']['name'] = AppSpecial::ucfirst($this->data['Block']['name']);
            $this->data['Block']['alias'] = strtolower(Inflector::slug($this->data['Block']['name'], '_'));
            
            if($this->data['Block']['type'] == 0) 
            { 
                $this->data['Block']['type'] = self::TYPE_ELEMENT;
            }
        }
        
        return true;
    }
}
