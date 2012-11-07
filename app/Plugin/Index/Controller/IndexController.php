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
class IndexController extends IndexAppController
{
    public $uses = array(
        'Option',
        'Module.Module',
        'Page.Page',
        'Blog.Article'
    );
    
    public function manager_index()
    {
        
    }
    
    public function manager_options()
    {
        $this->set('title', "Options générales");
        
        if(!empty($this->data))
        {
            if($this->Option->saveOptions($this->data))
            {
                $this->Session->setFlash("Les options sont enregsitrés !", 'alert');
                $this->redirect($this->referer());
            }
        }
        
        $aModules = $this->Module->findModulesTreeForSelect(array(
            'Plugin' => array(
                'ChildPlugin'
            )
        ));
        
        $aPages = $this->Page->getParentsPages();
        $aArticles = $this->Article->getForSelect();
        
        $this->set('aModules', $aModules);
        $this->set('aPages', $aPages);
        $this->set('aArticles', $aArticles);
    }
    
    public function public_index()
    {
        
    }
}

?>
