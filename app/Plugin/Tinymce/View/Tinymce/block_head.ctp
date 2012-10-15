<?php echo $this->Html->script('Tinymce.tiny_mce/jquery.tinymce.js'); ?>

<script type="text/javascript">
    jQuery(function($) {
        $('textarea').tinymce({
            script_url : '/tinymce/js/tiny_mce/tiny_mce_src.js'
        });
    });
</script>