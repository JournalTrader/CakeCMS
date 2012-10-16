<tr>
    <td><div class="btn-group">
        <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="ajax-tr" href="<?php echo $this->Html->url(array(
                'manager' => false,
                'ajax' => true,
                'plugin' => 'tinymce',
                'controller' => 'tinymce',
                'action' => 'edit',
                'field' => $aData->field,
                'plugins_id' => $aData->plugin,
                'order' => $aCount
            )) ?>"><i class="icon-edit"></i> Modifier</a></li>
            <li><a href="<?php echo $this->Html->url(array(
                'manager' => true,
                'plugin' => 'tinymce',
                'controller' => 'tinymce',
                'action' => 'delete',
                'id' => $aData->field . $aData->plugin
            )) ?>" data-confirm-box="true"
                   data-confirm-box-content="Voulez-vous supprimer le champ ?" 
                   data-confirm-box-cancel="Annuler" 
                   data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
        </ul>
    </div></td>
    <td>
        #<?php echo $aData->field ?>
    </td>
    <td><?php echo $aData->Plugin['Plugin']['name'] ?></td>
</tr>