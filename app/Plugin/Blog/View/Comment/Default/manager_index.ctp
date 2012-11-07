<?php // debug($aComments); ?>
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <td class="index center">#</td>
            <td>Auteur</td>
            <td class="comment">Commentaire</td>
            <td>En réponse à</td>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($aComments)): ?>
            <?php foreach($aComments as $aComment): ?>
                <tr>
                    <td class="index"><div class="btn-group">
                        <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if($aComment['Comment']['approved'] == 0): ?>
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'blog',
                                'controller' => 'comment',
                                'action' => 'approved', 
                                'id' => 'comment_' . $aComment['Comment']['id']
                            )) ?>"><i class="icon-ok"></i> Approuver</a></li>
                            <?php else: ?>
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'blog',
                                'controller' => 'comment',
                                'action' => 'approved', 
                                'id' => 'comment_' . $aComment['Comment']['id'],
                                'approved' => 0
                            )) ?>"><i class="icon-eye-close"></i> Désapprouvé</a></li>
                            <?php endif ?>
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'blog',
                                'controller' => 'comment',
                                'action' => 'add', 
                                'id' => 'comment_' . $aComment['Comment']['id']
                            )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'blog',
                                'controller' => 'comment',
                                'action' => 'undesirable', 
                                'id' => 'comment_' . $aComment['Comment']['id']
                            )) ?>"><i class="icon-ban-circle"></i> Indésirable</a></li>
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'blog',
                                'controller' => 'comment',
                                'action' => 'delete', 
                                'id' => 'comment_' . $aComment['Comment']['id']
                            )) ?>" data-confirm-box="true"
                                   data-confirm-box-content="Voulez-vous supprimer le tag ?" 
                                   data-confirm-box-cancel="Annuler" 
                                   data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                        </ul>
                    </div>
                    </td>
                    <td>
                        <div class="name"><strong><?php echo $aComment['Comment']['name'] ?></strong></div>
                        <hr />
                        <div class="mail"><i class="icon-envelope"></i> <a title="<?php echo $aComment['Comment']['mail'] ?>" href="mailto:<?php echo $aComment['Comment']['mail'] ?>"><?php echo $aComment['Comment']['mail'] ?></a></div>
                        <?php if(!empty($aComment['Comment']['web_site'])): ?>
                            <div class="web-site"><i class="icon-globe"></i> <a title="<?php echo $aComment['Comment']['web_site'] ?>" href="<?php echo $aComment['Comment']['web_site'] ?>"><?php echo $aComment['Comment']['web_site'] ?></a></div>
                        <?php endif ?>
                    </td>
                    <td>
                        <div class="submitted alert <?php echo ($aComment['Comment']['approved'] == 1) ? 'alert-success':null ?>"><?php echo $this->Tools->timeAgo($aComment['Comment']['created']) ?></div>
                        <?php echo $aComment['Comment']['content'] ?>
                    </td>
                    <td>
                        <div class="edit-article"><?php echo $this->Html->link($aComment['Article']['title'], array(
                            'manager' => true,
                            'plugin' => 'blog',
                            'controller' => 'article',
                            'action' => 'add',
                            'id' => strtolower($aComment['Comment']['model']) . '_' . $aComment['Article']['id']
                        ), array(
                            'title' => $aComment['Article']['title']
                        )) ?></div>
                        <hr />
                        <div class="view-article"><?php echo $this->Html->link("Voir l'article", array(
                            'manager' => false,
                            'public' => true,
                            'plugin' => 'blog',
                            'controller' => 'article',
                            'action' => 'read',
                            'id' => $aComment['Article']['id']
                        ), array(
                            'class' => 'btn'
                        )) ?></div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">
                    <p class="help-block"><i class="icon-warning-sign"></i> Il n'y a pas de commentaires !</p>
                </td>
            </tr>
        <?php endif ?>
    </tbody>
</table>

<?php echo $this->Html->css('Blog.article.css', null, array(
    'inline' => false
)) ?>