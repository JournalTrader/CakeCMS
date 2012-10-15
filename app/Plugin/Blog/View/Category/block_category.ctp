<div class="row-fluid widget">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <span class="brand"><i class="icon-th-large"></i> Catégories</span>
            </div>
        </div>
    </div>

    <div class="control-group row-fluid">
        <label class="control-label span3" for="CategoryPost">Catégorie : </label>
        <div class="controls span9">
            <?php echo $this->Categories->getTreeCategories($aTerms, array()); ?>
        </div>
    </div>

    <hr />
</div>