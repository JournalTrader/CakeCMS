(function($){
    $.fn.plupload = function(params)
    {
        var $data = null;
        
        return ($data !== null) ? $data:$data = new Plupload(this, params);
    }
    
    var Plupload = function(element, params)
    {
        this.$el = $(element);
        
        this.$params = $.extend({
            browserBtn : 'browser',
            url_upload : null,
            flash_swf_url : null,
            file_list: 'file-list'
        }, params);
        
        this.init();
    }
    
    Plupload.prototype = {
        $el: null,
        
        $dropZone: null,
        
        $params: null,
        
        $plup: null,
        
        $pluploader: null,
        
        $listMedia: null,    
        
        init: function()
        {
           $el = this.$el;
           $dropZone = this.$el;
           
           $plup = this;
           
           this.pluploder();
            
           return this;
        },
        
        pluploder: function() {
            $listMedia = $('#' + $plup.$params.file_list);
            
            $pluploader = new plupload.Uploader({
               runtimes : 'html5,flash',
               container: $el.attr('id'),
               drop_element: $el.attr('id'),
               browse_button: $plup.$params.browserBtn,
               url: $plup.$params.url_upload,
               flash_swf_url : $plup.$params.flash_swf_url,
               multipart: true,
               urlstream_upload: true//,
//               multipart_params: {
//                   directory: 'test'
//               }
            });
           
            $pluploader.init();
            
            $plup.dragOver();
            
            $plup.fileAdded();
            $plup.progressBar();
            $plup.fileUploaded();
        },
                
        fileAdded: function() {
            $pluploader.bind('FilesAdded', function(up, files) {
                if($listMedia.is(':hidden')) { $listMedia.fadeIn(); }
                
                for(var i in files)
                {
                    var $file = files[i];
//                    console.log(files)
                    var line = $plup.talbeLine($file);
                    
                    $listMedia.find('table tbody').append(line);
                }
                console.log($dropZone)
                
                $dropZone.removeClass('drag-hover');
                
                $pluploader.start();
                $pluploader.refresh();
            });
        },
        
        progressBar: function() {
            $pluploader.bind('UploadProgress', function(up, file) {
                $('#file_' + file.id).find('.progress .bar').css({
                    width: file.percent + '%'
                });
            });
        },
           
        fileUploaded: function() {
            $pluploader.bind('FileUploaded', function(up, file, response) {
                var $json = jQuery.parseJSON(response.response);
                var $elm = $('#file_' + file.id);
                
                $elm.removeAttr('id');
                $elm.attr('id', 'file_' + $json.Media.id);
                
                $elm.find('.file-name').html($json.Media.name);
                $elm.find('.type').html($json.Media.type);
                
                $elm.find('.edit-action').attr('href', $json.Media.edit_link);
                $elm.find('.dropdown-menu .delete-action').attr('href', $json.Media.delete_link);
                
                $elm.find('.preview .edit-action').html($json.Media.img);
                $elm.find('.time-helper').html($json.Media.time_ago);
                
                $plup.editMedia($elm);
                $plup.deleteMedia($elm);
                
                $dropZone.removeClass('drag-hover');
                
                $elm.find('.progress').fadeOut(3000, function() {
                    $(this).remove();
                });
            });
        },
           
        errorUpload: function() {
            $pluploader.bind('Error', function(up, error) {
                // créer un alert
                
                $dropZone.removeClass('drag-hover');
                $pluploader.refresh();
            });
        },
          
        editMedia: function(el) {
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
                    }
                });       
                
                return false;
            });
            
            return false;
        },        
          
        deleteMedia: function(el) {
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
            
            return false;
        },        
         
        talbeLine: function(file) {
            var $xhtml = '';
            
            $xhtml += '<tr id="file_' + file.id + '">';
            $xhtml += '<td><div class="btn-group">';
            $xhtml += '<a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">';
            $xhtml += '<span class="caret"></span>';
            $xhtml += '</a>';
            $xhtml += '<ul class="dropdown-menu">';
            $xhtml += '<li><a class="edit-action" href="#"><i class="icon-edit"></i> Modifier</a></li>';
            $xhtml += '<li><a class="delete-action" href="#" data-confirm-box="true" data-confirm-box-content="Voulez-vous supprimer la page ?" data-confirm-box-cancel="Annuler" data-confirm-box-action="Ok"><i class="icon-remove"></i> Supprimer</a></li>';
            $xhtml += '</ul>';
            $xhtml += '</div></td>';
            $xhtml += '<td class="preview" style="width: 90px;">';
            $xhtml += '<a class="edit-action" href="#"><img src="/media/img/picture-128-128.png" alt="Preview" class="img-rounded img-polaroid" width="80"></a>';
            $xhtml += '</td>';
            $xhtml += '<td>';
            $xhtml += '<strong><a href="#" class="edit-action file-name">' + file.name + '</a></strong>';
            $xhtml += '<ul>';
            $xhtml += '<li class="type">--</li>';
            $xhtml += '</ul>';
            $xhtml += '<div class="progress progress-success progress-striped active">';
            $xhtml += '<div class="bar" style="width: 1%"></div>';
            $xhtml += '</div>';
            $xhtml += '</td>';
            $xhtml += '<td class="time-helper">Il y un instant</td>';
            $xhtml += '</tr>';
            
            return $xhtml;
        },
        
        dragOver: function() {
            $el.bind({
                dragover: function(e) {
                    $(this).addClass('drag-hover');
                },
                dragleave: function(e) {
                    $(this).removeClass('drag-hover');
                }
            });
        }
    }
    
})(jQuery);