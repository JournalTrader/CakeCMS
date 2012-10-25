<?php // debug($aModules); ?>
<?php // debug($aGroupes); ?>
<?php echo $this->Form->create() ?>
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th>#</th>
            <th colspan="2">Nom</th>
            <?php foreach($aGroupes as $aGroupe): ?>
            <th class="index center"><a href="#" rel="tooltip" data-placement="top" data-original-title="<?php echo $aGroupe['Groupe']['name'] ?>"><?php echo substr($aGroupe['Groupe']['name'], 0, 1) ?></a></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($aModules)): ?>
            <?php foreach($aModules as $aModule): ?>
            <tr>
                <td class="index"><div class="btn-group">
                    <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->url(array(
                            'manager' => true,
                            'plugin' => 'page',
                            'controller' => 'page',
                            'action' => 'add', 
                            'id' => 'module_' . $aModule['Module']['id']
                        )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                        <li><a href="<?php echo $this->Html->url(array(
                            'manager' => true,
                            'plugin' => 'page',
                            'controller' => 'page',
                            'action' => 'delete', 
                            'id' => 'module_' . $aModule['Module']['id']
                        )) ?>" data-confirm-box="true"
                               data-confirm-box-content="Voulez-vous supprimer la page ?" 
                               data-confirm-box-cancel="Annuler" 
                               data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                    </ul>
                </div></td>
                <td colspan="2"><?php echo $aModule['Module']['name'] ?></td>
                <?php foreach($aGroupes as $aGroupe): ?>
                <td class="index center">
                    <?php 
                        $checked = false;
                        
                        foreach($aModule['Plugin']['Acl'] as $aAcl)
                        {
                            foreach($aAcl['Aro'] as $aro)
                            {
                                if($aro['foreign_key'] == $aGroupe['Groupe']['id'])
                                {
                                    if(!empty($aro['Permission']['_create']) && $aro['Permission']['_create'] == 1)
                                    {
                                        $checked = true;
                                    }
                                }
                            }
                        }
                    
                    ?>
                    <?php
                        echo $this->Form->input("Groupe." . $aGroupe['Groupe']['id'] . "." . $aModule['Plugin']['id'], array(
                            'type' => 'checkbox',
                            'class' => 'module',
                            'data-module-id' => $aModule['Module']['id'],
                            'data-groupe-id' => $aGroupe['Groupe']['id'],
                            'label' => false,
                            'div' => false,
                            'checked' => ($checked) ? true:false,
                            'value' => 1
                        )) ?>
                </td>
                <?php endforeach; ?>
            </tr>  
            <?php if(!empty($aModule['Plugin']['ChildPlugin'])): ?>
                <?php foreach($aModule['Plugin']['ChildPlugin'] as $aChildPlugin): ?>
                <tr class="children_<?php echo $aModule['Module']['id'] ?>">
                    <td class="index"><div class="btn-group">
                        <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'page',
                                'controller' => 'page',
                                'action' => 'add', 
                                'id' => 'module_' . $aChildPlugin['id']
                            )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                            <li><a href="<?php echo $this->Html->url(array(
                                'manager' => true,
                                'plugin' => 'page',
                                'controller' => 'page',
                                'action' => 'delete', 
                                'id' => 'module_' . $aChildPlugin['id']
                            )) ?>" data-confirm-box="true"
                                   data-confirm-box-content="Voulez-vous supprimer la page ?" 
                                   data-confirm-box-cancel="Annuler" 
                                   data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                        </ul>
                    </div></td>
                    <td class="index center">--</td>
                    <td><?php echo $aChildPlugin['name'] ?></td>
                    <?php foreach($aGroupes as $aGroupe): ?>
                    <td class="index center">
                        <?php 
                            $checked = false;

                            foreach($aChildPlugin['Acl'] as $aAcl)
                            {
                                foreach($aAcl['Aro'] as $aro)
                                {
                                    if($aro['foreign_key'] == $aGroupe['Groupe']['id'])
                                    {
                                        if(!empty($aro['Permission']['_create']) && $aro['Permission']['_create'] == 1)
                                        {
                                            $checked = true;
                                        }
                                    }
                                }
                            }

                        ?>
                        <?php
                            echo $this->Form->input("Groupe." . $aGroupe['Groupe']['id'] . "." . $aChildPlugin['id'], array(
                                'type' => 'checkbox',
                                'class' => 'plugins groupe_' . $aGroupe['Groupe']['id'],
                                'label' => false,
                                'div' => false,
                                'checked' => ($checked) ? true:false,
                                'value' => 1
                            )) ?>
                    </td>
                    <?php endforeach; ?>
                </tr>  
                <?php endforeach; ?>
            <?php endif ?>
            <?php endforeach; ?>
        
        <?php else: ?>
        
        <?php endif ?>
    </tbody>
</table>

<div class="form-actions">
    <?php
    echo $this->Form->input("Mettre à jour", array(
        'type' => 'button',
        'div' => false,
        'label' => false,
        'class' => 'btn btn-primary'
    ))
    ?>
</div>
<?php echo $this->Form->end() ?>

<script>
   jQuery(function($) {
       $('tr .module').click(function() {
            var $t = $(this);
            var $tbody = $t.parents('tbody:first');
            var $groupeId = $t.attr('data-groupe-id');
        
            $tbody.find('.children_' + $t.attr('data-module-id')).each(function(i, el) {
                var $elm = $(el);
                
                if($t.is(':checked') && !$elm.find('input[type=checkbox].groupe_' + $groupeId).is(':checked'))
                {
                    $elm.find('input[type=checkbox].groupe_' + $groupeId).attr('checked', true);
                } else if(!$t.is(':checked') && $elm.find('input[type=checkbox].groupe_' + $groupeId).is(':checked')){
                    $elm.find('input[type=checkbox].groupe_' + $groupeId).attr('checked', false);
                }
                
            });
       });
   });
</script>