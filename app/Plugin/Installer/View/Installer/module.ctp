<?php // debug($aModules); ?>
<?php echo $this->Form->create(null) ?>
<fieldset>
    <legend>Nous allons maintenant installer les modules nécéssaires à l'installation de votre CMS.</legend>
    
    <?php if(!empty($aModules)): ?>
    <ul id="module-list">
        <?php foreach($aModules  as $aModule): ?>
            <?php if($aModule['core'] == true): ?>
            <li>
                <i class="icon-off"></i> <?php echo $aModule['name'] ?>
                <input type="hidden" value="<?php echo $aModule['path'] ?>" />
            </li>
            <?php endif ?>
        <?php endforeach; ?>
        <?php foreach($aModules  as $aModule): ?>
            <?php if($aModule['core'] != true): ?>
            <li>
                <i class="icon-off"></i> <?php echo $aModule['name'] ?>
                <input type="hidden" value="<?php echo $aModule['path'] ?>" />
            </li>
            <?php endif ?>
        <?php endforeach; ?>
    </ul>
    <?php endif ?>
    
    <?php
    echo $this->Form->input("admin", array(
        'type' => 'hidden',
        'label' => false,
        'div' => false,
        'value' => $this->Html->url(array(
            'plugin' => 'installer',
            'controller' => 'installer',
            'action' => 'admin'
        ), true)
    ))
    ?>
    
    <div class="form-actions">
        <?php
        echo $this->Form->input("Installer les modules", array(
            'type' => 'button',
            'div' => false,
            'label' => false,
            'class' => 'btn btn-primary'
        ))
        ?>
    </div>
</fieldset>
<?php echo $this->Form->end() ?>