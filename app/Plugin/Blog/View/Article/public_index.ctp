<?php // debug($aArticles); ?>
<?php foreach($aArticles as $aArticle): ?>
<article>
    <h2><?php echo $this->Html->link($aArticle['Article']['title'], array(
        'public' => true,
        'plugin' => 'blog',
        'controller' => 'article', 
        'action' => 'read',
        'id' => $aArticle['Article']['id']
    )) ?></h2>
    <div class="post">
        <p><?php echo $this->Articles->extract($aArticle['Article']['content']) ?></p>
    </div>
</article>
<?php endforeach; ?>