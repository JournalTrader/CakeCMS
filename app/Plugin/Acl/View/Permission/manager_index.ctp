<?php // debug($aModules); ?>
<?php // debug($aGroups); ?>

<?php echo $this->Form->create(null) ?>
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th>Nom</th>
            <?php foreach($aAros as $aAro): ?>
            <th class="index center"><?php echo ucfirst(substr($aAro['Aro']['Group']['name'], 0, 1)) ?></th>
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
                    <?php foreach($aAros as $aAro): ?>
                    <th class="index center"><?php
                        $active = false;
                        foreach($aAro['Aco'] as $aAco)
                        {
                            if($aModule['Plugin']['id'] == $aAco['foreign_key'])
                            {
                                if($aAco['Permission']['_create'] > 0)
                                {
                                    $active = true;
                                }
                            }
                        }
                        echo $this->Form->input($aAro['Aro']['id'] . "." . $aModule['Plugin']['Aco']['id'], array(
                            'type' => 'checkbox',
                            'label' => false,
                            'div' => false,
                            'checked' => $active,
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
                    <?php foreach($aAros as $aAro): ?>
                    <td class="index center"><?php
                        $active = false;
                        foreach($aAro['Aco'] as $aAco)
                        {
                            if($aPlugins['id'] == $aAco['foreign_key'])
                            {
                                if($aAco['Permission']['_create'] > 0)
                                {
                                    $active = true;
                                }
                            }
                        }
                        echo $this->Form->input($aAro['Aro']['id'] . "." . $aPlugins['Aco']['id'], array(
                            'type' => 'checkbox',
                            'label' => false,
                            'div' => false,
                            'checked' => $active,
                            'value' => true
                        ))
                    ?></td>
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