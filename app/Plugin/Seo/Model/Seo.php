<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Seo
 *
 * @author nicolasmoricet
 */
class Seo extends SeoAppModel
{
    public $useTable = 'seo';
    
    public function beforeSave($options = array()) 
    {
        if(!empty($this->data['Seo'])) 
        {
            if(!empty($this->data['Seo']['title']))
            {
                $this->data['Seo']['title'] = AppSpecial::ucfirst($this->data['Seo']['title']);
            }
            
            if(!empty($this->data['Seo']['keywords']))
            {
                $jsonData = array();
                $ex = explode(',', $this->data['Seo']['keywords']);
                
                foreach($ex as $d)
                {
                    $jsonData[] = trim($d);
                }
                
                if(!empty($jsonData))
                {
                    $this->data['Seo']['keywords'] = json_encode($jsonData);
                }
            }
        }
        
//        debug($this->data);
//        die;
        
        return true;
    }
    
    public function afterFind($results, $primary = false) 
    {
        foreach($results as $aKey => $result)
        {
            if (!empty($result['Seo']['keywords'])) 
            {
                $results[$aKey]['Seo']['keywords'] = implode(', ', json_decode($result['Seo']['keywords']));
            }
        }
        
        return $results;
    }
}

?>
