<?php echo $this->Form->create('Option', array(
    'class' => 'form-horizontal'
)) ?>
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th class="index center">#</th>
            <th>Champ</th>
            <th>Plugin</th>
        </tr>
    </thead>
    <thead>
        <?php // debug($aLists); ?>
        <?php $i = 0; if(!empty($aLists)): ?>
            <?php foreach($aLists as $alist): ?>
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
                            'field' => $alist->field,
                            'plugins_id' => $alist->plugin,
                            'order' => ($i++) + 1
                        )) ?>"><i class="icon-edit"></i> Modifier</a></li>
                        <li><a href="<?php echo $this->Html->url(array(
                            'manager' => true,
                            'plugin' => 'tinymce',
                            'controller' => 'tinymce',
                            'action' => 'delete',
                            'id' => $alist->field . $alist->plugin
                        )) ?>" data-confirm-box="true"
                               data-confirm-box-content="Voulez-vous supprimer le champ ?" 
                               data-confirm-box-cancel="Annuler" 
                               data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>
                    </ul>
                </div></td>
                <td>
                    #<?php echo $alist->field ?>
                </td>
                <td><?php echo $alist->Plugin['Plugin']['name'] ?></td>
            </tr>
            <?php endforeach; ?>
        
        <?php endif ?>
        <tr id="end-table">
            <td colspan="3"><p class="help-block"><i class="icon-plus"></i> <?php echo $this->Html->link("Ajouter un éditeur", array(
                    'manager' => true,
                    'plugin' => 'blog',
                    'controller' => 'article',
                    'action' => 'add'
                ), array(
                    'class' => 'add-line',
                    'id' => 'order_' . $maxCount
                )) ?></p></td>
        </tr>
    </thead>
</table>
<?php echo $this->Form->end() ?>

<script type="text/javascript">
    jQuery(function($) {
        $('table').find('.ajax-tr').live('click', function() {
            var $t = $(this);
            var $href = $t.attr('href');
            var $tr = $t.parents('tr:first');
            
            $t.parents('.btn-group:first').removeClass('open');
        
            $.ajax({
                url: $href,
                type: 'GET',
                success: function(response) {                    
                    $tr.fadeOut(function() {
                        $tr.after(response);
                        $(this).remove();
                    });
                }
            });
        
            return false;
        });
        
        $('table').find('.add-line').click(function() {
            if($('table').find('#newLine').is('tr')) { return false; }
            var $id = $(this).attr('id');
            var $order = $id.split('_');
            $order = $order[1];
            
            $.ajax({
                url: '/ajax/tinymce/tinymce/new_line/order:' + $order,
                type: 'GET',
                success: function(response) {
                    var $el = $(response);
                    
                    $('table').find('#end-table').before($el);
                }
            });
            
            return false;
        });
        
        $('table').find('#delete').click(function() {
            $(this).parents('tr:first').fadeOut(function() {
                $(this).remove();
            });

            return false;
        });

        $('table').find('#save').live('click', function() {        
            var $error = false;
            var $t = $(this);
            var $tr = $t.parents('tr:first');
            var $href = $t.attr('href');
            var $inputField = $tr.find('#OptionField');
            var $inputPlugin = $tr.find('#OptionPlugin');
            var $inputOrder = $tr.find('#OptionOrder');

            if($inputField.val() === '') 
            { 
                $t.parents('.btn-group:first').removeClass('open');

                $inputField.parents('.control-group:first').addClass('error');

                $error = true;
            }

            if($inputPlugin.val() === '0') 
            { 
                $t.parents('.btn-group:first').removeClass('open');

                $inputPlugin.parents('.control-group:first').addClass('error');

                $error = true;
            }

            if($error) { return false; }
            
            $.ajax({
                url: $href,
                type: 'POST',
                data: $('form').serialize(),
                success: function(response) {
                    var $json = jQuery.parseJSON(response);

                    if($json !== null)
                    {
                        if($json.error !== 0)
                        {
                            $('div#container-alert .row-fluid:first').tools().alert($json.message, $json.error);

                            return false;
                        }
                    }
                    
                    $.ajax({
                        url: '/ajax/tinymce/tinymce/add_line/',
                        type: 'POST',
                        data: {Data:response},
                        success:function(response) {
                            $tr.fadeOut(500, function() {
                                if(response !== '')
                                {
                                    $('table').find('#end-table').before(response);

                                    $('div#container-alert .row-fluid:first').tools().alert($json.message, $json.error);
                                }
                            });

                        }
                    });

                    $t.parents('.btn-group:first').removeClass('open');
                }
            });

            return false;
        });

        $('form').find('input, select').each(function(i, el) {
            var $t = $(this);

            $(el).live('change', function() {
                if($(this).parents('.control-group:first').has('.error'))
                {
                    $(this).parents('.control-group:first').removeClass('error');
                }
            });
        });
    });
</script>