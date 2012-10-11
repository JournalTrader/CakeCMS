<?php echo  $this->Form->create('Page', array(
    'class' => 'form-horizontal'
)) ?>
<div class="control-group">
    <label class="control-label" for="PageTitle"> Titre de la page : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("title", array(
            'label' => false,
            'div' => false,
            'class' => 'span12',
            'value' => (isset($aPage) && !empty($aPage['Page']['title'])) ? $aPage['Page']['title']:null
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
            'class' => 'span12',
            'value' => (isset($aPage) && !empty($aPage['Page']['content'])) ? $aPage['Page']['content']:null
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
            'options' => $aParents,
            'value' => (isset($aPage) && !empty($aPage['Page']['parent_id'])) ? $aPage['Page']['parent_id']:0
        ))
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="PageContent"> Publier la page : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("status", array(
            'label' => false,
            'div' => false,
            'class' => 'span12',
            'checked' => (isset($aPage) && $aPage['Page']['status'] == 1) ? true:false
        ))
        ?>
    </div>
</div>

<?php if(isset($isEdit)): ?>
        <?php
            echo $this->Form->input('id', array(
                'type' => 'hidden',
                'value' => (isset($aPage) && !empty($aPage['Page']['id']))
            ));
         ?>
<?php endif ?>

<?php echo $this->Block->element('manager_content_add') ?>

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