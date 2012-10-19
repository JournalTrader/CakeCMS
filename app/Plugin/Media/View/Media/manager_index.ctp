<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#picture" data-toggle="tab"><i class="icon-picture"></i> Images</a></li>
    <li><a href="#video" data-toggle="tab"><i class="icon-film"></i> Vidéos</a></li>
    <li><a href="#files" data-toggle="tab"><i class="icon-file"></i> Fichiers</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="picture">
      <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th class="index center">#</th>
                    <th colspan="2">Fichier</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php // debug($aMedias); ?>
                <?php if(!empty($aMedias)): ?>
                    <?php foreach($aMedias as $aMedia): ?>
                    <tr id="file_<?php echo $aMedia['Media']['id'] ?>">
                        <td><div class="btn-group">
                            <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="edit-action" href="<?php echo $this->Html->url(array(
                                    'manager' => false,
                                    'ajax' => true,
                                    'plugin' => 'media',
                                    'controller' => 'media',
                                    'action' => 'edit',
                                    'id' => $aMedia['Media']['id']
                                )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                                <li><a class="delete-action" href="<?php echo $this->Html->url(array(
                                    'manager' => false,
                                    'ajax' => true,
                                    'plugin' => 'media',
                                    'controller' => 'media',
                                    'action' => 'delete',
                                    'id' => $aMedia['Media']['id']
                                )) ?>" data-confirm-box="true"
                                       data-confirm-box-content="Voulez-vous supprimer le média ?" 
                                       data-confirm-box-cancel="Annuler" 
                                       data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                            </ul>
                        </div></td>
                        <td style="width: 90px;" >
                            <a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'media',
                                'controller' => 'media',
                                'action' => 'add',
                                'type' => 'picture',
                                'id' => 1
                            )) ?>"><img src="http://placehold.it/140x140" alt="Preview" class="img-rounded img-polaroid" width="80"/></a>
                        </td>
                        <td>
                            <strong><a class="file-name" href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'media',
                                'controller' => 'media',
                                'action' => 'add',
                                'type' => 'picture',
                                'id' => 1
                            )) ?>"><?php echo $aMedia['Media']['name'] ?></a></strong>
                            <ul>
                                <li class="type"><?php echo $aMedia['Media']['type'] ?></li>
                                <?php if(!empty($aMedia['Media']['description'])): ?>
                                <li class="description"><?php echo $aMedia['Media']['description'] ?></li>
                                <?php endif ?>
                                
                            </ul>
                        </td>
                        <td>Il y 3 heures</td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif ?>
                
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="video">
      <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th class="index center">#</th>
                    <th colspan="2">Fichier</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><div class="btn-group">
                        <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'media',
                                'controller' => 'media',
                                'action' => 'add'
                            )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'blog',
                                'controller' => 'media',
                                'action' => 'delete'
                            )) ?>" data-confirm-box="true"
                                   data-confirm-box-content="Voulez-vous supprimer la page ?" 
                                   data-confirm-box-cancel="Annuler" 
                                   data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                        </ul>
                    </div></td>
                    <td style="width: 90px;" >
                        <a href="<?php echo $this->Html->url(array(
                            'manager' => true,
                            'plugin' => 'media',
                            'controller' => 'media',
                            'action' => 'add',
                            'type' => 'picture',
                            'id' => 1
                        )) ?>"><img src="http://placehold.it/140x140" alt="Preview" class="img-rounded img-polaroid" width="80"/></a>
                    </td>
                    <td>
                        <strong><a href="<?php echo $this->Html->url(array(
                            'manager' => true,
                            'plugin' => 'media',
                            'controller' => 'media',
                            'action' => 'add',
                            'type' => 'picture',
                            'id' => 1
                        )) ?>">Nom de l'image</a></strong>
                        <ul>
                            <li>Type</li>
                            <li>Description de la vidéo avec pas plus de 250 caractères.</li>
                        </ul>
                    </td>
                    <td>Il y 3 heures</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="files">
      <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th class="index center">#</th>
                    <th colspan="2">Fichier</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><div class="btn-group">
                        <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => false,
                                'ajax' => true,
                                'plugin' => 'media',
                                'controller' => 'media',
                                'action' => 'edit'
                            )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'blog',
                                'controller' => 'media',
                                'action' => 'delete'
                            )) ?>" data-confirm-box="true"
                                   data-confirm-box-content="Voulez-vous supprimer la page ?" 
                                   data-confirm-box-cancel="Annuler" 
                                   data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                        </ul>
                    </div></td>
                    <td style="width: 90px;" >
                        <a href="<?php echo $this->Html->url(array(
                            'manager' => true,
                            'plugin' => 'media',
                            'controller' => 'media',
                            'action' => 'add',
                            'type' => 'picture',
                            'id' => 1
                        )) ?>"><img src="http://placehold.it/140x140" alt="Preview" class="img-rounded img-polaroid" width="80"/></a>
                    </td>
                    <td>
                        <strong><a href="<?php echo $this->Html->url(array(
                            'manager' => true,
                            'plugin' => 'media',
                            'controller' => 'media',
                            'action' => 'add',
                            'type' => 'picture',
                            'id' => 1
                        )) ?>">Nom de l'image</a></strong>
                        <ul>
                            <li>Type</li>
                            <li>Description du fichier avec pas plus de 250 caractères.</li>
                        </ul>
                    </td>
                    <td>Il y 3 heures</td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>
</div>

<?php echo $this->Html->script('Media.media') ?>

<script type="text/javascript">
    jQuery(function($) {
        $('table').media();
    });
</script>