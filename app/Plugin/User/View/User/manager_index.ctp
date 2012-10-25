<?php // debug($aUsers); ?>
<?php echo $this->Form->create() ?>
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th class="index center">#</th>
            <th>Nom</th>
            <th>Mail</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($aUsers)): ?>
        <?php foreach($aUsers as $aUser): ?>
        <tr>
            <td class="index"><div class="btn-group">
                <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $this->Html->url(array(
                        'manager' => true,
                        'plugin' => 'user',
                        'controller' => 'user',
                        'action' => 'add', 
                        'id' => 'user_' . $aUser['User']['id']
                    )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                    <li><a href="<?php echo $this->Html->url(array(
                        'manager' => true,
                        'plugin' => 'user',
                        'controller' => 'user',
                        'action' => 'delete', 
                        'id' => 'user_' . $aUser['User']['id']
                    )) ?>" data-confirm-box="true"
                           data-confirm-box-content="Voulez-vous supprimer la page ?" 
                           data-confirm-box-cancel="Annuler" 
                           data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                </ul>
            </div></td>
            <td><?php echo $aUser['Profile']['first_name'] ?> <?php echo $aUser['Profile']['last_name'] ?></td>
            <td><?php echo $aUser['User']['mail'] ?></td>
            <td><?php echo $aUser['Groupe']['name'] ?></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="3">
                <p class="help-block"><i class="icon-warning-sign"></i> <?php echo $this->Html->link("Ajouter un premier utilisateur !", array(
                    'manager' => true,
                    'plugin' => 'user',
                    'controller' => 'user',
                    'action' => 'add'
                )) ?></p>
            </td>
        </tr>
        <?php endif ?>
    </tbody>
</table>
<?php
    echo $this->Form->input('blocks', array(
        'type' => 'hidden',
        'value' => 'manager_content_add'
    ));
?>
<?php echo $this->Form->end() ?>