<?php echo $this->Form->create('User', array(
    'class' => 'form-horizontal'
)) ?>
<div class="control-group">
    <label class="control-label" for="UserMail"> Adresse mail : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("mail", array(
            'label' => false,
            'div' => false
        ))
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="UserPassword"> Mot de passe : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("password", array(
            'label' => false,
            'div' => false
        ))
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="UserMail"> Confirmation : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("confirme", array(
            'type' => 'password',
            'label' => false,
            'div' => false
        ))
        ?>
    </div>
</div>

<div class="form-actions">
    <?php
    echo $this->Form->input("Créer mon compte", array(
        'type' => 'button',
        'div' => false,
        'label' => false,
        'class' => 'btn btn-primary'
    ))
    ?>
</div>
<?php echo $this->Form->end() ?>