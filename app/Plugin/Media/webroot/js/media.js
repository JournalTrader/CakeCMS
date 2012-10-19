(function($){
    $.fn.media = function(params)
    {
        var $data = null;
        
        return ($data !== null) ? $data:$data = new Media(this, params);
    }
    
    var Media = function(element, params)
    {
        this.$el = $(element);
        
        this.$params = $.extend({ }, params);
        
        this.init();
    }
    
    Media.prototype = {
        $el: null,
        
        $params: null,
        
        $media: null,
        
        init: function()
        {
           $el = this.$el;
           $media = this;
           
           this.listMedia();
            
           return this;
        },
              
        listMedia: function() {
            $el.find('tbody tr').each(function(i, el) {
                var $t = $(this);
                
                $media.editMedia($t);
//                $media.deleteMedia($t);
            });
        },
               
        editMedia: function(el)
        {
            el.find('.edit-action').click(function() {
                $.ajax({
                    url: el.find('.edit-action').attr('href'),
                    type: 'GET',
                    success:function(response) {
                        var $modal = $('body').tools().modalBox("Ajouter un lien", response, "Inserer");
                        
                        $modal.find('.btn-action').click(function() {
                            var $data = $modal.find('form').serialize();
                            
                            $.ajax({
                                url: el.find('.edit-action').attr('href'),
                                type: 'POST',
                                data: $data,
                                success: function(response) {
                                    var $data = jQuery.parseJSON(response);
                                    
                                    el.find('.file-name').html($data.data.Media.name);
                                    
                                    if(!el.find('.description').is('li'))
                                    {
                                        el.find('td>ul').append('<li class="description">' + $data.data.Media.description + '</li>');
                                    } else {
                                        el.find('.description').html($data.data.Media.description);
                                    }
                                    
                                }
                            });
                        });
                    }
                });       
                
                return false;
            });
        },
                
        deleteMedia: function(el)
        {
            el.find('.delete-action').click(function() {
                $.ajax({
                    url: el.find('.delete-action').attr('href'),
                    type: 'GET',
                    success: function(response) {
                        var $json = jQuery.parseJSON(response);

                        if($json.error === 0)
                        {
                            if(el.parents('tbody:first').find('tr').length === 1)
                            {
                                $listMedia.fadeOut();
                            }
                    
                            el.fadeOut(function() {
                                $(this).remove();
                            });
                        }
                    }
                });  
                
                return false;
            });  
        }   
    }
    
})(jQuery);