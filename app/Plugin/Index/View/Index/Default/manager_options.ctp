<?php echo $this->Form->create('Option', array(
    'class' => 'form-horizontal'
)) ?>
<fieldset>
    <legend>Informations générales</legend>
    <div class="control-group">
        <label class="control-label" for="ModuleName">Nom du site : </label>
        <div class="controls required">
            <?php
                echo $this->Form->input("name_web_site", array(
                    'label' => false,
                    'div' => false,
                    'class' => 'span12',
                    'value' => $option->getOption('name_web_site')
                ))
            ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="ModuleName">Slogan : </label>
        <div class="controls required">
            <?php
                echo $this->Form->input("slogan", array(
                    'label' => false,
                    'div' => false,
                    'class' => 'span12',
                    'value' => $option->getOption('slogan')
                ))
            ?>
        </div>
    </div>
    
    <legend>Gestion de l'index</legend>
    <div class="control-group">
        <label class="control-label" for="ModuleName"> Vers un module : </label>
        <div class="controls required">
            <?php
                echo $this->Form->input("plugin_id", array(
                    'label' => false,
                    'div' => false,
                    'class' => 'span12',
                    'options' => $aModules,
                    'value' => $option->getOption('plugin_id')
                ))
            ?>
        </div>
    </div>
    <p class="help-block">Ou</p>
    <div class="control-group">
        <label class="control-label" for="ModuleName"> Vers une page : </label>
        <div class="controls required">
            <?php
                echo $this->Form->input("page_id", array(
                    'label' => false,
                    'div' => false,
                    'class' => 'span12',
                    'options' => $aPages,
                    'value' => $option->getOption('page_id')
                ))
            ?>
        </div>
    </div>
    <p class="help-block">Ou</p>
    <div class="control-group">
        <label class="control-label" for="ModuleName"> Vers un article : </label>
        <div class="controls required">
            <?php
                echo $this->Form->input("article_id", array(
                    'label' => false,
                    'div' => false,
                    'class' => 'span12',
                    'options' => $aArticles,
                    'value' => $option->getOption('article_id')
                ))
            ?>
        </div>
    </div>
</fieldset>

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