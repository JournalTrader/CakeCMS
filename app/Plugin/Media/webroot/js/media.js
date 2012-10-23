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
           
//           this.listMedia();
            
           return this;
        },
              
        listMedia: function() {
            $el.find('tbody tr').each(function(i, el) {
                var $t = $(this);
                
                $media.editMedia($t);
//                $media.deleteMedia($t);
            });
        },
            
        addMedia: function()
        {
            var $isValid = true;
            var $fileList = $('#file-list');
            
            $el.submit(function() {
                var $t = $(this);
                var $href = $t.attr('action');
                
                if(jQuery().forms)
                {
                    $isValid = $t.forms().valid();
                }
                
                if($isValid)
                {
                    var $data = $t.serialize();
                    
                    $.ajax({
                        url: $href,
                        type: 'POST',
                        data: $data,
                        success: function(response) {
                            var $data = jQuery.parseJSON(response);
                            if($fileList.is(':hidden')) { $fileList.fadeIn(); }
                            
                            var $line = $media.tableLine($data);
                            
                            $fileList.find('tbody').append($line);
                            
                            $media.editMedia($fileList.find('#file_' + $data.Media.id));
                            $media.deleteMedia($fileList.find('#file_' + $data.Media.id));
                        }
                    });
                }
                
                return false;
            });
        },
                
        editMedia: function(el)
        {
            el.find('.edit-action').click(function() {
                event.stopPropagation();
                
                $.ajax({
                    url: el.find('.edit-action').attr('href'),
                    type: 'GET',
                    success:function(response) {
                        var $modal = $('body').tools().modalBox("Modifier le média", response, "Inserer");
                        
                        $modal.find('.btn-action').click(function() {
                            var $data = $modal.find('form').serialize();
                            
                            $.ajax({
                                url: el.find('.edit-action').attr('href'),
                                type: 'POST',
                                data: $data,
                                success: function(response) {
                                    var $data = jQuery.parseJSON(response);
                                    
                                    el.find('.file-name').html($data.data.Media.name);
                                    
                                    if($data.data.Media.description !== '')
                                    {
                                        if(!el.find('.description').is('li'))
                                        {
                                            el.find('td>ul').append('<li class="description">' + $data.data.Media.description + '</li>');
                                        } else {
                                            el.find('.description').html($data.data.Media.description);
                                        }
                                    }
                                    
                                }
                            });
                        });
                        
                        $modal.find('img.video').click(function() {
                            var $t = $(this);
                            
                            $media.playMedia($t);
                        });
                        
                        console.log($modal.find('.modal-body'))
                        
                        $modal.css({
                            top: '35%'
                        });
                        
                        $modal.find('.modal-body').css({
                            maxHeight: '600px'
                        });
                    }
                });       
                
                return false;
            });
        },
                
        deleteMedia: function(el)
        {
            var $listMedia = $('#file-list');
            
            el.find('.delete-action').click(function() {
                event.stopPropagation();
                
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
        },
        
        playMedia: function(el)
        {
            var $elm = $(el);
            var $iId = $elm.attr('data-id');
            
            $.ajax({
                url: '/ajax/media/media/get_player/id:' + $iId,
                type: 'GET',
                success: function(response) {
                    var $response = $(response);
                    var $height = $elm.parents(':first').css('height');
                    
//                    $elm.parents(':first').css({
//                        minHeight: $height + 'px'
//                    });
                    
                    $elm.fadeOut(500, function() {
                        $elm.parents(':first').prepend(response);
                    });
                    
                    $elm.fadeOut();
                }
            });
        },
        
        tableLine: function(file) {
            var $xhtml = '';
            
            $xhtml += '<tr id="file_' + file.Media.id + '">';
            $xhtml += '<td><div class="btn-group">';
            $xhtml += '<a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">';
            $xhtml += '<span class="caret"></span>';
            $xhtml += '</a>';
            $xhtml += '<ul class="dropdown-menu">';
            $xhtml += '<li><a class="edit-action" href="' + file.Media.edit_link + '"><i class="icon-edit"></i> Modifier</a></li>';
            $xhtml += '<li><a class="delete-action" href="' + file.Media.delete_link + '" data-confirm-box="true" data-confirm-box-content="Voulez-vous supprimer la page ?" data-confirm-box-cancel="Annuler" data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>';
            $xhtml += '</ul>';
            $xhtml += '</div></td>';
            $xhtml += '<td class="preview" style="width: 90px;">';
            $xhtml += '<a class="edit-action" href="' + file.Media.edit_link + '"><img src="' + file.Media.src + '" alt="Preview" class="img-rounded img-polaroid" width="80"></a>';
            $xhtml += '</td>';
            $xhtml += '<td>';
            $xhtml += '<strong><a class="edit-action file-name" href="' + file.Media.edit_link + '">' + file.Media.name + '</a></strong>';
            $xhtml += '<ul>';
//            $xhtml += '<li class="type">' + file.Media.type + '</li>';
            $xhtml += (file.Media.type !== '') ? '<li class="type">' + file.Media.type + '</li>':'';
            $xhtml += '</ul>';
            $xhtml += '</td>';
            $xhtml += '<td class="time-helper">Il y un instant</td>';
            $xhtml += '</tr>';
            
            return $xhtml;
        }  
    }
    
})(jQuery);