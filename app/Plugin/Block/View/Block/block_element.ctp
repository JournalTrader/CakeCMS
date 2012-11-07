<?php // debug($aElements); ?>

<?php foreach($aElements as $aElement): ?>
    <?php 
        $display = true;
        
//        debug($aRequests);
        if(!empty($aElement['Display']))
        {
            if($aRequests['rPrefix'] != $aElement['Display']['prefix'] 
               || $aRequests['rPlugins'] != $aElement['Display']['plugin'])
            {
                $display = false;
            }
            
            if($display)
            {
                if (empty($aElement['Display']['ChildPlugin'])) 
                {
                    if($aRequests['rController'] != $aElement['Display']['controller'])
                    {
                        $display = false;                    
                    }

                    $ex = explode('_', $aRequests['rAction']);
                    unset($ex[0]);
                    $action = implode('_', $ex);

                    if($aElement['display_absolute'] == true && $action != $aElement['Display']['action'])
                    {
                        $display = false;
                    }
                }
            }
        }
    ?>
    <?php if($display): ?>
    <?php echo $this->requestAction(array(
        'prefix' => $aElement['Plugin']['prefix'],
        'plugin' => $aElement['Plugin']['plugin'],
        'controller' => $aElement['Plugin']['controller'],
        'action' => $aElement['Plugin']['action']
    ), array(
        'return',
        'named' => $named,
        'pass' => $pass,
        'id' => $id,
        'slug' => $slug
    )) ?>
    <?php endif ?>
<?php endforeach; ?>

<?php
    echo $this->Form->input('BlockAlias.', array(
        'type' => 'hidden',
        'value' => $alias
    ));
?>