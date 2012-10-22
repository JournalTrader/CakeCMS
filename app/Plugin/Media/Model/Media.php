<?php
App::uses('AppModel', 'Model');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Media
 *
 * @author nicolasmoricet
 */
class Media extends AppModel
{    
    const TYPE_PICTURE = 'picture';
    
    const TYPE_VIDEO = 'video';
    
    const TYPE_FILE = 'file';
    
    public function getById($iId)
    {
        return $this->find('first', array(
            'conditions' => array(
                'id' => $iId
            )
        ));
    }
    
    public function getAllByGroup()
    {
        $aList = array();
        $aMedias = $this->find('all', array(
            'order' => array(
                'created' => 'DESC'
            )
        ));
        
        foreach($aMedias as $aMedia)
        {
            switch($aMedia['Media']['category'])
            {
                case self::TYPE_PICTURE:
                    $aList[self::TYPE_PICTURE][] = $aMedia;
                    break;
                case self::TYPE_VIDEO:
                    $aList[self::TYPE_VIDEO][] = $aMedia;
                    break;
                case self::TYPE_FILE:
                    $aList[self::TYPE_FILE][] = $aMedia;
                    break;
            }
        }
        
        return $aList;
    }
    
    public function beforeSave($options = array()) 
    {
        if($this->data)
        {
            if(!empty($this->data['Media']['name']))
            {
                $this->data['Media']['name'] = AppSpecial::ucfirst($this->data['Media']['name']);
            }
        }
        
        return true;
    }
}

?>
