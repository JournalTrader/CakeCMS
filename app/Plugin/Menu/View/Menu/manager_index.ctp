<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Info !</strong> Permet lister l'enssemble des menus utilisés pour le site
</div>

<?php if(!empty($aMenus)): ?>
<?php echo $this->Form->create('Menu', array(
    'url' => array(
        'ajax' => true,
        'plugin' => 'menu',
        'controller' => 'menu',
        'action' => 'orderingUpdate'
    )
)) ?>
    <?php foreach($aMenus as $aMenu): ?>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th colspan="4"><?php echo $this->Html->link($aMenu['Block']['name'], array()) ?> <small><i>(<?php echo $aMenu['Block']['alias'] ?>)</i></small></th>
            </tr>
        </thead>
    </table>

    <div class="row-fluid">
        <?php if(!empty($aMenu['Menus'])): ?>
            <ul class="no-puce sortable-table">
            <?php foreach($aMenu['Menus'] as $menu): ?>
                <li>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="index">
                                <i class="icon-move"></i>
                                <?php echo $this->Form->input('.id', array(
                                    'type' => 'hidden',
                                    'value' => $menu['id']
                                )) ?>
                            </th>
                            <th colspan="2"><?php echo $menu['name'] ?></th>
                            <th class="index"><div class="btn-group">
                                <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array(
                                        'manager' => true,
                                        'plugin' => 'menu',
                                        'controller' => 'menu',
                                        'action' => 'add', 
                                        'id' => $menu['id']
                                    )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                                    <li><a href="<?php echo $this->Html->url(array(
                                        'manager' => true,
                                        'plugin' => 'menu',
                                        'controller' => 'menu',
                                        'action' => 'delete', 
                                        'id' => $menu['id']
                                    )) ?>" class="confirmModalBox" 
                                           data-box-title="Confirmation" 
                                           data-box-content="Voulez-vous supprimer ce module ?" 
                                           data-box-cancel="Annuler" data-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                                </ul>
                            </div></th>
                            <?php if(!empty($menu['ChildMenus'])): ?>
                                <tbody class="sortable-table">
                                <?php foreach($menu['ChildMenus'] as $aChildMenu): ?>
                                <tr class="ui-state-default">
                                    <td class="index">
                                        <i class="icon-move"></i>
                                        <?php echo $this->Form->input('.id', array(
                                            'type' => 'hidden',
                                            'value' => $aChildMenu['Menus']['id']
                                        )) ?>
                                    </td>
                                    <td class="index center">-</td>
                                    <td><?php echo $aChildMenu['Menus']['name'] ?></td>
                                    <td class="index"><div class="btn-group">
                                        <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo $this->Html->url(array(
                                                'manager' => true,
                                                'plugin' => 'menu',
                                                'controller' => 'menu',
                                                'action' => 'add', 
                                                'id' => $aChildMenu['Menus']['id']
                                            )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                                            <li><a href="<?php echo $this->Html->url(array(
                                                'manager' => true,
                                                'plugin' => 'menu',
                                                'controller' => 'menu',
                                                'action' => 'delete', 
                                                'id' => $aChildMenu['Menus']['id']
                                            )) ?>" class="confirmModalBox" 
                                                   data-box-title="Confirmation" 
                                                   data-box-content="Voulez-vous supprimer ce module ?" 
                                                   data-box-cancel="Annuler" data-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                                        </ul>
                                    </div></td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            <?php endif ?>
                        </tr>
                    </thead>
                    </table>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
    

    <div class="form-actions">
        <?php
        echo $this->Form->input("Ranger", array(
            'type' => 'button',
            'div' => false,
            'label' => false,
            'class' => 'btn btn-primary'
        ))
        ?>
    </div>
<?php echo $this->Form->end() ?>
<?php endif; ?>

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
