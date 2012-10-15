<?php // debug($aArticles); ?>

<?php echo $this->Form->create() ?>
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th class="index center">#</th>
            <th>Title de l'article</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($aArticles)): ?>
        <?php foreach($aArticles as $aArticle): ?>
        <tr>
            <td class="index"><div class="btn-group">
                <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $this->Html->url(array(
                        'manager' => true,
                        'plugin' => 'blog',
                        'controller' => 'article',
                        'action' => 'add', 
                        'id' => 'article_' . $aArticle['Article']['id']
                    )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                    <li><a href="<?php echo $this->Html->url(array(
                        'manager' => true,
                        'plugin' => 'blog',
                        'controller' => 'article',
                        'action' => 'delete', 
                        'id' => 'article_' . $aArticle['Article']['id']
                    )) ?>" data-confirm-box="true"
                           data-confirm-box-content="Voulez-vous supprimer la page ?" 
                           data-confirm-box-cancel="Annuler" 
                           data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                </ul>
            </div></td>
            <td><?php echo $aArticle['Article']['title'] ?></td>
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
<?php
    echo $this->Form->input('blocks', array(
        'type' => 'hidden',
        'value' => 'manager_content_add'
    ));
?>
<?php echo $this->Form->end() ?>