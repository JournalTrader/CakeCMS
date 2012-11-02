<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuData
 *
 * @author Admin
 */
class MenusData 
{
    public $table = 'menus';
    
    public $records = array(
        array(
            'id' => 1,
            'name' => 'Modules',
            'blocks_id' => 1,
            'plugins_id' => 1, 
            'articles_id' => null,
            'order' => 1,
            'is_active' => 1,
            'parent_id' => 0,
            'lft' => 1,
            'rght' => 2,
            'display' => 0,
            'display_absolute' => 0
        ),
        array(
            'id' => 2,
            'name' => 'Menus',
            'blocks_id' => 1,
            'plugins_id' => 7, 
            'articles_id' => null,
            'order' => 2,
            'is_active' => 1,
            'parent_id' => 0,
            'lft' => 3,
            'rght' => 8,
            'display' => 0,
            'display_absolute' => 0
        ),
        array(
            'id' => 3,            
            'name' => 'Gestion des menus',
            'blocks_id' => 1,
            'plugins_id' => 7, 
            'articles_id' => null,
            'order' => 3,
            'is_active' => 1,
            'parent_id' => 2,
            'lft' => 4,
            'rght' => 5,
            'display' => 0,
            'display_absolute' => 0
        ),
        array(
            'id' => 4,
            'name' => 'Ajouter un menu',
            'blocks_id' => 1,
            'plugins_id' => 8, 
            'articles_id' => null,
            'order' => 4,
            'is_active' => 1,
            'parent_id' => 2,
            'lft' => 6,
            'rght' => 7,
            'display' => 0,
            'display_absolute' => 0
        ),
    );
}

?>
