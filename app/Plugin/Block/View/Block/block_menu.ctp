<?php //debug($aBlocks); ?>

<?php if(!empty($aBlocks)): ?>
    <ul class="nav">
        <?php foreach($aBlocks as $aBlock): ?>
        <?php
            $active = null;
            // debug($aRequests['rPlugins'] . " => " . $aBlock['Menu']['Plugin']['plugin']);
            // debug($aRequests['rPrefix'] . " => " . $aBlock['Menu']['Plugin']['prefix']);
            if($aRequests['rPrefix'] == $aBlock['Menu']['Plugin']['prefix'] && $aRequests['rPlugins'] == $aBlock['Menu']['Plugin']['plugin'])
            {
                $active = ' active';
            }
        
        ?>
        
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
        <?php endforeach ?>        
    </ul>

<?php endif ?>