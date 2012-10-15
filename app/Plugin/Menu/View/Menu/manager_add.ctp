<?php // debug($aMenu); ?>
<?php echo $this->Form->create('Menu', array(
    'class' => 'form-horizontal'
)) ?>
<fieldset>
    <legend>Informations générales</legend>
    <div class="control-group">
        <label class="control-label" for="MenuName">Libellé du menu : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("name", array(
                'label' => false,
                'div' => false,
                'value' => (!empty($aMenu['Menu']['name'])) ? $aMenu['Menu']['name']:null
            ))
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="MenuParentId">Lier à un menu parant : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("parent_id", array(
                'label' => false,
                'div' => false,
                'options' => $aParents,
                'value' => (!empty($aMenu['Menu']['parent_id'])) ? $aMenu['Menu']['parent_id']:null
            ))
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="MenuBlockId">Emplacement du menu : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("blocks_id", array(
                'label' => false,
                'div' => false,
                'options' => $aBlocks,
                'value' => (!empty($aMenu['Menu']['blocks_id'])) ? $aMenu['Menu']['blocks_id']:null
            ))
            ?>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>Options complémentaires</legend>
    <div class="control-group">
        <label class="control-label" for="MenuIsActive">Menu est-il actif ? : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input('is_active', array(
                'type' => 'checkbox',
                'label' => false,
                'div' => false,
                'checked' => (!empty($aMenu['Menu']['is_active']) && $aMenu['Menu']['is_active'] == 1) ? true:false
            ))
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="MenuBlockId">Liaisons : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("Other.liaison", array(
                'label' => false,
                'div' => false,
                'class' => 'fiedlsetOpions',
                'options' => array(
                    'none' => 'Choisir une liaison',
                    'module' => 'Vers un module'
//                    'page' => 'Vers une page',
//                    'article' => 'Vers une article'
                ),
                'value' => (!empty($aMenu['Menu']['plugins_id'])) ? 'module':null
            ))
            ?>
        </div>
    </div>
</fieldset>
<fieldset id="module" class="options" <?php echo (!empty($aMenu['Menu']['plugins_id'])) ? 'style="display: block;"':null ?>>
    <div class="control-group">
        <label class="control-label" for="MenuBlockId">Lier à un module : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("plugins_id", array(
                'label' => false,
                'div' => false,
                'options' => $aModules,
                'value' => (!empty($aMenu['Menu']['plugins_id'])) ? $aMenu['Menu']['plugins_id']:null
            ))
            ?>
        </div>
    </div>
</fieldset>
<!--<fieldset id="page" class="options">
    <legend>Options de liaison vers une page</legend>
    <div class="control-group">
        <label class="control-label" for="MenuPagesId">Lier à une page : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("pages_id", array(
                'label' => false,
                'div' => false,
                'options' => $aBlocks,
                'value' => ""
            ))
            ?>
        </div>
    </div>
</fieldset>
<fieldset id="article" class="options">
    <legend>Options de liaison vers un article</legend>
    <div class="control-group">
        <label class="control-label" for="MenuArticlesId">Lier à un article : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("articles_id", array(
                'label' => false,
                'div' => false,
                'options' => $aMenus,
                'value' => ""
            ))
            ?>
        </div>
    </div>
</fieldset>-->
<fieldset>
    <legend>Affichage</legend>
    <div class="control-group">
        <label class="control-label" for="MenuDisplay">Affichage du menu : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("display", array(
                'label' => false,
                'div' => false,
                'options' => $aModules,
                'value' => (!empty($aMenu['Menu']['display'])) ? $aMenu['Menu']['display']:null
            ))
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="MenuDisplay">Affichage absolu : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("display_absolute", array(
                'label' => false,
                'div' => false,
                'checked' => (!empty($aMenu['Menu']['display_absolute']) && $aMenu['Menu']['display_absolute'] == 1) ? true:false
            ))
            ?>
        </div>
    </div>
</fieldset>
<?php if(isset($isEdit)): ?>
    <?php echo $this->Form->input('id', array(
        'type' => 'hidden',
        'value' => $aMenu['Menu']['id']
    )) ?>
<?php endif ?>
    <div class="form-actions">
        <?php echo $this->Form->input("Envoyer", array(
            'type' => 'button',
            'div' => false,
            'label' => false,
            'class' => 'btn btn-primary'
        )) ?>
    </div>


<?php echo $this->Form->end() ?>

<?php echo $this->Html->script('tools/forms', array('inline' => false)) ?>