<?php

class ToolsHelper extends AppHelper
{
    public function timeAgo($time)
    {
        $text = 'Il y a';
        
        $now = time();
        $strToTime = strtotime($time);
        
        $diff = $now - $strToTime;
        
//        debug($diff);
        
        $d = floor($diff / (3600 * 24));
//        debug(floor($d));
        
        $diff -= $d * (3600 * 24);
//        debug($diff);
        
        $h = floor($diff / 3600);
//        debug(floor($h));
        
        $diff -= $h * 3600;
//        debug($diff);
        
        $m = floor($diff / 60);
//        debug(floor($m));
        
        $diff -= $m * 60;
//        debug($diff);
        
        $s = floor($diff);
        
        if($s == 0 && $m == 0 && $h == 0 && $d == 0)
        {
            $text .= " un instant";
        } 
        
        if($s == 1)
        {
            $sec = " %s seconde";
        } else {
            $sec = " %s secondes";
        }
        
        if($m == 1)
        {
            $min = " %s minunte";
        } else {
            $min = " %s minuntes";
        }
        
        if($m == 1)
        {
            $hour = " %s heure";
        } else {
            $hour = " %s heures";
        }
        
        if($d == 1)
        {
            $day = " %s jour";
        } else {
            $day = " %s jours";
        }
        
        if($d == 0)
        {
            $text .= sprintf($hour, $h) . sprintf($min, $m);
        }
        
        if($d == 0 && $h == 0)
        {
            $text .= sprintf($min, $m) . sprintf($sec, $s);
        }
        
        if($d == 0 && $h == 0 && $m == 0)
        {
            $text .= sprintf($sec, $s);
        }
        
        return $text;
    }
}
?>
