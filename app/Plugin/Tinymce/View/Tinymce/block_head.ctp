<?php echo $this->Html->css('Tinymce.tiny_mce'); ?>
<?php echo $this->Html->script('Tinymce.tiny_mce/jquery.tinymce.js'); ?>
<?php echo $this->Html->script('Tinymce.custom.js'); ?>

<script type="text/javascript">
    jQuery(function($) {
        $('<?php echo $aSelector ?>').tinyEditor();
    });    
</script>
