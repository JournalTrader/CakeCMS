<?php echo $this->Form->create('Groupe', array(
    'url' => array(
        'ajax' => true,
        'plugin' => 'acl',
        'controller' => 'groupe',
        'action' => 'orderingUpdate'        
    )
)) ?>
<table class="table table-striped table-bordered table-hover table-condensed-table">
    <thead>
        <tr>
            <th class="index center"><i class="icon-move"></i></th>
            <th>Nom du groupe</th>
            <th class="index center">#</th>
        </tr>
    </thead>
    <tbody class="sortable-table">
        <?php if(!empty($aGroupes)): ?>
        <?php foreach($aGroupes as $aGroupe): ?>
        <tr>
            <td>
                <i class="icon-move"></i>
                <?php echo $this->Form->input('.id', array(
                    'type' => 'hidden',
                    'value' => $aGroupe['Groupe']['id']
                )) ?>
            </td>
            <td><?php echo $aGroupe['Groupe']['name'] ?></td>
            <td class="index center"><div class="btn-group">
                <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $this->Html->url(array(
                        'manager' => true,
                        'plugin' => 'acl',
                        'controller' => 'groupe',
                        'action' => 'add', 
                        'id' => 'gorupe_' . $aGroupe['Groupe']['id']
                    )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                    <li><a href="<?php echo $this->Html->url(array(
                        'manager' => true,
                        'plugin' => 'acl',
                        'controller' => 'groupe',
                        'action' => 'delete', 
                        'id' => 'groupe_' . $aGroupe['Groupe']['id']
                    )) ?>" data-confirm-box="true"
                           data-confirm-box-content="Voulez-vous supprimer la page ?" 
                           data-confirm-box-cancel="Annuler" 
                           data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                </ul>
            </div></td>

        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="3">
                <p class="help-block"><i class="icon-warning-sign"></i> <?php echo $this->Html->link("Créez un premier groupe !", array(
                    'manager' => true,
                    'plugin' => 'acl',
                    'controller' => 'groupe',
                    'action' => 'add'
                )) ?></p>
            </td>
        </tr>        
        <?php endif ?>
    </tbody>
</table>
<?php echo $this->Form->end() ?>
<script type="text/javascript">
    jQuery(function($) {
        $('ul.sortable-table,tbody.sortable-table').sortable({
            axis: 'y',
            handle: '.icon-move',
            helper: function(e, ui) {
                ui.children().each(function() {
                    $(this).width($(this).width());
                });
                
                return ui;
            },        
            stop: function(e, ui)
            {      
                var $action = $('form').attr('action');
                
                $.ajax({
                    url: $action,
                    type: 'POST',
                    data: $('form').serialize(),
                    success: function(response) {
                        var $response = jQuery.parseJSON(response);
        
                        $('div#container').tools().alert($response.message, $response.error);
                    }              
                });
            }
        });
    });

</script>