<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MediaController
 *
 * @author nicolasmoricet
 */
class MediaController extends MediaAppController
{   
    public $uses = array(
        'Media.Media'
    );
    
    public function manager_index()
    {
        
    }
    
    public function manager_add()
    {
    }
    
    public function ajax_upload()
    {
        $file       = $_FILES['file'];
        
//        debug($file);
        
        $name       = $file['name'];
        $type       = $file['type'];
        $tmp_name   = $file['tmp_name'];
        $error      = $file['error'];
        $size       = $file['size'];
        
        if($error === 0)
        {
            $dFile = array();
            
            $ex = explode('.', $name);
            
            $dFile['ext'] = end($ex);
            $dFile['file_tmp'] = $tmp_name;
            $dFile['file_name'] = time();
            $dFile['file_name_ext'] = $dFile['file_name'] . '.' . $dFile['ext'];
            $dFile['base_dir'] = WEBROOT_DIR . DS .'files' . DS;
            $dFile['year_dir'] = date('Y');
            $dFile['month_dir'] = date('m');
            $dFile['path_dir'] = $dFile['base_dir'] . $dFile['year_dir'] . DS . $dFile['month_dir'];
            $dFile['path_file'] = $dFile['path_dir'] . DS . $dFile['file_name_ext'];
            
            if(!file_exists(APP . $dFile['base_dir']))
            {
                mkdir(APP . $dFile['base_dir']);
            }
            
            if(!file_exists(APP . $dFile['base_dir'] . $dFile['year_dir']))
            {
                mkdir(APP . $dFile['base_dir'] . $dFile['year_dir']);
            }
            
            if(!file_exists(APP . $dFile['base_dir'] . $dFile['year_dir'] . DS . $dFile['month_dir']))
            {
                mkdir(APP . $dFile['base_dir'] . $dFile['year_dir'] . DS . $dFile['month_dir']);
            }
            
            if(move_uploaded_file($dFile['file_tmp'], APP . $dFile['path_file']))
            {
                $aMedia = array(
                    'Media' => array(
                        'name'      => $name,
                        'src'       => $dFile['path_file'],
                        'size'      => $size,
                        'type'      => $dFile['ext'],
                        'location' => 'local'
                    )
                );
                
                if($this->Media->save($aMedia))
                {
                    $aMedia['Media']['id'] = $this->Media->id;
                    
                    $view = new View($this);
                    $html = $view->loadHelper('Html');
                    
                    $aMedia['Media']['edit_link'] = $html->url(array(
                        'manager' => false,
                        'ajax' => true,
                        'plugin' => 'media',
                        'controller' => 'media',
                        'action' => 'edit',
                        'id' => $aMedia['Media']['id']
                    ));
                    
                    $aMedia['Media']['delete_link'] = $html->url(array(
                        'manager' => false,
                        'ajax' => true,
                        'plugin' => 'media',
                        'controller' => 'media',
                        'action' => 'delete',
                        'id' => $aMedia['Media']['id']
                    ));
                    
                    echo json_encode($aMedia);
                }
            }
            
//            debug($dFile);
        }
        
        return $this->render(false);
    }
    
    public function ajax_edit()
    {
        $params = $this->request->params;
        
        if(!empty($this->data))
        {
            $aMedia = $this->Media->getById($this->data['Media']['id']);
            
            $aMedia['Media']['name'] = $this->data['Media']['name'];
            $aMedia['Media']['description'] = $this->data['Media']['description'];
            
            if($this->media->save($aMedia))
            {
                $response['error'] = AppController::TYPE_SUCCESS; 
                $response['message'] = "Le média est sauvegradé !";
                $response['message'] = $aMedia;
            }
            
            return $this->render(false);
        }
        
        if(!empty($params['named']['id']))
        {
            $aMedia = $this->Media->find('first', array(
                'conditions' => array(
                    'id' => $params['named']['id']
                )
            ));
            
            $this->set('aMedia', $aMedia);
        }
    }
    
    public function ajax_delete()
    {
        $params = $this->request->params;
        $response = array();
        $error = false;
        
        if(!empty($params['named']['id']))
        {
            $aMedia = $this->Media->getById($params['named']['id']);
            
            if($aMedia['Media']['location'] == 'local')
            {
                $filePath = APP . $aMedia['Media']['src'];
                
                if(!unlink($filePath))
                {
                    $error = true;
                }
            }
            
            if($this->Media->delete($params['named']['id']))
            {
                $response['error'] = AppController::TYPE_SUCCESS;
                $response['message'] = "Le média est supprimé !";
            }
            
            if($error)
            {
                $response['message'] = "Le média est supprimé, mais le fichier n'a pas pu être supprimé !";
            }
            
            echo json_encode($response);
        }
        
        return $this->render(false);
    }
            
}

?>
