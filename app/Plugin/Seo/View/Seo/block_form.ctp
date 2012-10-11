<?php debug($aSeo); ?>

<div class="control-group">
    <label class="control-label" for="SeoTitle"> Titre du document : </label>
    <div class="controls required">
        <?php
            echo $this->Form->input("Seo.title", array(
                'label' => false,
                'div' => false,
                'class' => 'span12',
                'value' => (!empty($aSeo['Seo']['title'])) ? $aSeo['Seo']['title']:null
            ))
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="SeoDescription"> Description : </label>
    <div class="controls required">
        <?php
            echo $this->Form->input("Seo.description", array(
                'label' => false,
                'div' => false,
                'class' => 'span12',
                'rows' => 4,
                'value' => (!empty($aSeo['Seo']['description'])) ? $aSeo['Seo']['description']:null
            ))
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="SeoKeyword"> Mots clés : </label>
    <div class="controls required">
        <?php
            echo $this->Form->input("Seo.keywords", array(
                'label' => false,
                'div' => false,
                'class' => 'span12',
                'value' => (!empty($aSeo['Seo']['keywords'])) ? $aSeo['Seo']['keywords']:null
            ))
        ?>
    </div>
</div>