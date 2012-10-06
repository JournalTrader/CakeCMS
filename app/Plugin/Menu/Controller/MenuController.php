<?php 

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author nicolasmoricet
 */
class MenuController extends MenuAppController
{
    public $uses = array(
        'Block.Block',
        'Module.Module',
        'Menu.Menu'
    );
    
    public function manager_index()
    {
        $aMenus = $this->Block->getMenuBlockForTable();
        
        $this->set('aMenus', $aMenus);
    }
    
    public function manager_add()
    {
        if(!empty($this->data))
        {
            if($this->Menu->save($this->data, false))
            {
                $this->Session->setFlash("Le menu est sauvegardé !", 'alert');
                $this->redirect(array(
                    'manager' => true,
                    'plugin' => 'menu',
                    'controller' => 'menu',
                    'action' => 'index'
                ));
            }
        }
        
        $this->set('title', "Ajout d'un menu");
        
        $aParents = array(
            0 => "Menus parents"
        );
        
        $aParents = array_merge($aParents, $this->Menu->generateTreeList(null, null, null, '--'));
        
        $aModules = $this->Module->findModulesTreeForSelect(array(
            'Plugin' => array(
                'ChildPlugin'
            )
        ));
        
        $this->set('aBlocks', $this->Block->getAllMenusForSelect());
        $this->set('aModules', $aModules);
        $this->set('aParents', $aParents);
    }
}

?>
