<?php // debug($aArticle); ?>
<article>
    <div class="page-header">
        <h1><?php echo $aArticle['Article']['title'] ?></h1>
    </div>
    <div class="post">
        <?php echo $this->Articles->content($aArticle['Article']['content']) ?>
    </div>
</article>