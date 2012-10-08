<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of directory
 *
 * @author Admin
 */
class ToolsDirectory 
{
    public static function delete($path)
    {
        $open = @opendir($path);
        
        if (!$open) return;
        
        while($file = readdir($open)) 
        {
            if ($file == '.' || $file == '..') continue;
            
            if (is_dir($path . "/" . $file)) 
            {
                $r = ToolsDirectory::delete($path . "/" . $file);
                
                if (!$r) return false;
            } else {
                $r = @unlink($path . "/" . $file);
                
                if (!$r) return false;
            }
        }
        
        closedir($open);
        
        $r = @rmdir($path);
        
        if (!$r) return false;
        
        return true;
    }
}

?>
