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
    const TYPE_PICTURE = 'picture';
    
    const TYPE_VIDEO = 'video';
    
    const TYPE_FILE = 'file';
    
    public $uses = array(
        'Media.Media'
    );
    
    public $helpers = array(
        'Media.Media',
        'Media.Video'
    );
    
    private $filesType = array(
        'jpg' => self::TYPE_PICTURE,
        'jpeg' => self::TYPE_PICTURE,
        'png' => self::TYPE_PICTURE,
        'gif' => self::TYPE_PICTURE,
        'flv' => self::TYPE_VIDEO,
        'avi' => self::TYPE_VIDEO,
        'mp4' => self::TYPE_VIDEO,
        'zip' => self::TYPE_FILE,
        'rar' => self::TYPE_FILE,
        'pdf' => self::TYPE_FILE
    );
    
    public function manager_index()
    {
        $aMedias = $this->Media->getAllByGroup();
//        $aMedias = $this->Media->find('all');
        
        $this->set('aMedias', $aMedias);
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
                        'location' => 'local',
                        'category' => $this->filesType[strtolower($dFile['ext'])]
                    )
                );
                
                if($this->Media->save($aMedia))
                {
                    $aMedia['Media']['id'] = $this->Media->id;
                    
                    $view = new View($this);
                    $html = $view->loadHelper('Html');
                    $tools = $view->loadHelper('Tools');
                    
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
                    
                    $aMedia['Media']['time_ago'] = $tools->timeAgo(time());
                    
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
            
            if($this->Media->save($aMedia))
            {
                $response['error'] = AppController::TYPE_SUCCESS; 
                $response['message'] = "Le média est sauvegradé !";
                $response['data'] = $aMedia;
            } else {
                $response['error'] = AppController::TYPE_WARNING; 
                $response['message'] = "Le média n'est pas sauvegradé !";
            }
            
            echo json_encode($response);
            
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
    
    public function manager_delete()
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
            
            $this->Session->setFlash($response['message'], 'alert', array('type' => $response['error']));
            $this->redirect(array(
                'manager' => true,
                'plugin' => 'media',
                'controller' => 'media',
                'action' => 'index'
            ));
        }
        
        return $this->render(false);
    }
            
}

?>
