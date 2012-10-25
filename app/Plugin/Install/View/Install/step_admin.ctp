<?php echo $this->Form->create('User', array(
    'class' => 'form-horizontal'
)) ?>
<div class="control-group">
    <label class="control-label" for="ModuleName"> Mail: </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("mail", array(
            'label' => false,
            'div' => false,
            'value' => ""
        ))
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="ModuleName"> Mot de passe : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("password", array(
            'label' => false,
            'div' => false,
            'value' => ""
        ))
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="ModuleName"> Confirmation : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("confirmation", array(
            'type' => 'password',
            'label' => false,
            'div' => false,
            'value' => ""
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