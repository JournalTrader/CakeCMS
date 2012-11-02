<?php echo  $this->Form->create('Article', array(
    'class' => 'form-horizontal'
)) ?>
<div class="control-group">
    <label class="control-label" for="PageTitle"> Titre de l'article : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("title", array(
            'label' => false,
            'div' => false,
            'id' => 'title',
            'class' => 'span12',
            'value' => (isset($aArticle) && !empty($aArticle['Article']['title'])) ? $aArticle['Article']['title']:null
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
            'rows' => '30',
            'value' => (isset($aArticle) && !empty($aArticle['Article']['content'])) ? $aArticle['Article']['content']:null
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
            'checked' => (isset($aArticle) && $aArticle['Article']['status'] == 1) ? true:false
        ))
        ?>
    </div>
</div>

<?php if(isset($isEdit)): ?>
    <?php
        echo $this->Form->input('id', array(
            'type' => 'hidden',
            'value' => (isset($aArticle) && !empty($aArticle['Article']['id'])) ? $aArticle['Article']['id']:null
        ));
     ?>
<?php endif ?>

<?php echo $this->Block->element('block_form') ?>

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