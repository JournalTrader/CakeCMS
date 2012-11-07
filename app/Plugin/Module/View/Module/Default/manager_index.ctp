<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#general" data-toggle="tab">Module additionnels</a></li>
    <li><a href="#core" data-toggle="tab">Module coeur</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="general">
        <table class="table table-condensed table-hover table-bordered">
          <thead>
            <tr>
              <th class="name">Name</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
              <?php if($aModules): ?>
                  <?php foreach($aModules as $aKey => $aModule): ?>
                      <?php if($aModule['core'] === false): ?>
                          <?php // debug($aModule); ?>
                        <tr>
                          <td>
                              <span class="name"><?php echo $aModule['name'] ?></span>
                              <div class="module-tools">
                                  <ul class="credit">
                                       <?php if(!$aModule['is_installed']): ?>
                                        <li><a href="<?php echo $this->Html->url(array(
                                            'manager' => true,
                                            'plugin' => 'module',
                                            'controller' => 'module',
                                            'action' => 'installer',
                                            'id' => ($aKey + 1)
                                        )) ?>"><i class="icon-plus"></i> Installer</a></li>
                                        <?php else: ?>
                                        <li><a data-form-ajax="true" href="<?php echo $this->Html->url(array(
                                            'ajax' => true,
                                            'plugin' => 'module',
                                            'controller' => 'module',
                                            'action' => 'activate',
                                            'id' => $aModule['id']
                                        )) ?>"><i class="icon-off"></i> Gestionnaire d'activation</a></li> 
                                        <li class="sperator"> | </li>
                                        <li><a data-confirm-box="true"
                                               data-confirm-box-request="true"
                                               data-confirm-box-content="Voulez-vous supprimer les fichiers liés au module ?"
                                               data-confirm-box-query="dir=true"
                                               data-confirm-box-action="Oui"
                                               data-confirm-box-cancel="Non"
                                               href="<?php echo $this->Html->url(array(
                                            'manager' => true,
                                            'plugin' => 'module',
                                            'controller' => 'module',
                                            'action' => 'uninstall',
                                            'id' => $aModule['id']
                                        )) ?>"><i class="icon-trash"></i> Supprimer</a></li>
                                        <?php endif ?>                          
                                  </ul>
                              </div>

                          </td>
                          <td class="description">
                              <p><?php echo $aModule['description'] ?></p>
                              <ul class="credit">
                                  <li>Autheur : <?php echo $aModule['author'] ?></li>                      
                                  <li class="sperator"> - </li>
                                  <li>Site : <?php echo (!empty($aModule['site'])) ? $this->Html->link($aModule['site'], $aModule['url']):$this->Html->link($aModule['url'], $aModule['url']) ?></li>
                                  <li class="sperator"> - </li>
                                  <li>Version : <?php echo $aModule['version'] ?></li>
                              </ul>
                          </td>
                        </tr> 
                      <?php endif ?>
                       
                  <?php endforeach ?>

            <?php else: ?>
            <tr>
                <td colspan="3">
                    <p class="help-block"><i class="icon-warning-sign"></i> Aucun module existant !</p>
                </td>
            </tr>
            <?php endif ?>
          </tbody>
        </table>
    </div>
    <div class="tab-pane" id="core">
    <div class="alert alert-info">
        <strong>Info !</strong> La suppression d'un de ses modules entrainera des disfonctionnements générals.
    </div>
      <table class="table table-condensed table-hover table-bordered">
          <thead>
            <tr>
              <th class="name">Name</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
              <?php if($aModules): ?>
                  <?php foreach($aModules as $aKey => $aModule): ?>
                      <?php // debug($aModule); ?>
              <?php if($aModule['core'] !== false): ?>
                    <tr>
                      <td>
                          <span class="name"><?php echo $aModule['name'] ?></span>
                          <div class="module-tools">
                              <ul class="credit">
                                   <?php if(!$aModule['is_installed']): ?>
                                    <li><a href="<?php echo $this->Html->url(array(
                                        'manager' => true,
                                        'plugin' => 'module',
                                        'controller' => 'module',
                                        'action' => 'installer',
                                        'id' => ($aKey + 1)
                                    )) ?>"><i class="icon-plus"></i> Installer</a></li>
                                    <?php else: ?>
                                    <li><a data-form-ajax="true" href="<?php echo $this->Html->url(array(
                                        'ajax' => true,
                                        'plugin' => 'module',
                                        'controller' => 'module',
                                        'action' => 'activate',
                                        'id' => $aModule['id']
                                    )) ?>"><i class="icon-off"></i> Gestionnaire d'activation</a></li> 
                                    <li class="sperator"> | </li>
                                    <li><a data-confirm-box="true"
                                           data-confirm-box-request="true"
                                           data-confirm-box-content="Voulez-vous supprimer les fichiers liés au module ?"
                                           data-confirm-box-query="dir=true"
                                           data-confirm-box-action="Oui"
                                           data-confirm-box-cancel="Non"
                                           href="<?php echo $this->Html->url(array(
                                        'manager' => true,
                                        'plugin' => 'module',
                                        'controller' => 'module',
                                        'action' => 'uninstall',
                                        'id' => $aModule['id']
                                    )) ?>"><i class="icon-trash"></i> Supprimer</a></li>
                                    <?php endif ?>                          
                              </ul>
                          </div>

                      </td>
                      <td class="description">
                          <p><?php echo $aModule['description'] ?></p>
                          <ul class="credit">
                              <li>Autheur : <?php echo $aModule['author'] ?></li>                      
                              <li class="sperator"> - </li>
                              <li>Site : <?php echo (!empty($aModule['site'])) ? $this->Html->link($aModule['site'], $aModule['url']):$this->Html->link($aModule['url'], $aModule['url']) ?></li>
                              <li class="sperator"> - </li>
                              <li>Version : <?php echo $aModule['version'] ?></li>
                          </ul>
                      </td>
                    </tr>  
                  <?php endif ?>
                  <?php endforeach ?>

            <?php else: ?>
            <tr>
                <td colspan="3">
                    <p class="help-block"><i class="icon-warning-sign"></i> Aucun module existant !</p>
                </td>
            </tr>
            <?php endif ?>
          </tbody>
        </table>
    </div>
  </div>
</div>