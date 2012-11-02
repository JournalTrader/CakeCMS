<?php
App::uses('AppController', 'Controller');
App::uses('ConnectionManager', 'Model');
App::uses('CakeSchema', 'Model');
App::uses('File', 'Utility');
App::uses('Security', 'Utility');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InstallerController
 *
 * @author Admin
 */
class InstallerController extends Controller
{
    public $uses = null;
    
   public $components = array( 
        'Session',
        'Auth'
    );
    
    public $helpers = array(
        'Html', 
        'Form'
    );
    
    public $defaultConfig = array(
        'name' => 'default',
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'metaflex',
        'schema' => null,
        'prefix' => null,
        'encoding' => 'UTF8',
        'port' => null,
    );
    
    protected function _check() {
        if (Configure::read('Install.installed') && Configure::read('Install.secured')) 
        {
            $this->Session->setFlash('Already Installed');
            $this->redirect('/');
        }
    }
    
    public function beforeFilter() 
    {
        parent::beforeFilter();
        $this->Auth->allow('*');
        $params = $this->params;
        
        $this->set('action', $params['action']);
    }
    
    public function index()
    {
        $this->_check();
        $this->set('title', "Bienvenue dans la procédure d'installation de votre CMS.");
    }
    
    public function database()
    {
        $this->_check();
        $this->set('title', "Installation de la base de données.");
        
        if(!empty($this->data))
        {
            $config = $this->defaultConfig;
            
            foreach ($this->data['Installer'] as $key => $value) {
                if (isset($this->data['Installer'][$key])) {
                    $config[$key] = $value;
                }
            }
            
            try {
                ConnectionManager::create('default', $config);
                $db = ConnectionManager::getDataSource('default');
            } catch (MissingConnectionException $e) {
                $this->Session->setFlash(__('Impossible de se connecter à la base de données : %s', $e->getMessage()), 'alert', array('type' => AppController::TYPE_ERROR));
                return;
            }
            
            if (!$db->isConnected()) {
                $this->Session->setFlash(__('Impossible de se connecter à la base de données.'), 'alert', array('type' => AppController::TYPE_ERROR));
                return;
            }
            
            if(!copy(APP . 'Plugin' . DS  .'Installer' . DS . 'Config' . DS . 'database.php.install', APP . 'Config' . DS . 'database.php'))
            {
                $this->Session->setFlash('Impossible de créer le fichier : database.php', 'alert', array('type' => AppController::TYPE_ERROR));
                return;
            }
            
            $file = new File(APP . 'Config' . DS . 'database.php', true);
            $content = $file->read();
            
            foreach ($config as $configKey => $configValue) 
            {
                $content = str_replace('{default_' . $configKey . '}', $configValue, $content);
            }
            
            if (!$file->write($content)) 
            {
                $this->Session->setFlash(__("Impossible d'écrire dans le fichier : database.php."), 'alert', array('type' => AppController::TYPE_ERROR));
                return;
            } else {
                if(copy(APP . 'Plugin' . DS  .'Installer' . DS . 'Config' . DS . 'bt.php.install', APP . 'Config' . DS . 'bt.php'))
                {
                    return $this->redirect(array('action' => 'module'));
                } else {
                    $this->Session->setFlash(__("Impossible de créer le fichier : bt.php."), 'alert', array('type' => AppController::TYPE_ERROR));
                }
            }
            
            
        }
        
        $this->set('default', $this->defaultConfig);
    }
    
    public function module()
    {
        $this->_check();
        $this->set('title', "Installation des modules.");
        
        $directories = scandir(APP . 'Plugin');
        $pathes = array();
        
        foreach ($directories as $directory) 
        {
            if($directory != '.' && $directory != '..' && $directory != 'Installer')
            {
                $pathes[] = APP . 'Plugin' . DS . $directory . DS;
                $fileParams = APP . 'Plugin' . DS . $directory . DS . Configure::read('Module.filename.params');
                
                if(file_exists($fileParams))
                {
                    $aModule = array();
                        
                    $dom = new DOMDocument();

                    if(!@$dom->load($fileParams))
                    {
                        continue;
                    }

                    $elements = $dom->getElementsByTagName('module');

                    foreach($elements as $element)
                    {
                        $aModule['is_installed'] = false;
                        $aModule['path'] = APP . 'Plugin' . DS . $directory . DS;
                        $aModule['is_main'] = false;
                        $aModule['name'] = (!empty($element->getElementsByTagname('name')->item(0)->nodeValue)) ? $element->getElementsByTagname('name')->item(0)->nodeValue:null;
                        $aModule['description'] = (!empty($element->getElementsByTagname('description')->item(0)->nodeValue)) ? $element->getElementsByTagname('description')->item(0)->nodeValue:null;
                        $aModule['version'] = (!empty($element->getElementsByTagname('version')->item(0)->nodeValue)) ? $element->getElementsByTagname('version')->item(0)->nodeValue:null;
                        $aModule['author'] = (!empty($element->getElementsByTagname('author')->item(0)->nodeValue)) ? $element->getElementsByTagname('author')->item(0)->nodeValue:null;
                        $aModule['site'] = (!empty($element->getElementsByTagname('site')->item(0)->nodeValue)) ? $element->getElementsByTagname('site')->item(0)->nodeValue:null;
                        $aModule['url'] = (!empty($element->getElementsByTagname('url')->item(0)->nodeValue)) ? $element->getElementsByTagname('url')->item(0)->nodeValue:null;
                        $aModule['core'] = (!empty($element->getElementsByTagname('core')->item(0)->nodeValue)) ? $element->getElementsByTagname('core')->item(0)->nodeValue:false;
                    }
                    
                    $aModules[] = $aModule;
                }
            }
        }
        
        $this->set('aModules', $aModules);
    }
    
    public function install_module()
    {
        $this->layout = false;
        
        $exPlugin = explode(DS, substr($this->data['path'], 0, -1));
        $plugin = end($exPlugin);
        
        $pathConfig = $this->data['path'] . 'Config' . DS;
        $pathSchema = $pathConfig . 'Schema' . DS;
        $pathData = $pathConfig . 'Data' . DS;
        
        $files = glob($pathSchema . '*.php');
        
        if(empty($files))
        {
            $response = array(
                'error' => AppController::TYPE_SUCCESS,
                'message' => "Installation ok !"
            );
            
            echo json_encode($response);
            return $this->render(false);
        }
        
        $db = ConnectionManager::getDataSource('default');
        $brokenSequence = $db instanceof Postgres;
        
        if (!$db->isConnected()) 
        {
            $reponse = array(
                'error' => AppController::TYPE_ERROR,
                'message' => "Impossible de se connecter à la base de données."
            );
            
            echo json_encode($reponse);
            return $this->render(false);
        }
        
        foreach($files as $file)
        {
            $ex = explode(DS, $file);
            $f = end($ex);
            
            $fileName = explode('.', $f);
            $fileName = $fileName[0];
            
            require_once $file;
            
            $className = $fileName . 'Schema';
            
            $obj = new $className;
            
            $schema =& new CakeSchema(array(
                'name' => $obj->name,
                'path' => $obj->path,
                'file' => $obj->file,
                'plugin' => $obj->plugin,
                'tables' => $obj->tables,
            ));
            
            $schema = $schema->load();
            
            foreach ($schema->tables as $table => $fields)
            {
                $create = $db->createSchema($schema, $table);
                
                try {
                    $db->execute($create);
                } catch (PDOException $e) { }
            }
        }
        
        $dataObjects = App::objects('class', $pathData);
        
        foreach($dataObjects as $data)
        {
            include($pathData . $data . '.php');
            $classVars = get_class_vars($data);
            $modelAlias = substr($data, 0, -4);
            
            $table = $classVars['table'];
            $records = $classVars['records'];
            
            App::uses('Model', 'Model');
            $modelObject =& new Model(array(
                'name' => $modelAlias,
                'table' => $table,
                'ds' => 'default',
            ));
            
            if (is_array($records) && count($records) > 0) {
                foreach ($records as $record) 
                {
                    $modelObject->create($record);
                    $modelObject->save();
                }
            }
            
            if ($brokenSequence) 
            {
                $this->_fixSequence($modelObject);
            }
        }
        
        echo json_encode(array(
            'error' => AppController::TYPE_SUCCESS,
            'message' => sprintf("Installation du module %s", $plugin)
        ));
        
        return $this->render(false);
    }
    
    protected function _fixSequence($model) 
    {
        $nextValue = array();
        $db = $model->getDataSource();
        
        $nextValue = $model->find('first', array(
            'fields' => sprintf('MAX(%s.%s) as max', $model->alias, $model->primaryKey),
        ));
        
        $nextValue = empty($nextValue[0]['max']) ? 1 :  $nextValue[0]['max'] + 1;
        
        $sql = sprintf('alter sequence %s restart with %d', $db->getSequence($model), $nextValue);
        $db->execute($sql);
    }
    
    public function admin()
    {
        $this->components[] = 'Acl';
        
        $this->_check();
        Configure::write('debug', 1);
        $this->set('title', "Création du compte administrateur.");
        
        $this->uses = array(
            'Installer.User',
            'Installer.Profile'
        );
        
        if(!empty($this->data))
        {
            if($this->data['User']['password'] === $this->data['User']['confirme'])
            {
                $aUser['User'] = $this->data['User'];
                $aUser['User']['groups_id'] = 1;
                $aUser['User']['password'] = $this->Auth->password($this->data['User']['password']);
                
                if($this->User->save($aUser))
                {
                    $aProfile['Profile']['users_id'] =  $this->User->id;
                    
                    if($this->Profile->save($aProfile))
                    {
                        $this->redirect(array(
                            'plugin' => 'installer',
                            'controller' => 'installer',
                            'action' => 'access'
                        ));
                    } else {
                        $this->Session->setFlash("Impossible de créer votre profil. Vous pourrez tout de même vous connecter", 'alert');
                        $this->redirect($this->referer());
                    }
                } else {
                    $this->Session->setFlash("Impossible de créer votre compte administrateur.", 'alert');
                    $this->redirect($this->referer());
                }
            } else {
                $this->Session->setFlash("Le mot de passe est différent de la confirmation.", 'alert', array(
                    'type' => AppController::TYPE_WARNING
                ));
                $this->redirect($this->referer());
            }
        }
    }
    
    public function access()
    {
        $this->_check();
        Configure::write('debug', 1);
        $this->set('title', "Installation terminée !");
        
        if(!Configure::read('Installer.installed'))
        {
            $File =& new File(APP . 'Config' . DS . 'core.php');
            $salt = Security::generateAuthKey();
            $seed = mt_rand() . mt_rand();
            
            $contents = $File->read();
            $contents = preg_replace('/(?<=Configure::write\(\'Security.salt\', \')([^\' ]+)(?=\'\))/', $salt, $contents);
            $contents = preg_replace('/(?<=Configure::write\(\'Security.cipherSeed\', \')(\d+)(?=\'\))/', $seed, $contents);
            
            if (!$File->write($contents)) {
                $this->log('Unable to write your Config' . DS . 'core.php file. Please check the permissions.');
                return false;
            }
            
            Configure::write('Security.salt', $salt);
            Configure::write('Security.cipherSeed', $seed);
            Configure::write('Installer.installed', true);
        }
    }
}

?>
