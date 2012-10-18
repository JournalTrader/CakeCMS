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
        <?php echo $this->Html->css('Media.media-style.css', null, array(
            'inline' => false
        )) ?>   
        
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
    </div>
    <div class="tab-pane" id="web">
      
    </div>
  </div>
</div>

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
    
</script>