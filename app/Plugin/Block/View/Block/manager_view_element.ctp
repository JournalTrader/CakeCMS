<?php // debug($aElements); ?>

<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th class="index center">#</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($aElements['Element'])): ?>
        <?php foreach($aElements['Element'] as $aElement): ?>
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
                        'id' => $iId,
                        'element_id' => $aElement['id']
                    )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                    <li><a href="<?php echo $this->Html->url(array(
                        'manager' => true,
                        'plugin' => 'block',
                        'controller' => 'block',
                        'action' => 'delete_element', 
                        'id' => $iId,
                        'element_id' => $aElement['id']
                    )) ?>" data-confirm-box="true"
                           data-confirm-box-content="Voulez-vous supprimer ce module ?" 
                           data-confirm-box-cancel="Annuler" 
                           data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                </ul>
            </div></td>
            <td><?php echo $aElement['name'] ?></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="3">
                <p class="help-block"><i class="icon-warning-sign"></i> Aucun élément existant !</p>
            </td>
        </tr>
        <?php endif ?>
    </tbody>
</table>