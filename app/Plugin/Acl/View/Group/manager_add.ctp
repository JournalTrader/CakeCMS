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
            'value' => ""
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
            'options' => $aGroups
        ))
        ?>
    </div>
</div>
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