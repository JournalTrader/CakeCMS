<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Plugin
 *
 * @author nicolasmoricet
 */
class Plugin extends ModuleAppModel
{
    public $primaryKey = 'id';

    public $belongsTo = array(
	'ParentPlugin' => array(
            'className' => 'Module.Plugin',
            'foreignKey' => 'parent_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
	'Module' => array(
            'className' => 'Module.Module',
            'foreignKey' => 'id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
	)
    );
    
    public $hasMany = array(
	'ChildPlugin' => array(
            'className' => 'Module.Plugin',
            'foreignKey' => 'parent_id',
                'dependent' => false,
		'conditions' => '',
		'fields' => '',
		'order' => '',
		'limit' => '',
		'offset' => '',
		'exclusive' => '',
		'finderQuery' => '',
		'counterQuery' => ''
        )
    );

    public function findByStructureAndMain($dStructure)
    {            
        $aPlugin = $this->find('first', array(
            'conditions' => array(
                'Plugin.prefix' => $dStructure['Plugin']['prefix'],
                'Plugin.plugin' => $dStructure['Plugin']['plugin'],
                'Plugin.controller' => $dStructure['Plugin']['controller'],
                'Plugin.action' => $dStructure['Plugin']['action'],
                'Plugin.is_main' => 1
            )
        ));
        
        $aModule = $this->Module->find('first', array(
            'conditions' => array(
                 'Module.plugins_id' => $aPlugin['Plugin']['id']
            )
        ));
            
        return array(
            'Module' => $aModule['Module'],
            'Plugin' => $aPlugin['Plugin']
        );
    }
    
}

?>
