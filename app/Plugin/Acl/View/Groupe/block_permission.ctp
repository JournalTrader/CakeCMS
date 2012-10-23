<legend>Gestion des permissions</legend>
<?php if($aGroupes): ?>
<div class="control-group">
    <div class="controls">
        <?php foreach($aGroupes as $aGroupe): ?>
        <label class="checkbox">
            <input name="data[Groupe][id][]" type="checkbox" value="<?php echo $aGroupe['Groupe']['id'] ?>" /><?php echo $aGroupe['Groupe']['name'] ?>
        </label>
        <?php endforeach; ?>   
    </div>
</div>
<?php endif ?>
