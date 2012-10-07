(function($){
   $.fn.tools = function(params)
    {
        var $data = null;
        
        return ($data !== null) ? $data:$data = new Tools(this, params);
    }    

    var Tools = function(element, params)
    {
        this.$el = $(element);
        
        this.$params = $.extend({
            modalBox : {
                confirmBox: {
                    title : LANG.modalBox.confirmBox.title,
                    content : LANG.modalBox.confirmBox.content,
                    btnAction : LANG.modalBox.confirmBox.btnAction,
                    btnCancel : LANG.modalBox.confirmBox.btnCancel
                }
            }
        }, params);
        
        this.init();
    }

    Tools.prototype = {  
        $el: null,
        
        $params: null,
        
        $self: null,
        
        init: function()
        {            
            $el = this.$el;
            $params = this.$params;
            $self = this;
            
            return this;
        },
        confirmBox: function() {
            $el.each(function(i, el) {
                var $t = $(el);
                
                $t.bind('click', function() {
                    var $loc = $(this);
                    var $href = $loc.attr('href');
                    var $title = ($loc.attr('data-confirm-box-title') !== undefined) ? $loc.attr('data-confirm-box-title'):$params.modalBox.confirmBox.title;
                    var $content = ($loc.attr('data-confirm-box-content') !== undefined) ? $loc.attr('data-confirm-box-content'):$params.modalBox.confirmBox.content;
                    var $action = ($loc.attr('data-confirm-box-action') !== undefined) ? $loc.attr('data-confirm-box-action'):$params.modalBox.confirmBox.btnAction;
                    var $cancel = ($loc.attr('data-confirm-box-cancel') !== undefined) ? $loc.attr('data-confirm-box-cancel'):$params.modalBox.confirmBox.btnCancel;
                    var $query = ($loc.attr('data-confirm-box-query') !== undefined) ? $loc.attr('data-confirm-box-query'):null;
                    var $request = ($loc.attr('data-confirm-box-request') !== undefined) ? true:false;
                    
                    var $modal = $self.modalBox($title, $content, $action, $cancel);
                    
                    $modal.find('.btn-action').click(function() {
                        
                        if($query !== null && $request === true)
                        {
                            window.location = $href + '/?' + $query;
                        } else {
                            window.location = $href;
                        }
                        
                        return false;
                    });
                    
                    $modal.find('.btn-cancel').click(function() {
                        
                        if($request === true)
                        {
                            window.location = $href;
                        }
                    });
                    
                    return false;
                });
            });
            
            return false;
        },
        ajaxFormBox: function() {
            $el.each(function(i, el) {
               var $t = $(el);
               
               $t.bind('click', function() {
                   var $loc = $(this);
                   var $href = $loc.attr('href');
                   
                   $.ajax({
                       url: $href,
                       type: 'GET',
                       success: function(response) {
                          var  $modal = $self.modalBox('Test', response, 'OK');
                           
                           $modal.find('input[type=checkbox]#checkAll').tools().checkAll();
                           
                           $modal.find('.btn-action').click(function() {
                               var $form = $modal.find('form');
                               var $action = $form.attr('action');
                               var $serialize = $form.serialize();
                               
                               $.ajax({
                                   url: $action,
                                   data: $serialize,
                                   type: 'POST',
                                   success: function(reponse) {
                                       var $response = jQuery.parseJSON(reponse);
                                       
                                       $self.alert($response.message, $response.error, $('div#container'));
                                   }
                               });
                           });
                           
                           $('body').append($modal);
                       }
                   });
                   
                   return false;
               });
            });
        },
        checkAll: function()
        {
            $el.click(function() {
                var $t = $(this);
                
                $t.parents('table:first').find('input[type=checkbox]').each(function(i, el) {
                    var $elm = $(el);
                    
                    if(!$elm.is('#checkAll') && !$elm.is(':checked') && $el.is(':checked'))
                    {
                        $elm.attr('checked', true);
                    } else if(!$elm.is('#checkAll') && $elm.is(':checked') && !$el.is(':checked')) {
                        $elm.attr('checked', false);
                    }
                });
            });
        },
        modalBox: function(title, content, btnAction, btnCancel)
        {            
            var $modal = this.createModalBlox(title, content, btnAction, btnCancel);

            $('body').append($modal);

            $modal.modal('show');

            $modal.on('hidden', function() {
                $(this).remove();
            });
            
            return $modal;
        },
        createModalBlox: function(title, content, btnAction, btnCancel)
        {
            var $title = $('<h3>').text(title);
            var $btnClose = $('<button>').attr('type', 'button').addClass('close').attr('data-dismiss', 'modal').text('×');
            
            var $header = $('<div>').addClass('modal-header');
            $header.append($btnClose);
            $header.append($title);
            
            var $body = $('<div>').addClass('modal-body');
            $body.html(content);
            
            var $btnCancel = $('<a>').attr('href', '#').addClass('btn btn-cancel').attr('data-dismiss', 'modal').text(btnCancel);            
            var $btnAction = $('<a>').attr('href', '#').addClass('btn btn-primary btn-action').attr('data-dismiss', 'modal').text(btnAction);
            
            var $footer = $('<div>').addClass('modal-footer');     
            
            if(btnCancel !== null)
            {
                $footer.append($btnCancel);
            }
            
            $footer.append($btnAction);
            
            var $modal = $('<div>').addClass('modal hide fade in').attr('id', 'modal');
            
            $modal.append($header);
            $modal.append($body);
            $modal.append($footer);
            
            return $modal;
        },
        alert: function(message, error, elm, methode) {
            var $type = null;
            var $intro = null;
            var $anchor = $el;
            
            if(elm !== undefined) { $anchor = elm;  }
            
            switch(error)
            {
                case 3:
                    $type = 'error';
                    $intro = 'Erreur';
                    break;
                case 2:
                    $type = 'warning';
                    $intro = 'Attention';
                    break;
                case 1:
                    $type = 'info';
                    $intro = 'Info';
                    break;
                default:
                case 0:
                    $type = 'success';
                    $intro = 'Félicitation';
                    break;
            }
            
            if($type === null || $intro === null || message === undefined) { return false; }
            
            var $xhtml  = '<div id="alert-js" class="alert alert-' + $type + '">';
                $xhtml += '<button type="button" class="close" data-dismiss="alert">×</button>';
                $xhtml += '<strong>' + $intro + ' !</strong> ' + message;
                $xhtml += '</div>';
            
            if($('div#alert-js').is('div'))
            {
                $('div#alert-js').remove();
            }
            
            if(methode === undefined) { methode = 'prepend'; }
            
            switch(methode)
            {
                case 'append':
                    $anchor.append($xhtml);
                    break;
                case 'prepend':
                    $anchor.prepend($xhtml);
                    break;
                case 'after':
                    $anchor.after($xhtml);
                    break;
            }
        }
    }
})(jQuery);