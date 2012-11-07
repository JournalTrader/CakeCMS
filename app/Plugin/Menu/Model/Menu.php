<?php
App::uses('AppModel', 'Model');
/**
 * Menu Model
 *
 * @property Block $Block
 * @property Plugins $Plugins
 * @property Contents $Contents
 * @property Menu $ParentMenu
 * @property Menu $ChildMenu
 */
class Menu extends AppModel 
{
    public $actsAs = array(
        'Tree',
        'Containable'
    );
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Block' => array(
			'className' => 'Block',
			'foreignKey' => 'blocks_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Plugins' => array(
			'className' => 'Plugin',
			'foreignKey' => 'plugins_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
//		'Contents' => array(
//			'className' => 'Contents',
//			'foreignKey' => 'contents_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
		'ParentMenu' => array(
			'className' => 'Menu',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ChildMenus' => array(
			'className' => 'Menu',
			'foreignKey' => 'parent_id',
//			'dependent' => false,
//			'conditions' => '',
//			'fields' => '',
//			'order' => '',
//			'limit' => '',
//			'offset' => '',
//			'exclusive' => '',
//			'finderQuery' => '',
//			'counterQuery' => ''
		)
	);
        
        public function getMaxOrder()
        {
            $oMax = $this->find('first', array(
                'fields' => array(
                    'MAX(Menu.order) AS OrderMax'
                )
            ));
            
            return $oMax[0]['OrderMax'];
        }
        
        public function beforeSave($options = array()) 
        {
            if(!empty($this->data))
            {
                if(empty($this->data['Menu']['order']) || $this->data['Menu']['order'] == 0)
                {
                    $orderMax = $this->getMaxOrder();
                    
                    if(empty($orderMax)) 
                    { 
                        $orderMax = 1; 
                    } else { 
                        $orderMax = $orderMax + 1; 
                    }
                    
                    $this->data['Menu']['order'] = $orderMax;
                }
                
                if(!isset($this->data['Menu']['parent_id']) || empty($this->data['Menu']['parent_id']))
                {
                    $this->data['Menu']['parent_id'] = 0;
                }
                
                $this->data['Menu']['name'] = AppSpecial::ucfirst($this->data['Menu']['name']);
            }
            
            return true;
        }

}
