<?php echo $this->Form->create('Link', array(
    'class' => 'form-horizontal'
)) ?>
<div class="control-group">
    <label class="control-label" for="LinkSlug"> Adresse web : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("slug", array(
            'label' => false,
            'div' => false
        ))
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="LinkTitle"> Titre : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("title", array(
            'label' => false,
            'div' => false
        ))
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="LinkBlank"> Nouvelle fenêtre : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("blank", array(
            'type' => 'checkbox',
            'label' => false,
            'div' => false
        ))
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="LinkExternal"> Lien externe : </label>
    <div class="controls required">
        <?php
        echo $this->Form->input("external", array(
            'type' => 'checkbox',
            'label' => false,
            'div' => false
        ))
        ?>
    </div>
</div>
<?php if(!empty($aSeos)): ?>
  <table class="table table-striped table-bordered table-hover table-condensed">
      <tbody>
          <?php foreach($aSeos as $aSeo): ?>
          <tr>
              <td class="index center"><input type="radio" value="<?php echo $aSeo['Seo']['table_id'] ?>" data-title="<?php echo $aSeo['Seo']['title'] ?>" data-slug="<?php echo $aSeo['Seo']['slug'] ?>" /></td>
              <td><?php echo $aSeo['Seo']['title'] ?></td>
          </tr>
          <?php endforeach; ?>
      </tbody>
  </table>
<?php endif ?>

<?php echo $this->Form->end() ?>