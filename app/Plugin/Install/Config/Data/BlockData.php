<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlockData
 *
 * @author nicolasmoricet
 */
class BlockData 
{
    public $table = 'blocks';
    
    public $records = array(
        array(
            'id' => 1,
            'name' => 'Menu manager',
            'alias' => 'menu_manager',
            'type' => 'menu'
        ),
        array(
            'id' => 2,
            'name' => 'Menu public',
            'alias' => 'menu_public',
            'type' => 'menu'
        )
    );
}

?>
