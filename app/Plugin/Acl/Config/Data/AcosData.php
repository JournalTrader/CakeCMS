<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArosData
 *
 * @author Admin
 */
class AcosData 
{
    public $table = 'acos';
    
    public $records = array(
        array(
            'id' => 1,
            'parent_id' => null,
            'model' => 'Plugin',
            'foreign_key' => 1,
            'alias' => 'manager/module/module/index',
            'lft' => 1,
            'rght' => 2
        ),
        array(
            'id' => 2,
            'parent_id' => null,
            'model' => 'Plugin',
            'foreign_key' => 2,
            'alias' => 'manager/module/module/installer',
            'lft' => 3,
            'rght' => 4
        ),
        array(
            'id' => 3,
            'parent_id' => null,
            'model' => 'Plugin',
            'foreign_key' => 3,
            'alias' => 'manager/module/module/uninstall',
            'lft' => 5,
            'rght' => 6
        ),
        array(
            'id' => 4,
            'parent_id' => null,
            'model' => 'Plugin',
            'foreign_key' => 4,
            'alias' => 'ajax/module/module/activate',
            'lft' => 7,
            'rght' => 8
        ),
        array(
            'id' => 5,
            'parent_id' => null,
            'model' => 'Plugin',
            'foreign_key' => 5,
            'alias' => 'manager/block/block/index',
            'lft' => 9,
            'rght' => 10
        ),
        array(
            'id' => 6,
            'parent_id' => null,
            'model' => 'Plugin',
            'foreign_key' => 6,
            'alias' => 'manager/block/block/add',
            'lft' => 11,
            'rght' => 12
        ),
        array(
            'id' => 7,
            'parent_id' => null,
            'model' => 'Plugin',
            'foreign_key' => 7,
            'alias' => 'manager/menu/menu/index',
            'lft' => 13,
            'rght' => 14
        ),
        array(
            'id' => 8,
            'parent_id' => null,
            'model' => 'Plugin',
            'foreign_key' => 8,
            'alias' => 'manager/menu/menu/add',
            'lft' => 15,
            'rght' => 16
        )
    );    
}

?>
