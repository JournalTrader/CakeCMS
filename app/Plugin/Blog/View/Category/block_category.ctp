<div class="row-fluid widget">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <span class="brand"><i class="icon-th-large"></i> Catégories</span>
            </div>
        </div>
    </div>
    <?php if(!empty($aTerms)): ?>
    <div class="control-group row-fluid">
        <label class="control-label span3" for="CategoryPost">Catégorie : </label>
        <div class="controls span9">
            <?php echo $this->Categories->getTreeCategories($aTerms, array()); ?>
        </div>
    </div>
    <?php endif ?>
    <hr />
</div>
