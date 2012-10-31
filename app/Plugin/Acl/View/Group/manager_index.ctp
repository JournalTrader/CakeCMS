<?php // debug($aGroups); ?>

<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th class="index center"><i class="icon-move"></i></th>
            <th colspan="2">Nom</th>
            <th class="index center">#</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($aGroups)): ?>
            <?php foreach($aGroups as $aGroup): ?>
                <tr>
                    <td><i class="icon-move"></i></td>
                    <td colspan="2"><?php echo $aGroup['Group']['name']?></td>
                    <td class="index center"><div class="btn-group">
                        <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'acl',
                                'controller' => 'group',
                                'action' => 'add', 
                                'id' => $aGroup['Group']['id']
                            )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'acl',
                                'controller' => 'group',
                                'action' => 'delete', 
                                'id' => $aGroup['Group']['id']
                            )) ?>" class="confirmModalBox" 
                                   data-box-title="Confirmation" 
                                   data-box-content="Voulez-vous supprimer ce module ?" 
                                   data-box-cancel="Annuler" data-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                        </ul>
                    </div></td>
                </tr>
                <?php if($aGroup['GroupChild']): ?>
                    <?php foreach($aGroup['GroupChild'] as $aGroupChild): ?>
                        <tr>
                            <td></td>
                            <td class="index center">--</td>
                            <td><?php echo $aGroupChild['name']?></td>
                            <td class="index center"><div class="btn-group">
                                <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array(
                                        'manager' => true,
                                        'plugin' => 'acl',
                                        'controller' => 'group',
                                        'action' => 'add', 
                                        'id' => $aGroupChild['id']
                                    )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                                    <li><a href="<?php echo $this->Html->url(array(
                                        'manager' => true,
                                        'plugin' => 'acl',
                                        'controller' => 'group',
                                        'action' => 'delete', 
                                        'id' => $aGroupChild['id']
                                    )) ?>" class="confirmModalBox" 
                                           data-box-title="Confirmation" 
                                           data-box-content="Voulez-vous supprimer ce module ?" 
                                           data-box-cancel="Annuler" data-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                                </ul>
                            </div></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif ?>
            <?php endforeach; ?>
        <?php endif ?>
    </tbody>
</table>