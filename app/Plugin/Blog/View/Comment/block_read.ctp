<section id="comment-articles">
    <header class="page-header">
        <h4><?php echo $this->Tools->singularsAndPlurials(count($aComments), "Il y %s commentaire", "Il y %s commentaires", "Il n'a pas de commentaires") ?></h4>
    </header>
    <?php if(!empty($aComments)): ?>
        <?php foreach($aComments as $aComment): ?>
        <article id="comment-<?php echo $aComment['Comment']['id'] ?>" class="comment">
                <div class="comment-details">
                    <?php echo $this->Comments->author($aComment) ?>
                    <time datetime="<?php echo $aComment['Comment']['modified'] ?>"><?php echo $this->Tools->timeAgo($aComment['Comment']['modified']) ?></time>
                    <span class="said"> à dit : </span>
                </div>
                <?php echo $this->Articles->content($aComment['Comment']['content']) ?>
            </article>
        <?php endforeach; ?>
    <?php endif ?>
</section>