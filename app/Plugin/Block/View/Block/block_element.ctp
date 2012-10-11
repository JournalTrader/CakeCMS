<?php // debug($aElements); ?>

<?php foreach($aElements as $aElement): ?>
    <?php echo $this->requestAction(array(
        'prefix' => $aElement['Plugin']['prefix'],
        'plugin' => $aElement['Plugin']['plugin'],
        'controller' => $aElement['Plugin']['controller'],
        'action' => $aElement['Plugin']['action']
    ), array(
        'return',
        'named' => $named
    )) ?>
<?php endforeach; ?>

<?php
    echo $this->Form->input('BlockAlias.', array(
        'type' => 'hidden',
        'value' => $alias
    ));
?>