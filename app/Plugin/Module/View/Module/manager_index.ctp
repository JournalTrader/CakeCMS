<table class="table table-condensed table-hover table-bordered">
  <thead>
    <tr>
      <th class="index center">#</th>
      <th class="name">Name</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
      <?php if($aModules): ?>
          <?php foreach($aModules as $aKey => $aModule): ?>
              <?php // debug($aModule); ?>
            <tr>
              <td class="index">
                  <div class="btn-group">
                      <button class="btn dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                          <li><a href="">Modifier</a></li>
                          <li><a href="">Supprimer</a></li>
                      </ul>
                  </div>
              </td>
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
                            <li><a href="<?php echo $this->Html->url(array(
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