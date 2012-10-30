<?php echo $this->Form->create('Group', array(
    'class' => 'form-horizontal'
)) ?>
<div class="control-group">
    <label class="control-label" for="ModuleName"> Nom du groupe : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("name", array(
            'label' => false,
            'div' => false,
            'value' => (!empty($aGroup['Group']['name'])) ? $aGroup['Group']['name']:null
        ))
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="ModuleName"> Groupe parent : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("parent_id", array(
            'label' => false,
            'div' => false,
            'options' => $aGroups,
            'value' => (!empty($aGroup['Group']['parent_id'])) ? $aGroup['Group']['parent_id']:null
        ))
        ?>
    </div>
</div>

<?php if(isset($isEdit)): ?>
    <?php
        echo $this->Form->input('id', array(
            'type' => 'hidden',
            'value' => $aGroup['Group']['id']
        ));
    ?>
    <?php
        echo $this->Form->input('order', array(
            'type' => 'hidden',
            'value' => $aGroup['Group']['order']
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