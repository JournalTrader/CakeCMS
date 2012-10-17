<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#download" data-toggle="tab"><i class="icon-download-alt"></i> Télécharger</a></li>
    <li><a href="#web" data-toggle="tab"><i class="icon-bookmark"></i> Sur le Web</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="download">
        <div id="upload" class="row-fluid">
            <h2>Déposez vos fichiers ici</h2>
            <p>ou</p>
            <p><a href="#" class="btn"><i class="icon-plus"></i> Selectionnez les fichiers</a></p>
        </div>

        <?php echo $this->Html->css('Media.media-style.css', null, array(
            'inline' => false
        )) ?>      
    </div>
    <div class="tab-pane" id="web">
      
    </div>
  </div>
</div>


