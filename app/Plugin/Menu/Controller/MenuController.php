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
    
    public function ajax_orderingUpdate()
    {
        $error = false;
        
        if(!empty($this->data))
        {
            foreach($this->data['Menu'] as $order => $id)
            {
                $data = array();

                $data = $this->Menu->find('first', array(
                    'conditions' => array(
                        'id' => $id['id']
                    )
                ));
                
                $data['Menu']['order'] = $order + 1;
                
                $this->Menu->create();
                
                if(!$this->Menu->save($data, false))
                {
                    $error = true;
                }
            }
        
            if(!$error)
            {
                echo json_encode(array(
                    'message' => "Ordre sauvegardé !",
                    'error' => AppController::TYPE_SUCCESS
                ));
            } else {
                echo json_encode(array(
                    'message' => "L'ordre n'est pas correctement enregistré !",
                    'error' => AppController::TYPE_WARNING
                ));
            }
        }
        
        return $this->render(false);
    }
    
    public function manager_index()
    {
        $this->set('title', "Gestionnaire de menus");
        $aMenus = $this->Block->getMenuBlockForTable();
        
        $this->set('aMenus', $aMenus);
    }
    
    public function manager_add()
    {
        if(!empty($this->data))
        {            
            if($this->Menu->save($this->data))
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
        
        $aParents[0] = "Menus parents";
        
        $aParents += $this->Menu->generateTreeList(null, '{n}.Menu.id','{n}.Menu.name', '--');
        
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
