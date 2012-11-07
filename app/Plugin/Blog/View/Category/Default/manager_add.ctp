<?php echo $this->Form->create('Term', array(
    'class' => 'form-horizontal'
)) ?>
<div class="control-group">
    <label class="control-label" for="TermTitle">Titre de la catégorie : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("title", array(
            'label' => false,
            'div' => false,
            'id' => 'title',
            'class' => 'span12',
            'value' => (!empty($aTerm['Term']['title'])) ? $aTerm['Term']['title']:null
        ))
        ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="TermTitle">Catégorie parente : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("parent_id", array(
            'label' => false,
            'div' => false,
            'id' => 'title',
            'class' => 'span12',
            'options' => $aParents
        ))
        ?>
    </div>
</div>

<?php echo $this->Block->element('manager_content_add') ?>

<?php if(isset($isEdit)): ?>
    <?php echo $this->Form->input('id', array(
        'type' => 'hidden',
        'value' => $aTerm['Term']['id']
    )) ?>
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