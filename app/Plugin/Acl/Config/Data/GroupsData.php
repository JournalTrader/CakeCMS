<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModulesData
 *
 * @author Admin
 */
class GroupsData 
{
    public $table = 'groups';
    
    public $records = array(
        array(
            'id' => 1,
            'parent_id' => 0,
            'name' => 'Administrateur',
            'order' => 1,
            'lft' => 1,
            'rght' => 2
        ),    
        array(
            'id' => 2,
            'parent_id' => 0,
            'name' => 'Membre',
            'order' => 2,
            'lft' => 3,
            'rght' => 4
        ),    
        array(
            'id' => 3,
            'parent_id' => 0,
            'name' => 'Visiteur',
            'order' => 3,
            'lft' => 5,
            'rght' => 6
        )    
    );    
}

?>
