<?php 

App::uses('File', 'Utility');
App::uses('CakeSchema', 'Model');
App::uses('ConnectionManager', 'Model');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InstallController
 *
 * @author nicolasmoricet
 */
class InstallController extends Controller
{
    public $uses = array(
        'User.User'
    );

    public $components = array(  
        'Acl',
        'Auth',
        'Session'
    );

    public $defaultConfig = array(
            'name' => 'default',
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => 'localhost',
            'login' => 'root',
            'password' => 'root',
            'database' => 'altal',
            'schema' => null,
            'prefix' => null,
            'encoding' => 'UTF8',
            'port' => null,
    );
    
    public function beforeFilter()
    {   
        $this->Auth->allow('*');
//        $this->Auth->logout();
        Configure::write('debug', 2);
        
//        if (!defined('LOG_ERROR')) {
//            define('LOG_ERROR', LOG_ERR);
//	}
//
//	Configure::write('Error', array(
//		'handler' => 'ErrorHandler::handleError',
//		'level' => E_ALL & ~E_DEPRECATED,
//		'trace' => true
//	));
//
//	Configure::write('Exception', array(
//		'handler' => 'ErrorHandler::handleException',
//		'renderer' => 'ExceptionRenderer',
//		'log' => true
//	));
        
        if(!file_exists(APP . 'Config' . DS . 'database.php'))
        {
            copy(APP . DS . 'Plugin'. DS . 'Install' . DS . 'Config' . DS . 'database.php.install', APP . 'Config' . DS . 'database.php');
        }
    }
    
    public function index()
    {
        sleep(3);
        $this->set('title', "Bienvenue dans l'installateur de votre CMS");
    }
    
    public function database()
    {
        $config = $this->defaultConfig;
        
        if(!empty($this->data))
        {
            foreach ($this->data as $k => $d)
            {
                $this->defaultConfig[$k] = $d;
            }
            
            chmod(APP . 'Config' . DS . 'database.php', 0777);
            
            $file = new File(APP . 'Config' . DS . 'database.php', true);
            
            if(($content = $file->read()))
            {
                foreach ($config as $configKey => $configValue) 
                {
                    $content = str_replace('{default_' . $configKey . '}', $configValue, $content);
                }

                if ($file->write($content)) 
                {
                    $this->set('pass', true);
//                    $this->redirect('/install/install/step_admin');
                } 
            }
        }
    }
    
    public function step_admin()
    {
        
        if(!empty($this->data['User']))
        {
            
            
            if($this->data['User']['password'] === $this->data['User']['confirmation'])
            {
                if($this->User->save($this->data))
                {
                    $this->Session->setFlash("L'installation est terminée !", 'alert');
                    $this->redirect(array(
                        'plugin' => 'install',
                        'controller' => 'install',
                        'action' => 'end'
                    ));
                }
            }
        } else {
            $db = ConnectionManager::getDataSource('default');
            $brokenSequence = $db instanceof Postgres;

            if (!$db->isConnected()) {
                $this->Session->setFlash(__('Could not connect to database.'), 'default', array('class' => 'error'));
            } else {
                $schema =& new CakeSchema(array('name' => 'app'));
                $schema = $schema->load();

                foreach ($schema->tables as $table => $fields) 
                {
                    $create = $db->createSchema($schema, $table);

                    try {
                        $db->execute($create);
                    }
                    catch (PDOException $e) {
                            $this->Session->setFlash(__('Could not create table: %s', $e->getMessage()), 'default', array('class' => 'error'));
                            return;
                    }
                }
            }

            $table = null;

            $path = App::pluginPath('Install') . DS . 'Config' . DS . 'Data' . DS;
            $dataObjects = App::objects('class', $path);

            foreach ($dataObjects as $data) 
            {
                include ($path . $data . '.php');
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
                    foreach ($records as $record) {
                            $modelObject->create($record);
                            $modelObject->save();
                    }
                }

                if ($brokenSequence) {
                    $this->_fixSequence($modelObject);
                }
            }
        }
    }
    
    public function end()
    {
        $this->set('title', "Fin de l'installation");
    }

    protected function _fixSequence($model) {
        $db = $model->getDataSource();
        $nextValue = $model->find('first', array(
            'fields' => sprintf('MAX(%s.%s) as max', $model->alias, $model->primaryKey),
        ));
        
        $nextValue = empty($nextValue[0]['max']) ? 1 :  $nextValue[0]['max'] + 1;
        $sql = sprintf('alter sequence %s restart with %d', $db->getSequence($model), $nextValue);
        
        $db->execute($sql);
    }
}

?>

