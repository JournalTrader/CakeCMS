<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author nicolasmoricet
 */
class GroupeData
{
    public $table = 'groupes';
    
    public $records = array(
        array(
            'id' => 1,
            'name' => 'Administrateur',
            'order' => 1
        ),
        array(
            'id' => 2,
            'name' => 'Member',
            'order' => 2
        ),
        array(
            'id' => 3,
            'name' => 'Visiteur',
            'order' => 3
        )
    );
}

?>
