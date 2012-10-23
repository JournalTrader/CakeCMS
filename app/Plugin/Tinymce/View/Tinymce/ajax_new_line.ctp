<tr id="newLine">
    <td><div class="btn-group">
        <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a id="save" href="<?php echo $this->Html->url(array(
                'manager' => false,
                'ajax' => true,
                'plugin' => 'tinymce',
                'controller' => 'tinymce',
                'action' => 'new_option'
            )) ?>"><i class="icon-edit"></i> Ajouter</a></li>
            <li><a id="delete" href="#"><i class="icon-remove"></i> Annuler</a></li>
        </ul>
    </div></td>
    <td><div class="control-group">
        #<?php
            echo $this->Form->input("Option.field", array(
                'label' => false,
                'div' => false,
                'value' => ""
            ))
            ?>
    </div></td>
    <td><div class="control-group">
        <?php
        echo $this->Form->input("Option.plugin", array(
            'label' => false,
            'div' => false,
            'options' => $aModules,
            'value' => ""
        ))
        ?>  
        <?php
        echo $this->Form->input('Option.order', array(
            'type' => 'hidden',
            'value' => (!empty($order)) ? $order:null
        ));
        ?>
    </div></td>
</tr>