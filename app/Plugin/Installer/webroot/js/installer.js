jQuery(function($) {
    $('#moduleForm').submit(function() {
        var $t = $(this);
        var $n = $t.find('#module-list>li').length;
        var $submit = $t.find('button[type=submit]');
        
        $submit.attr('disabled', true);
        
        $t.find('#module-list>li').each(function(i, el) {
            var $el = $(el);
            var $hidden = $el.find('input[type=hidden]');
            var $pathModule = $hidden.val();
            var $data = new Date();
            
            $.ajax({
                url: '/installer/installer/install_module/time:' + $data.getUTCMilliseconds(),
                type: 'POST',
                data: { path: $pathModule },
                cache: false,
                success: function(response) {
                    var $json = jQuery.parseJSON(response);
                    
                    if($json.error === 0)
                    {
                        $el.find('i').removeClass('icon-off').addClass('icon-ok');
                    } else {
                        $el.find('i').removeClass('icon-off').addClass('icon-remove');
                    }
                    
                    $n--;
                    
                    if(!$n)
                    {
                        $submit.html("Poursuivre l'installation");
                        
                        $submit.bind('click', function() {
                            window.location = $t.find('input#admin').val();
                        });
                        
                        $submit.attr('disabled', false);
                    }
                }
            });
        });
        
        return false;
    });
});