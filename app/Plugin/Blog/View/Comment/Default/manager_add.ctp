<section id="comments-post">
    <div class="page-header">
        <h4>Modification d'un commentaire</h4>
    </div>
    <?php echo $this->Form->create('Comment', array(
        'class' => 'form-horizontal'
    )) ?>
    <div class="control-group">
        <label class="control-label" for="ModuleName"> Nom * : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("name", array(
                'label' => false,
                'div' => false,
                'class' => 'span12',
                'value' => $aComment['Comment']['name']
            ))
            ?>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="ModuleName"> Adresse mail * : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("mail", array(
                'label' => false,
                'div' => false,
                'class' => 'span12',
                'value' => $aComment['Comment']['mail']
            ))
            ?>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="ModuleName"> Site web : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("web_site", array(
                'label' => false,
                'div' => false,
                'class' => 'span12',
                'value' => (!empty($aComment['Comment']['name'])) ? $aComment['Comment']['name']:null
            ))
            ?>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="ModuleName"> Commentaire * : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("content", array(
                'type' => 'texatrea',
                'label' => false,
                'div' => false,
                'class' => 'span12',
                'placeholder' => "Votre message...",
                'rows' => 6,
                'value' => strip_tags($aComment['Comment']['content'])
            ))
            ?>
        </div>
    </div>
    
    <?php echo $this->Form->input("id", array(
        'type' => 'hidden',
        'label' => false,
        'div' => false,
        'value' => $aComment['Comment']['id']
    )) ?>
    
    <div class="form-actions">
        <?php
        echo $this->Form->input("Commenter", array(
            'type' => 'button',
            'div' => false,
            'label' => false,
            'class' => 'btn btn-primary'
        ))
        ?>
    </div>
    <?php echo $this->Form->end() ?>
</section>