(function($){
   $.fn.tools = function(params)
    {
        var $data = null;
        
        return ($data != null) ? $data:$data = new Tools(this, params);
    }    

    var Tools = function(element, params)
    {
        this.$el = $(element);
        
        this.$params = $.extend({
            
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
                                       
                                   }
                               })
                               
                               return false;
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
            
            if(btnCancel != null)
            {
                $footer.append($btnCancel);
            }
            
            $footer.append($btnAction);
            
            var $modal = $('<div>').addClass('modal hide fade in').attr('id', 'modal');
            
            $modal.append($header);
            $modal.append($body);
            $modal.append($footer);
            
            return $modal;
        }
    }
})(jQuery);