<?php // debug($aArticle); ?>
<section id="article">
    <article>
        <header class="page-header">
            <h1><?php echo $aArticle['Article']['title'] ?></h1>
        </header>
        <div class="article-details">
            <time datetime="<?php echo $aArticle['Article']['modified'] ?>"><?php echo $this->Tools->timeAgo($aArticle['Article']['modified']) ?></time>
        </div>
        <div class="post">
            <?php echo $this->Articles->content($aArticle['Article']['content']) ?>
        </div>
    </article>
</section>

<?php echo $this->requestAction(array(
    'block' => true,
    'public' => false,
    'plugin' => 'blog',
    'controller' => 'comment',
    'action' => 'read'
), array(
    'return',
    'named' => array(
        'model' => 'Article',
        'foreign_key' => $iId
    )
)) ?>

<?php echo $this->requestAction(array(
    'block' => true,
    'public' => false,
    'plugin' => 'blog',
    'controller' => 'comment',
    'action' => 'index'
), array(
    'return',
    'named' => array(
        'model' => 'Article',
        'foreign_key' => $iId
    )
)) ?>

<?php echo $this->Html->css('Blog.article.css', null, array(
    'inline' => false
)) ?>