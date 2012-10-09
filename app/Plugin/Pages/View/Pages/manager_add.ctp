<?php echo $this->Form->create() ?>
<div class="control-group">
    <label class="control-label" for="PageTitle"> Titre de la page : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("title", array(
            'label' => false,
            'div' => false,
            'class' => 'span12'
        ))
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="PageContent"> Contenu : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("content", array(
            'label' => false,
            'div' => false,
            'class' => 'span12'
        ))
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="PageContent"> Page parente : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("parent_id", array(
            'label' => false,
            'div' => false,
            'class' => 'span12',
            'options' => $aParents
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