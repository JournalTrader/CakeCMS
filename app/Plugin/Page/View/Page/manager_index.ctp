<?php // debug($aPages); ?>
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th class="index center">#</th>
            <th>Title de la page</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($aPages)): ?>
        <?php foreach($aPages as $aPage): ?>
        <tr>
            <td class="index"><div class="btn-group">
                <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $this->Html->url(array(
                        'manager' => true,
                        'plugin' => 'page',
                        'controller' => 'page',
                        'action' => 'add', 
                        'id' => $aPage['Page']['id']
                    )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                    <li><a href="<?php echo $this->Html->url(array(
                        'manager' => true,
                        'plugin' => 'page',
                        'controller' => 'page',
                        'action' => 'delete', 
                        'id' => $aPage['Page']['id']
                    )) ?>" data-confirm-box="true"
                           data-confirm-box-content="Voulez-vous supprimer ce module ?" 
                           data-confirm-box-cancel="Annuler" 
                           data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                </ul>
            </div></td>
            <td><?php echo $aPage['Page']['title'] ?></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="3">
                <p class="help-block"><i class="icon-warning-sign"></i> Créez votre première page !</p>
            </td>
        </tr>
        <?php endif ?>
    </tbody>
</table>
