<?php
App::uses('AppModel', 'Model');
/**
 * Article Model
 *
 */
class Article extends BlogAppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'status' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
        
        public function getByIdForBlog($iId)
        {
            $aArticle = $this->find('first', array(
                'conditions' => array(
                    'id' => (int) $iId
                )
            ));
            
//            $find = preg_match_all("#{%(.*)%}#", $aArticle['Article']['content'], $out, PREG_PATTERN_ORDER);
//            
//            if($find)
//            {
//                debug($out);
//            }
            
            return $aArticle;
        }
        
        public function beforeSave($options = array()) 
        {
            if (!empty($this->data['Article'])) 
            {
                if(!empty($this->data['Article']['title']))
                {
                    $this->data['Article']['title'] = AppSpecial::ucfirst($this->data['Article']['title']);
                }
            }
        }
}
