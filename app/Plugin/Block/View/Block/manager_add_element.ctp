<?php echo $this->Form->create('Element', array(
    'class' => 'form-horizontal'
)) ?>
<fieldset>
    <legend>Informations générales</legend>
    <div class="control-group">
        <label class="control-label" for="ElemenntName">Nom : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("name", array(
                'label' => false,
                'div' => false,
                'value'=> (!empty($aElement['Element']['name'])) ? $aElement['Element']['name']:null
            ))
            ?>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="ElementPluginId">Choisir le block : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("plugins_id", array(
                'label' => false,
                'div' => false,
                'options' => $aBlocks,
                'value'=> (!empty($aElement['Element']['plugins_id'])) ? $aElement['Element']['plugins_id']:null
            ))
            ?>
        </div>
    </div>
    
    <legend>Affichage</legend>
    <div class="control-group">
        <label class="control-label" for="MenuDisplay">Affichage du menu : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("display", array(
                'label' => false,
                'div' => false,
                'options' => $aModules,
                'value' => (!empty($aElement['Element']['display'])) ? $aElement['Element']['display']:null
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
                'checked' => (!empty($aElement['Element']['display_absolute']) && $aElement['Element']['display_absolute'] == 1) ? true:false
            ))
            ?>
        </div>
    </div>
    
    <?php if(!empty($iId)): ?>
        <?php echo $this->Form->input('blocks_id', array(
            'type' => 'hidden',
            'value' => $iId
        )) ?>
    <?php endif ?>
    
    <?php if(isset($isEdit)): ?>
        <?php
             echo $this->Form->input('id', array(
                 'type' => 'hidden',
                 'value' => $aElement['Element']['id']
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
</fieldset>
<?php echo $this->Form->end() ?>