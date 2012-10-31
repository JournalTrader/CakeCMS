<?php echo $this->Form->create('User', array(
    'class' => 'form-horizontal'
)) ?>
<fieldset>
    <legend>Informations de connexion</legend>
    <div class="control-group">
        <label class="control-label" for="ModuleName"> Email : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("mail", array(
                'label' => false,
                'div' => false,
                'value' => (!empty($auser['User']['mail'])) ? $auser['User']['mail']:null
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
    
    <legend>Options</legend> 
    <div class="control-group">
        <label class="control-label" for="UserGroupsid"> Permission : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("groups_id", array(
                'label' => false,
                'div' => false,
                'options' => $aGroups
            ))
            ?>
        </div>
    </div>
    
    <legend>Informations générales</legend>  
    <div class="control-group">
        <label class="control-label" for="ProfileFirstname"> Nom : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("Profile.first_name", array(
                'label' => false,
                'div' => false,
                'value' => (!empty($auser['Profile']['first_name'])) ? $auser['Profile']['first_name']:null
            ))
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="ProfileLastname"> Prénom : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("Profile.last_name", array(
                'label' => false,
                'div' => false,
                'value' => (!empty($auser['Profile']['last_name'])) ? $auser['Profile']['last_name']:null
            ))
            ?>
        </div>
    </div>
</fieldset>


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