<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of schema
 *
 * @author nicolasmoricet
 */
class AppSchema extends CakeSchema 
{
    public $name = 'App';

    public function before($event = array()) {
            return true;
    }

    public function after($event = array()) { }
    
    public $acos = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
        'model' => array('type' => 'string', 'null' => true),
        'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
        'alias' => array('type' => 'string', 'null' => true),
        'lft' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
        'rght' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
    );

    public $aros = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
        'model' => array('type' => 'string', 'null' => true),
        'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
        'alias' => array('type' => 'string', 'null' => true),
        'lft' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
        'rght' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
    );

    public $aros_acos = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'aro_id' => array('type' => 'integer', 'null' => false, 'length' => 10, 'key' => 'index'),
        'aco_id' => array('type' => 'integer', 'null' => false, 'length' => 10),
        '_create' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
        '_read' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
        '_update' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
        '_delete' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'ARO_ACO_KEY' => array('column' => array('aro_id', 'aco_id'), 'unique' => 1))
    );
    
    public $users = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'groupes_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
        'password' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'mail' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'activation_key' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 60, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'status' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
        'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );    
    
    public $profiles = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'users_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'last_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'first_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );    
    
    public $terms_taxonomies = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'terms_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'model_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'model' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );    
    
    public $terms = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'parent_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'lft' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
        'rght' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );    
    
    public $seos = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'slug' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'keywords' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'table_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );    
    
    public $plugins = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'parent_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'is_main' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 1),
        'is_active' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 1),
        'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'prefix' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'plugin' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'controller' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'action' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );    
    
    public $pages = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'parent_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'content' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'lft' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
        'rght' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
        'status' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 1),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );    
    
    public $options = array(
        'key' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'content' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'indexes' => array('PRIMARY' => array('column' => 'key', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );    
    
    public $modules = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'plugins_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'is_active' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 1),
        'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'description' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'author' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'version' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'site' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'url' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );    
    
    public $menus = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'blocks_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'plugins_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'articles_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'parent_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'order' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
        'is_active' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 1),
        'lft' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
        'rght' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
        'display' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 10),
        'display_absolute' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 1),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );    

    public $media = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'src' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'size' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 10),
        'category' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'location' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    ); 
    
    public $groupes = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'order' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 10),
        'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    ); 
    
    public $elements = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'plugins_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'blocks_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'display' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 10),
        'display_absolute' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 1),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );    
    
    public $blocks = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'alias' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );    
    
    public $articles = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
        'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'content' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'status' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 1),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );    

}
    

?>
