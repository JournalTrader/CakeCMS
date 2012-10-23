<?php echo $this->Form->create('User', array(
    'class' => 'form-horizontal'
)) ?>
<div class="control-group">
    <label class="control-label" for="UserMail"> Mail: </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("mail", array(
            'label' => false,
            'div' => false,
            'value' => (!empty($aUser['User']['mail'])) ? $aUser['User']['mail']:null
        ));
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="ProfileFirstName"> Prénom: </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("Profile.first_name", array(
            'label' => false,
            'div' => false,
            'value' => (!empty($aUser['Profile']['first_name'])) ? $aUser['Profile']['first_name']:null
        ));
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="ProfileLastname"> Nom: </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("Profile.last_name", array(
            'label' => false,
            'div' => false,
            'value' => (!empty($aUser['Profile']['last_name'])) ? $aUser['Profile']['last_name']:null
        ));
        ?>
    </div>
</div>
<?php if(isset($isEdit)): ?>
    <?php
    echo $this->Form->input('id', array(
        'type' => 'hidden',
        'value' => (!empty($aUser['User']['id'])) ? $aUser['User']['id']:null
    ));
    ?>
    <?php
    echo $this->Form->input('Profile.id', array(
        'type' => 'hidden',
        'value' => (!empty($aUser['Profile']['id'])) ? $aUser['Profile']['id']:null
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