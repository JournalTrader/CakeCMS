<?php // debug($aArticles); ?>

<?php echo $this->Form->create('Term') ?>
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th class="index center">#</th>
            <th>Title du tag</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($aTerms)): ?>
        <?php foreach($aTerms as $aTerm): ?>
        <tr>
            <td class="index"><div class="btn-group">
                <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $this->Html->url(array(
                        'manager' => true,
                        'plugin' => 'blog',
                        'controller' => 'tag',
                        'action' => 'add', 
                        'id' => 'tag_' . $aTerm['Term']['id']
                    )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                    <li><a href="<?php echo $this->Html->url(array(
                        'manager' => true,
                        'plugin' => 'blog',
                        'controller' => 'tag',
                        'action' => 'delete', 
                        'id' => 'tag_' . $aTerm['Term']['id']
                    )) ?>" data-confirm-box="true"
                           data-confirm-box-content="Voulez-vous supprimer le tag ?" 
                           data-confirm-box-cancel="Annuler" 
                           data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                </ul>
            </div></td>
            <td><?php echo $aTerm['Term']['title'] ?></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="3">
                <p class="help-block"><i class="icon-warning-sign"></i> <?php echo $this->Html->link("Créez votre premier tag !", array(
                    'manager' => true,
                    'plugin' => 'blog',
                    'controller' => 'tag',
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