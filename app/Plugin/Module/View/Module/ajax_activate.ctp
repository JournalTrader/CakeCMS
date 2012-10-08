<?php echo $this->Form->create('Module', array(
    'form' => 'form-horizontal'
)); ?>
<?php // debug($aModule); ?>
<table class="table table-condensed table-hover table-bordered">
  <thead>
    <tr>
      <th class="index center">#</th>
      <th class="name">Nom</th>
    </tr>
  </thead>
  <tbody>
      <tr>
          <td>
              <?php echo $this->Form->input('Module.id.' . $aModule['Module']['id'], array(
                  'type' => 'checkbox',
                  'id' => 'checkAll',
                  'div' => false,
                  'label' => false,
                  'checked' => ($aModule['Plugin']['is_active'] == true) ? true:false
              )); ?>
          </td>
          <td colspan="2"><?php echo $aModule['Module']['name'] ?></td>
      </tr>
      <tr>
          <td>
              <?php echo $this->Form->input('Plugin.id.' . $aModule['Plugin']['id'], array(
                  'type' => 'checkbox',
                  'div' => false,
                  'label' => false,
                  'checked' => ($aModule['Plugin']['is_active'] == true) ? true:false
              )); ?>
          </td>
          <td class="index center">--</td>
          <td><?php echo $aModule['Plugin']['name'] ?></td>
      </tr>
      <?php foreach($aModule['Plugin']['ChildPlugin'] as $aChildPlugin): ?>
      <tr>
          <td>
              <?php echo $this->Form->input('Plugin.id.' . $aChildPlugin['id'], array(
                  'type' => 'checkbox',
                  'div' => false,
                  'label' => false,
                  'checked' => ($aChildPlugin['is_active'] == true) ? true:false
              )); ?>
          </td>
          <td class="index center">--</td>
          <td><?php echo $aChildPlugin['name'] ?></td>
      </tr>
      <?php endforeach ?>
  </tbody>
</table>

<?php echo $this->Form->end() ?>