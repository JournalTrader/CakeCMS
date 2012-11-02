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
class ArosData 
{
    public $table = 'aros';
    
    public $records = array(
        array(
            'id' => 1,
            'parent_id' => null,
            'model' => 'Group',
            'foreign_key' => 1,
            'alias' => null,
            'lft' => 1,
            'rght' => 2
        ),
        array(
            'id' => 2,
            'parent_id' => null,
            'model' => 'Group',
            'foreign_key' => 2,
            'alias' => null,
            'lft' => 3,
            'rght' => 4
        ),
        array(
            'id' => 3,
            'parent_id' => null,
            'model' => 'Group',
            'foreign_key' => 3,
            'alias' => null,
            'lft' => 5,
            'rght' => 6
        )
    );    
}

?>
