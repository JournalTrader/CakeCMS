<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#elements" data-toggle="tab">Elements</a></li>
    <li><a href="#menus" data-toggle="tab">Menus</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="elements">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Identifiant</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($aElements)): ?>
                <?php foreach($aElements as $aElement): ?>
                <tr>
                    <td><?php echo $aElement['Block']['name'] ?></td>
                    <td><?php echo $aElement['Block']['alias'] ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="3">
                        <p class="help-block"><i class="icon-warning-sign"></i> Aucun block menu existant !</p>
                    </td>
                </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="menus">
      <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Identifiant</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($aMenus)): ?>
                <?php foreach($aMenus as $aMenu): ?>
                <tr>
                    <td><?php echo $aMenu['Block']['name'] ?></td>
                    <td><?php echo $aMenu['Block']['alias'] ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="3">
                        <p class="help-block"><i class="icon-warning-sign"></i> Aucun block menu existant !</p>
                    </td>
                </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
  </div>
</div>