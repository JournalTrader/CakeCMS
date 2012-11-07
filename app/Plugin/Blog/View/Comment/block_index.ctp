<section id="comments-post">
    <div class="page-header">
        <h4>Laissez un commentaire</h4>
    </div>
    <?php echo $this->Form->create('Comment', array(
        'class' => 'form-horizontal',
        'url' => $this->Html->url(array(
            'block' => true,
            'plugin' => 'blog',
            'controller' => 'comment',
            'action' => 'post'
        ))
    )) ?>
    <div class="control-group">
        <label class="control-label" for="ModuleName"> Nom * : </label>
        <div class="controls required">
            <?php
            echo $this->Form->input("name", array(
                'label' => false,
                'div' => false,
                'class' => 'span12'
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
                'class' => 'span12'
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
                'class' => 'span12'
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
                'rows' => 6
            ))
            ?>
        </div>
    </div>
    
    <?php
    echo $this->Form->input("model", array(
        'type' => 'hidden',
        'label' => false,
        'div' => false,
        'value' => $model
    ))
    ?>
    <?php
    echo $this->Form->input("foreign_key", array(
        'type' => 'hidden',
        'label' => false,
        'div' => false,
        'value' => $foreign_key
    ))
    ?>
    
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