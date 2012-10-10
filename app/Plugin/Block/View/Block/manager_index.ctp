<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#elements" data-toggle="tab">Elements</a></li>
    <li><a href="#menus" data-toggle="tab">Menus</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="elements">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th class="index center">#</th>
                    <th>Name</th>
                    <th>Identifiant</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($aElements)): ?>
                <?php foreach($aElements as $aElement): ?>
                <tr>
                    <td class="index"><div class="btn-group">
                        <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'block',
                                'controller' => 'block',
                                'action' => 'add_element', 
                                'id' => $aElement['Block']['id']
                            )) ?>"><i class="icon-plus"></i> Ajouter un élement</a></li>
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'block',
                                'controller' => 'block',
                                'action' => 'add', 
                                'id' => $aElement['Block']['id']
                            )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'block',
                                'controller' => 'block',
                                'action' => 'delete', 
                                'id' => $aElement['Block']['id']
                            )) ?>" data-confirm-box="true"
                                   data-confirm-box-content="Voulez-vous supprimer ce module ?" 
                                   data-confirm-box-cancel="Annuler" 
                                   data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                        </ul>
                    </div></td>
                    <td><?php echo $aElement['Block']['name'] ?></td>
                    <td><?php echo $aElement['Block']['alias'] ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="3">
                        <p class="help-block"><i class="icon-warning-sign"></i> Aucun block menu existant !</p>
                    </td>
                </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="menus">
      <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Identifiant</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($aMenus)): ?>
                <?php foreach($aMenus as $aMenu): ?>
                <tr>
                    <td class="index"><div class="btn-group">
                        <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'block',
                                'controller' => 'block',
                                'action' => 'add', 
                                'id' => $aMenu['Block']['id']
                            )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'block',
                                'controller' => 'block',
                                'action' => 'delete', 
                                'id' => $aMenu['Block']['id']
                            )) ?>" data-confirm-box="true"
                                   data-confirm-box-content="Voulez-vous supprimer ce module ?" 
                                   data-confirm-box-cancel="Annuler" 
                                   data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                                   
                        </ul>
                    </div></td>
                    <td><?php echo $aMenu['Block']['name'] ?></td>
                    <td><?php echo $aMenu['Block']['alias'] ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="3">
                        <p class="help-block"><i class="icon-warning-sign"></i> Aucun block menu existant !</p>
                    </td>
                </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
  </div>
</div>