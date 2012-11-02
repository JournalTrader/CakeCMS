<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlocksData
 *
 * @author Admin
 */
class BlocksData 
{
    public $table = 'blocks';
    
    public $records = array(
        array(
            'id' => 1,
            'name' => 'Manager menu',
            'alias' => 'manager_menu',
            'type' => 'menu'
        ),
        array(
            'id' => 2,
            'name' => 'Public menu',
            'alias' => 'public_menu',
            'type' => 'menu'
        ),
        array(
            'id' => 3,
            'name' => 'Block 1',
            'alias' => 'block_1',
            'type' => 'element'
        )
    );
}

?>
