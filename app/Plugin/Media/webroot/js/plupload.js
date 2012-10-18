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
        
        $params: null,
        
        $plup: null,
        
        $pluploader: null,
        
        $listMedia: null,    
        
        init: function()
        {
           $el = this.$el;
           $plup = this;
           
           this.pluploder();
            
           return this;
        },
        
        pluploder: function() {
            $listMedia = $('#' + $plup.$params.file_list);
            
            $pluploader = new plupload.Uploader({
               runtimes : 'html5,flash',
               container: $el.attr('id'),
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
                
                $el.removeClass('drag-hover');
                
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
                $elm.find('.delete-action').attr('href', $json.Media.delete_link);
                
                $elm.find('.edit-action').click($plup.editMedia());
                $plup.deleteMedia($elm);
                
                $elm.find('.progress').fadeOut(3000, function() {
                    $(this).remove();
                });
            });
        },
           
        errorUpload: function() {
            $pluploader.bind('Error', function(up, error) {
                // créer un alert
                
                $el.removeClass('drag-hover');
                $pluploader.refresh();
            });
        },
          
        editMedia: function() {
            
            
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
            $xhtml += '<td style="width: 90px;">';
            $xhtml += '<a href="/manager/media/media/add/type:picture/id:1"><img src="http://placehold.it/140x140" alt="Preview" class="img-rounded img-polaroid" width="80"></a>';
            $xhtml += '</td>';
            $xhtml += '<td>';
            $xhtml += '<strong><a href="/manager/media/media/add/type:picture/id:1" class="file-name">' + file.name + '</a></strong>';
            $xhtml += '<ul>';
            $xhtml += '<li class="type">--</li>';
            // $xhtml += '<li>Description de l\'image avec pas plus de 250 caractères.</li>';
            $xhtml += '</ul>';
            $xhtml += '<div class="progress progress-success progress-striped active">';
            $xhtml += '<div class="bar" style="width: 1%"></div>';
            $xhtml += '</div>';
            $xhtml += '</td>';
            $xhtml += '<td>Il y 3 heures</td>';
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