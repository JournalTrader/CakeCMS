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
                'value' => ""
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
                'options' => $aBlocks
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
</fieldset>

<?php echo $this->Form->end() ?>