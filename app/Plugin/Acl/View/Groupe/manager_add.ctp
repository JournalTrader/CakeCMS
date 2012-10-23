<?php echo $this->Form->create('Groupe', array(
    'class' => 'form-horizontal'
)) ?>
<div class="control-group">
    <label class="control-label" for="GroupeName"> Nom du groupe : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("name", array(
            'label' => false,
            'div' => false,
            'value' => (!empty($aGroupe['Groupe']['name'])) ? $aGroupe['Groupe']['name']:null
        ))
        ?>
    </div>
</div>

<?php if(isset($isEdit)): ?>
    <?php
    echo $this->Form->input('id', array(
        'type' => 'hidden',
        'value' => $aGroupe['Groupe']['id']
    ));
    ?>
<?php endif ?>

<div class="form-actions">
    <?php
    echo $this->Form->input("Envoyer", array(
        'type' => 'button',
        'div' => false,
        'label' => false,
        'class' => 'btn btn-primary'
    ))
    ?>
</div>
<?php echo $this->Form->end() ?>