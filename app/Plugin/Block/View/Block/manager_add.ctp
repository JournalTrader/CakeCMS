<?php echo $this->Form->create('Block', array(
    'class' => 'form-horizontal'
)); ?>
<fieldset>
    <legend>Informations générales</legend>
    <div class="control-group">
        <label class="control-label" for="BlockName">Libellé du block : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input('name', array(
                'label' => false,
                'div' => false,
                'value' => (isset($aBlock['Block']['name'])) ? $aBlock['Block']['name']:null
            ))
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="BlockType">Type de block : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input('type', array(
                'label' => false,
                'div' => false,
                'options' => array(
                    0 => "Choisir un type",
                    'menu' => "Menu",
                    'element' => 'Élément'
                ),
                'value' => (isset($aBlock['Block']['type'])) ? $aBlock['Block']['type']:null
            ))
            ?>
        </div>
    </div>
    
    <?php if(isset($aBlock['Block']['id'])): ?>
        <?php echo $this->Form->input('id', array(
            'type' => 'hidden',
            'value' => $aBlock['Block']['id']
        )); ?>
    <?php endif ?>
    
    <div class="form-actions">
        <?php
        echo $this->Form->input("Envoyer", array(
            'type' => 'button',
            'label' => false,
            'div' => false,
            'class' => 'btn btn-primary'
        ));
        ?>
    </div>
</fieldset>
<?php echo $this->Form->end() ?>