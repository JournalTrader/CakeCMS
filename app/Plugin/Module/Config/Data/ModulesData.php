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
class ModulesData 
{
    public $table = 'modules';
    
    public $records = array(
        array(
            'id' => '1',
            'plugins_id' => '1',
            'name' => 'Module manager',
            'description' => "Permet l'installation et la gestion de modules qui ajoutent de fonctionnalités au CMS.",
            'author' => 'MORICET Nicolas',
            'version' => '1.0.0',
            'site' => 'Mon super CMS',
            'url' => 'http://www.cms.com',
            'is_active' => true
        ),
        array(
            'id' => '2',
            'plugins_id' => '5',
            'name' => 'Manager block',
            'description' => "Permet la création et la gestion d'emplacement pour l'insertion de menus et d'éléments.",
            'author' => 'MORICET Nicolas',
            'version' => '1.0.0',
            'site' => 'Mon super CMS',
            'url' => 'http://www.cms.com',
            'is_active' => true
        ),
        array(
            'id' => '3',
            'plugins_id' => '7',
            'name' => 'Module menu',
            'description' => 'Permet la création et la gestion de menus',
            'author' => 'MORICET Nicolas',
            'version' => '1.0.0',
            'site' => 'Mon super CMS',
            'url' => 'http://www.cms.com',
            'is_active' => true
        )
    );
}

?>
