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
        <?php if(!empty($aLists)): ?>
            <?php foreach($aLists as $alist): ?>
            <tr>
                <td><div class="btn-group">
                    <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->url(array(
                            'manager' => false,
                            'ajax' => true,
                            'plugin' => 'tinymce',
                            'controller' => 'tinymce',
                            'action' => 'edit',
                            'field' => $alist->field,
                            'plugins_id' => $alist->plugin
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
                    'class' => 'add-line'
                )) ?></p></td>
        </tr>
    </thead>
</table>
<?php echo $this->Form->end() ?>

<script type="text/javascript">
    jQuery(function($) {
        $('table').find('.add-line').click(function() {
            if($('table').find('#newLine').is('tr')) { return false; }
            $.ajax({
                url: '/ajax/tinymce/tinymce/new_line/',
                type: 'GET',
                success: function(response) {
                    var $el = $(response);
                    
                    $el.find('#delete').click(function() {
                        $el.fadeOut(function() {
                            $(this).remove();
                        });
                    });
                    
                    $el.find('#save').click(function() {
                        var $t = $(this);
                        var $href = $t.attr('href');
                        var $inputField = $el.find('#OptionField');
                        var $inputPlugin = $el.find('#OptionPlugin');
                        
                        if($inputField.val() === '') 
                        { 
                            $t.parents('.btn-group:first').removeClass('open');
                            
                            $inputField.parents('.control-group:first').addClass('error');
                        }
        
                        if($inputPlugin.val() === '0') 
                        { 
                            $t.parents('.btn-group:first').removeClass('open');
                            
                            $inputPlugin.parents('.control-group:first').addClass('error');
                        }
        
                        $.ajax({
                            url: $href,
                            type: 'POST',
                            data: $('form').serialize(),
                            success: function(response) {
                                var $json = jQuery.parseJSON(response);
                                
                                if($json.error !== 0)
                                {
                                    $('body').tools().alert($json.message, $json.error);
            
                                    return false;
                                }
        
                                $.ajax({
                                    url: '/ajax/tinymce/tinymce/add_line/',
                                    type: 'POST',
                                    data: {Data:response},
                                    success:function(response) {
                                        $el.fadeOut(500, function() {
                                            if(response !== '')
                                            {
                                                $('table').find('#end-table').before(response);
                                                
                                                $('div#container-alert').tools().alert($json.message, $json.error);
                                            }
                                        });
                                        
                                    }
                                });
        
                                $t.parents('.btn-group:first').removeClass('open');
                            }
                        });
                        
                        return false;
                    });
                    
                    $el.find('input, select').each(function(i, el) {
                        var $t = $(this);
                        
                        $(el).live('change', function() {
                            if($(this).parents('.control-group:first').has('.error'))
                            {
                                $(this).parents('.control-group:first').removeClass('error');
                            }
                        });
                    });
        
                    $('table').find('#end-table').before($el);
                    
                }
            });
            
            return false;
        });
    });
</script>