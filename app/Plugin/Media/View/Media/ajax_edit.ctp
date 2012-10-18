<?php echo $this->Form->create('Media') ?>
<div class="control-group">
    <label class="control-label" for="MediaName">Nom : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("name", array(
            'label' => false,
            'div' => false,
            'value' => $aMedia['Media']['name']
        ))
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="MediaDescription">Description : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("description", array(
            'label' => false,
            'div' => false,
            'value' => $aMedia['Media']['description']
        ))
        ?>
    </div>
</div>
<?php
echo $this->Form->input('id', array(
    'type' => 'hidden',
    'value' => $aMedia['Media']['id']
));
?>
<?php echo $this->Form->end() ?>