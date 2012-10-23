<?php // debug($aMedias); ?>
<legend>Options d'alignement</legend>
<ul id="align-options">
    <li><label><input type="radio" name="align" value="align-left" checked="checked" /> Aligner à droite</label></li>
    <li><label><input type="radio" name="align" value="align-center"  /> Centrer</label></li>
    <li><label><input type="radio" name="align" value="align-right"  /> Aligner à gauche</label></li>
</ul>

<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th class="index center">#</th>
            <th colspan="2">Fichier</th>
        </tr>
    </thead>
    <tbody>
        <?php // debug($aMedias); ?>
        <?php if(!empty($aMedias)): ?>
            <?php foreach($aMedias as $aMedia): ?>
            <tr id="file_<?php echo $aMedia['Media']['id'] ?>">
                <td><input type="radio" name="radio" value="<?php echo  $aMedia['Media']['id'] ?>" data-src="<?php echo $aMedia['Media']['src'] ?>" data-thumbnail="<?php echo $this->Media->getPictureUrl($aMedia['Media']['src']) ?>" data-category="<?php echo $aMedia['Media']['category'] ?>" /></td>
                <td style="width: 90px;" >
                    <a class="edit-action" href="<?php echo $this->Html->url(array(
                        'manager' => true,
                        'plugin' => 'media',
                        'controller' => 'media',
                        'action' => 'add',
                        'type' => 'picture',
                        'id' => 1
                    )) ?>"><?php echo $this->Media->picture($aMedia, 80, null, array(
                        'class' => 'img-rounded img-polaroid'
                    )) ?></a>
                </td>
                <td>
                    <strong><a class="edit-action file-name" href="<?php echo $this->Html->url(array(
                        'manager' => true,
                        'plugin' => 'media',
                        'controller' => 'media',
                        'action' => 'add',
                        'type' => 'picture',
                        'id' => 1
                    )) ?>"><?php echo $aMedia['Media']['name'] ?></a></strong>
                    <ul>
                        <li class="type"><?php echo $aMedia['Media']['type'] ?></li>
                        <li class="type"><?php echo $this->Tools->timeAgo($aMedia['Media']['created']) ?></li>
                        <?php if(!empty($aMedia['Media']['description'])): ?>
                        <li class="description"><?php echo $aMedia['Media']['description'] ?></li>
                        <?php endif ?>
                    </ul>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">
                    <p class="help-block"><i class="icon-warning-sign"></i> <?php echo $this->Html->link("Uploadez votre première image !", array(
                        'manager' => true,
                        'plugin' => 'media',
                        'controller' => 'media',
                        'action' => 'add'
                    )) ?></p>
                </td>
            </tr>
        <?php endif ?>
    </tbody>
</table>