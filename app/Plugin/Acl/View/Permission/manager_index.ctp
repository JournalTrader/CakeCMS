<?php // debug($aModules); ?>
<?php // debug($aGroups); ?>

<?php echo $this->Form->create(null) ?>
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th>Nom</th>
            <?php foreach($aGroups as $aGroup): ?>
            <th class="index center"><?php echo ucfirst(substr($aGroup['Group']['name'], 0, 1)) ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
</table>

<?php if($aModules): ?>
    <?php foreach($aModules as $aModule): ?>
            <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th><?php echo $aModule['Module']['name'] ?></th>
                    <?php foreach($aGroups as $aGroup): ?>
                    <th class="index center"><?php
                        echo $this->Form->input($aGroup['Group']['id'] . "." . $aModule['Plugin']['id'], array(
                            'type' => 'checkbox',
                            'label' => false,
                            'div' => false,
                            'value' => true
                        ))
                    ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($aModule['Plugin']['ChildPlugin'] as $aPlugins): ?>
                <tr>
                    <td><?php echo $aPlugins['name'] ?></td>
                    <?php foreach($aGroups as $aGroup): ?>
                    <th class="index center"><?php
                        echo $this->Form->input($aGroup['Group']['id'] . "." . $aPlugins['id'], array(
                            'type' => 'checkbox',
                            'label' => false,
                            'div' => false,
                            'value' => true
                        ))
                    ?></th>
                    <?php endforeach ?>
                </tr>
                <?php endforeach; ?>                
            </tbody>
        </table>
    <?php endforeach; ?>
<?php endif ?>

<div class="form-actions">
    <?php
    echo $this->Form->input("Mettre à jour", array(
        'type' => 'button',
        'div' => false,
        'label' => false,
        'class' => 'btn btn-primary'
    ))
    ?>
</div>
<?php echo $this->Form->end() ?>