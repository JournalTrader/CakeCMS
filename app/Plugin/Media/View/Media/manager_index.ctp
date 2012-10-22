<div class="tabbable">
  <ul class="nav nav-tabs">
      <li class="active"><a href="#picture" data-toggle="tab"><i class="icon-picture"></i> Images <?php echo (isset($aMedias[MediaController::TYPE_PICTURE]) && count($aMedias[MediaController::TYPE_PICTURE]) > 0) ? '(' . count($aMedias[MediaController::TYPE_PICTURE]) . ')':'' ?></a></li>
    <li><a href="#video" data-toggle="tab"><i class="icon-film"></i> Vidéos <?php echo (isset($aMedias[MediaController::TYPE_VIDEO]) && count($aMedias[MediaController::TYPE_VIDEO]) > 0) ? '(' . count($aMedias[MediaController::TYPE_VIDEO]) . ')':'' ?></a></li>
    <li><a href="#files" data-toggle="tab"><i class="icon-file"></i> Fichiers <?php echo (isset($aMedias[MediaController::TYPE_FILE]) && count($aMedias[MediaController::TYPE_FILE]) > 0) ? '(' . count($aMedias[MediaController::TYPE_FILE]) . ')':'' ?></a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="picture">
      <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th class="index center">#</th>
                    <th colspan="2">Fichier</th>
                    <th class="time-ago">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php // debug($aMedias); ?>
                <?php if(!empty($aMedias) && !empty($aMedias[MediaController::TYPE_PICTURE])): ?>
                    <?php foreach($aMedias[MediaController::TYPE_PICTURE] as $aMedia): ?>
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
                                    'manager' => true,
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
                            <a class="edit-action" href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'media',
                                'controller' => 'media',
                                'action' => 'add',
                                'type' => 'picture',
                                'id' => 1
                            )) ?>"><?php echo $this->Media->picture($aMedia, 80, null, array(
                                'class' => 'img-rounded img-polaroid'
                            )) ?></a>
                        </td>
                        <td>
                            <strong><a class="edit-action file-name" href="<?php echo $this->Html->url(array(
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
                        <td><?php echo $this->Tools->timeAgo($aMedia['Media']['created']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">
                            <p class="help-block"><i class="icon-warning-sign"></i> <?php echo $this->Html->link("Uploadez votre première image !", array(
                                'manager' => true,
                                'plugin' => 'media',
                                'controller' => 'media',
                                'action' => 'add'
                            )) ?></p>
                        </td>
                    </tr>
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
                    <th class="time-ago">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($aMedias) && !empty($aMedias[MediaController::TYPE_VIDEO])): ?>
                    <?php foreach($aMedias[MediaController::TYPE_VIDEO] as $aMedia): ?>
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
                                    'manager' => true,
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
                            <a class="edit-action" href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'media',
                                'controller' => 'media',
                                'action' => 'add',
                                'type' => 'picture',
                                'id' => 1
                            )) ?>"><?php echo $this->Html->image($this->Media->geturl($aMedia['Media']['src']), array(
                                'class' => 'img-rounded img-polaroid',
                                'width' => 80
                            )) ?></a>
                        </td>
                        <td>
                            <strong><a class="edit-action file-name" href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'media',
                                'controller' => 'media',
                                'action' => 'add',
                                'type' => 'picture',
                                'id' => 1
                            )) ?>"><?php echo $aMedia['Media']['name'] ?></a></strong>
                            <ul>
                                <li class="type">Vidéo</li>
                                <?php if(!empty($aMedia['Media']['description'])): ?>
                                <li class="description"><?php echo $aMedia['Media']['description'] ?></li>
                                <?php endif ?>
                                
                            </ul>
                        </td>
                        <td><?php echo $this->Tools->timeAgo($aMedia['Media']['created']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">
                            <p class="help-block"><i class="icon-warning-sign"></i> <?php echo $this->Html->link("Uploadez votre première vidéo !", array(
                                'manager' => true,
                                'plugin' => 'media',
                                'controller' => 'media',
                                'action' => 'add'
                            )) ?></p>
                        </td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="files">
      <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th class="index center">#</th>
                    <th colspan="2">Fichier</th>
                    <th class="time-ago">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($aMedias) && !empty($aMedias[MediaController::TYPE_FILE])): ?>
                    <?php foreach($aMedias[MediaController::TYPE_FILE] as $aMedia): ?>
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
                                    'manager' => true,
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
                            <a class="edit-action" href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'media',
                                'controller' => 'media',
                                'action' => 'add',
                                'type' => 'picture',
                                'id' => 1
                            )) ?>"><?php echo $this->Media->pictureFile($aMedia, 80, null, array(
                                'class' => 'img-rounded img-polaroid'
                            )) ?></a>
                        </td>
                        <td>
                            <strong><a class="edit-action file-name" href="<?php echo $this->Html->url(array(
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
                        <td><?php echo $this->Tools->timeAgo($aMedia['Media']['created']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">
                            <p class="help-block"><i class="icon-warning-sign"></i> <?php echo $this->Html->link("Uploadez votre premier fichier !", array(
                                'manager' => true,
                                'plugin' => 'media',
                                'controller' => 'media',
                                'action' => 'add'
                            )) ?></p>
                        </td>
                    </tr>
              <?php endif ?>
            </tbody>
        </table>
    </div>
  </div>
</div>

<?php echo $this->Html->css('Media.media-style') ?>
<?php echo $this->Html->script('Media.media') ?>

<script type="text/javascript">
    jQuery(function($) {
        $('table').media().listMedia();
    });
</script>