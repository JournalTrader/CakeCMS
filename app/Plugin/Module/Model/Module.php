<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Module
 *
 * @author nicolasmoricet
 */
class Module extends ModuleAppModel
{
    public $belongsTo = array(
        'Plugin' => array(
            'className' => 'Module.Plugin',
            'foreignKey' => 'plugins_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    public function findModuleById($iId, $contain = array(), $fields = array())
    {
        return $this->find('first', array(
            'fields' => $fields,
            'contain' => $contain,
            'conditions' => array(
                'Module.id' => (int)$iId
            )
        ));
    }
}

?>
