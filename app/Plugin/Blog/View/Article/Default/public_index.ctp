<?php // debug($aArticles); ?>
<?php foreach($aArticles as $aArticle): ?>
<article>
    <?php 
        $aLink = array(
            'public' => true,
            'plugin' => 'blog',
            'controller' => 'article', 
            'action' => 'read',
            'id' => $aArticle['Article']['id']
        );
        
        if(!empty($aArticle['Seo']['slug']))
        {
            $aLink['slug'] = $aArticle['Seo']['slug'];
        }
    ?>
    <h2><?php echo $this->Html->link($aArticle['Article']['title'], $aLink) ?></h2>
    <div class="post">
        <p><?php echo $this->Articles->extract($aArticle['Article']['content']) ?></p>
    </div>
</article>
<?php endforeach; ?>