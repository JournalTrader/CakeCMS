<?php // debug($aBlocks); ?>

<?php if(!empty($aBlocks)): ?>
<div class="nav-collapse collapse">
    <ul class="nav<?php echo $sClass ?>">
        <?php foreach($aBlocks as $aBlock): ?>
        <?php
            $active = null;
            $display = true;
            // debug($aRequests['rPlugins'] . " => " . $aBlock['Menu']['Plugin']['plugin']);
            // debug($aRequests['rPrefix'] . " => " . $aBlock['Menu']['Plugin']['prefix']);
            if($aRequests['rPrefix'] == $aBlock['Menu']['Plugin']['prefix'] && $aRequests['rPlugins'] == $aBlock['Menu']['Plugin']['plugin'])
            {
                $active = ' active';
            }
            
            if(!empty($aBlock['Menu']['Display']))
            {
                if($aRequests['rPrefix'] != $aBlock['Menu']['Display']['prefix'] 
                   || $aRequests['rPlugins'] != $aBlock['Menu']['Display']['plugin'])
                {
                    $display = false;
                }
                
                if($display)
                {
                    if (empty($aBlock['Menu']['Display']['ChildPlugin'])) 
                    {
                        if($aRequests['rController'] != $aBlock['Menu']['Display']['controller'])
                        {
                            $display = false;                    
                        }

                        $ex = explode('_', $aRequests['rAction']);
                        unset($ex[0]);
                        $action = implode('_', $ex);

                        if($aBlock['Menu']['display_absolute'] == true && $action != $aBlock['Menu']['Display']['action'])
                        {
                            $display = false;
                        }
                    }
//                    if (!empty($aBlock['Menu']['Display']['ChildPlugin'])) 
//                    {
//                        foreach($aBlock['Menu']['Display']['ChildPlugin'] as $aChildPlugin)
//                        {
//                            debug($aChildPlugin);
//                            if($aRequests['rPrefix'] != $aChildPlugin['Plugin']['prefix'] || $aRequests['rPlugins'] != $aChildPlugin['Plugin']['plugin'])
//                            {
//                                $display = false;
//                            }
//                        }
//                    } else {
//                        if($aRequests['rController'] != $aBlock['Menu']['Display']['controller'])
//                        {
//                            $display = false;                    
//                        }
//                        
//                        $ex = explode('_', $aRequests['rAction']);
//                        unset($ex[0]);
//                        $action = implode('_', $ex);
//                        
//                        if($aBlock['Menu']['display_absolute'] == true && $action != $aBlock['Menu']['Display']['action'])
//                        {
//                            $display = false;
//                        }
//                    }
                }
            }
        ?>
        <?php if($display): ?>
        <li class="<?php echo (!empty($aBlock['Menu']['ChildMenus'])) ? 'dropdown':'' ?><?php echo (!is_null($active)) ? $active:'' ?>">
            <a href="<?php echo $this->Html->url(array(
                'block' => false,
                $aBlock['Menu']['Plugin']['prefix'] => true,
                'plugin' => $aBlock['Menu']['Plugin']['plugin'],
                'controller' => $aBlock['Menu']['Plugin']['controller'],
                'action' => $aBlock['Menu']['Plugin']['action']
            )) ?>" <?php echo (!empty($aBlock['Menu']['ChildMenus'])) ? 'class="dropdown-toggle" data-toggle="dropdown"':'' ?>><?php echo $aBlock['Menu']['name'] ?></a>
            <?php if(!empty($aBlock['Menu']['ChildMenus'])): ?>
            <ul class="dropdown-menu">
                <?php foreach($aBlock['Menu']['ChildMenus'] as $aChildMenu): ?>
                <li><a href="<?php echo $this->Html->url(array(
                    $aChildMenu['Plugin']['prefix'] => true,
                    'block' => false,
                    'plugin' => $aChildMenu['Plugin']['plugin'],
                    'controller' => $aChildMenu['Plugin']['controller'],
                    'action' => $aChildMenu['Plugin']['action']
                )) ?>"><?php echo $aChildMenu['Menu']['name'] ?></a></li>
                <?php endforeach ?>
            </ul>
            <?php endif ?>
        </li>
        <?php endif ?>
        <?php endforeach ?>        
    </ul>
</div>
<?php endif ?>