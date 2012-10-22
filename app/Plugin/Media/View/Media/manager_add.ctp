<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#download" data-toggle="tab"><i class="icon-download-alt"></i> Télécharger</a></li>
    <li><a href="#web" data-toggle="tab"><i class="icon-bookmark"></i> Sur le Web</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="download">
        <div id="upload" class="span12">
            <h2>Déposez vos fichiers ici</h2>
            <p>ou</p>
            <p><a href="#" class="btn" id="browser"><i class="icon-plus"></i> Selectionnez les fichiers</a></p>
        </div>
 
    </div>
    <div class="tab-pane" id="web">
      <?php echo $this->Form->create('Media', array(
            'class' => 'form-horizontal',
            'id' => 'upload-form',
            'url' => array(
                'manager' => false,
                'ajax' => true,
                'plugin' => 'media',
                'controller' => 'media',
                'action' => 'add_to_web'
            )
        )) ?>
        <div class="control-group">
            <label class="control-label" for="ModuleName">Nom : </label>
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
            <label class="control-label" for="ModuleSrc">Url : </label>
            <div class="controls required">
                <?php
                echo $this->Form->input("src", array(
                    'label' => false,
                    'div' => false,
                    'class' => 'span12'
                ))
                ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="ModuleDescription">Description : </label>
            <div class="controls">
                <?php
                echo $this->Form->input("description", array(
                    'label' => false,
                    'div' => false,
                    'class' => 'span12',
                    'rows' => 3
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
        <?php echo $this->Form->end() ?>
    </div>
  </div>
</div>

<div class="row-fluid hide" id="file-list">
    <hr />
    <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th class="index center">#</th>
                <th colspan="2">Fichier</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<?php echo $this->Html->css('Media.media-style.css', null, array(
    'inline' => false
)) ?>  
<?php echo $this->Html->script('tools/forms', array(
    'inline' => false
)) ?>
<?php echo $this->Html->script('Media.media', array(
    'inline' => false
)) ?>
<?php  echo $this->Html->script('Media.plupload/plupload', array(
    'inline' => false
))?>
<?php echo $this->Html->script('Media.plupload/plupload.flash', array(
    'inline' => false
))?>
<?php echo $this->Html->script('Media.plupload/plupload.html5', array(
    'inline' => false
))?>
<?php echo $this->Html->script('Media.plupload', array(
    'inline' => false
))?>
<script type="text/javascript">
    if(jQuery().plupload)
    {
        $('#upload').plupload({
            url_upload: '<?php echo $this->Html->url(array(
                'manager' => false,
                'ajax' => true,
                'plugin' => 'media',
                'controller' => 'media',
                'action' => 'upload'
            )) ?>',
            flash_swf_url: '/media/js/plupload/plupload.flash.swf'
        });
    }
    
        if(jQuery().media)
        {
            $('#upload-form').media().addMedia();
        }
    
</script>