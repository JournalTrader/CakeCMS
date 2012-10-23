<div class="row-fluid">
   <?php echo $this->Form->create('Media') ?>

    <?php if($aMedia['Media']['category'] !== 'file'): ?>
    <div class="img-rounded img-polaroid">
        <?php echo $this->Media->picture($aMedia, 520, null, array(
            'class' => $aMedia['Media']['category'],
            'data-id' => $aMedia['Media']['id']
        )) ?>
    </div>
    
    <hr />
    <?php endif ?>
    
    <div class="control-group">
        <label class="control-label" for="MediaName">Nom : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("name", array(
                'label' => false,
                'div' => false,
                'class' => 'span12',
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
                'class' => 'span12',
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
</div>