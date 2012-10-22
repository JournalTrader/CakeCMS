(function($){
    $.fn.tinyEditor = function(params)
    {
        var $data = null;
        
        return ($data !== null) ? $data:$data = new TinyEditor(this, params);
    }
    
    var TinyEditor = function(element, params)
    {
        this.$el = $(element);
        
        this.$params = $.extend({
            script_url: '/tinymce/js/tiny_mce/tiny_mce_src.js',
            content_css : '/css/bootstrap.css,/tinymce/css/editor.css'
            
        }, params);
        
        this.init();
    }
    
    TinyEditor.prototype = {
        $el: null,
        
        $params: null,
        
        $tiny: null,
        
        init: function()
        {
           $el = this.$el;
           $params = this.$params;
           $tiny = this;
           
           this.editor();
            
           return this;
        },
        
        editor: function()
        {
            $($el).tinymce({
                script_url : $params.script_url,
                relative_urls: false,
                extended_valid_elements: 'img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|data-*]',
                content_css: $params.content_css,
                execcommand_callback : $tiny.tinyCustomCommandHandler,
                theme: function(editor, target) {
                    var dom = tinymce.DOM, editorContainer;
                        
                    editorContainer = $(target).after('<div class="tools">' +
                    '<ul class="button-tools">' +
                    '<li class="dropdown">' +
                    '<a class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-font"></i> <span>Format text</span> <b class="caret"></b></a>' +
                    '<ul class="dropdown-menu">' +
                    '<li><a class="sub" data-mce-command="formatBlock" data-mce-value="h1" href="#">H1</a></li>' +
                    '<li><a class="sub" data-mce-command="formatBlock" data-mce-value="h2" href="#">H2</a></li>' +
                    '<li><a class="sub" data-mce-command="formatBlock" data-mce-value="h2"  href="#">H3</a></li>' +
                    '<li><a class="sub" data-mce-command="formatBlock" data-mce-value="h4"  href="#">H3</a></li>' +
                    '<li><a class="sub" data-mce-command="formatBlock" data-mce-value="h5"  href="#">H3</a></li>' +
                    '<li><a class="sub" data-mce-command="formatBlock" data-mce-value="p"  href="#">Paragraph</a></li>' +
                    '<li><a class="sub" data-mce-command="formatBlock" data-mce-value="address"  href="#">Address</a></li>' +
                    '<li><a class="sub" data-mce-command="formatBlock" data-mce-value="pre"  href="#">Preformatted</a></li>' +
                    '</ul>' +
                    '</li>' +
                    '<li class="btn-group">' +
                    '<button class="btn" data-mce-command="bold"><i class="icon-bold"></i></button>' +
                    '<button class="btn" data-mce-command="italic"><i class="icon-italic"></i></button>' +
                    '</li>' +
                    '<li class="btn-group">' +
                    '<button class="btn" data-mce-command="justifyleft"><i class="icon-align-left"></i></button>' +
                    '<button class="btn" data-mce-command="justifycenter"><i class="icon-align-center"></i></button>' +
                    '<button class="btn" data-mce-command="justifyright"><i class="icon-align-right"></i></button>' +
                    '<button class="btn" data-mce-command="justifyfull"><i class="icon-align-justify"></i></button>' +
                    '</li>' +
                    '<li class="btn-group">' +
                    '<button class="btn" data-mce-command="insertVideo"><i class="icon-film"></i></button>' +
                    '<button class="btn" data-mce-command="insertPicture"><i class="icon-picture"></i></button>' +
                    '</li>' +
                    '<li class="btn-group">' +
                    '<button class="btn" data-mce-command="insertLink"><i class="icon-share"></i></button>' +
                    '</li>' +
                    '</ul>' +
                    '<div class="clear"></div>' +
                    '<div class="iframe"></div>' +
                    '</div>').next();

                    $("button,a.sub", editorContainer).button().click(function(e) {
                        e.preventDefault();

                        // Execute editor command based on data parameters
                        editor.execCommand(
                            $(this).attr('data-mce-command'),
                            false,
                            $(this).attr('data-mce-value')
                        );

                        if($(this).is('a'))
                        {
                            var $dropdown = $(this).parents('.dropdown:first');

                            $dropdown.removeClass('open');
                        }

                        return false;

                    });

                    $('.iframe').css({
                        padding: '4px',
                        marginLeft: '0px'
                    });
                    
                    $('.iframe').addClass('span12');

                    editor.onInit.add(function() {
                        $("button", editorContainer).each(function(i, button) {
                            editor.formatter.formatChanged($(button).attr('data-mce-command'), function(state) {
                                if(state)
                                {
                                    $(button).addClass('format-activate');
                                } else {
                                    $(button).removeClass('format-activate');
                                }
                            });
                        });
                    });

                    // Return editor and iframe containers
                    return {
                        editorContainer: editorContainer[0],
                        iframeContainer: editorContainer.children().eq(-1),

                        // Calculate iframe height: target height - toolbar height
                        iframeHeight: $(target).height() - editorContainer.first().outerHeight()
                    };
                }
            });
        },
        
        tinyCustomCommandHandler: function(editor_id, elm, command, user_interface, value) {
            var $linkElm, $imageElm, $inst, $modal, $content;
            
            $inst = tinyMCE.getInstanceById(editor_id);
            
            switch (command)
            {
                case 'insertLink':
                    var $title = $slug = $url = $blank = $external = null;
                    var $anchor = $inst.selection.getContent();
                    
                    if($anchor === '' && $inst.selection.getNode().nodeName !== 'A') { return; }
                    
                    var $node = $($inst.selection.getNode());
                    
                    if($inst.selection.getNode().nodeName === 'A')
                    {
                        $title = ($node.attr('title') !== undefined) ? $node.attr('title'):null;
                        $blank = ($node.attr('target') !== undefined) ? $node.attr('target'):null;
                        $external = ($node.attr('rel') !== undefined) ? $node.attr('rel'):null;
                        $slug = $node.attr('href');
                        $anchor = $node.html();
                    }
                                        
                    $.ajax({
                        url: '/ajax/tinymce/tinymce/insert_link',
                        type: 'POST',
                        data: { anchor:$anchor },
                        success: function(response) {   
                            var $response = $(response);
                            
                            $response.find('#LinkTitle').val($title);
                            
                            if($blank !== null) { $response.find('#LinkBlank').attr('checked', true); }
                            if($external !== null) { $response.find('#LinkExternal').attr('checked', true); }
                            
                            $response.find('input[type=radio]').each(function(i, el) {
                                var $elm = $(this);
                                var $val = '{%' + $elm.val() + '%}';
                                
                                if($val === $slug)
                                {
                                    $response.find('#LinkSlug').val('/' + $.trim($elm.attr('data-slug')));
                                    $elm.attr('checked', true);
                                }
                            });
                            
                            $response.find('input[type=radio]').each(function(i, el) {
                                var $t = $(this);
                                
                                $t.click(function() {
                                    var $elm = $(this);
                                    $title = ($elm.attr('data-title') !== '') ? $.trim($elm.attr('data-title')):null;
                                    $slug = $.trim($elm.attr('data-slug'));
                                    $url = '{%' + $elm.val() + '%}';
                                    
                                    $response.find('#LinkSlug').val($slug);
                                    $response.find('#LinkTitle').val($title);
                                });
                                
                            });
                            
                            $modal = $self.modalBox("Ajouter un lien", $response, "Inserer");
                            
                            $modal.find('.btn-action').click(function() {
                                $blank = null;
                                $external = null;
                                
                                if($slug !== $.trim($response.find('input#LinkSlug').val())) { $url = '/' + $.trim($response.find('input#LinkSlug').val()); }
                                
                                $title = $response.find('#LinkTitle').val();
                                
                                if($response.find('input#LinkBlank').is(':checked'))
                                {
                                    $blank = '_blank';
                                }
                                
                                if($response.find('input#LinkExternal').is(':checked'))
                                {
                                    $external = 'nofollow external';
                                }
                                
//                                console.log($title);
//                                console.log($slug);
//                                console.log($page);
//                                console.log($blank);
//                                console.log($external);
                                var $link = $tiny.createLink($anchor, $url, $title, $blank, $external);
                                
                                if($inst.selection.getNode().nodeName === 'A')
                                {
                                    $node.attr('title', $title);
                                    $node.attr('target', $blank);
                                    $node.attr('rel', $external);
                                    $node.attr('href', $url);
                                } else {
                                    tinyMCE.execCommand('insertHTML', false, $link);
                                }
                            });
                        }
                    });
                    break; 
                case 'insertVideo':
                    $tiny.insertVideo($inst);
                    break;
                case 'insertPicture':
                    console.log($inst)
                    $tiny.insertPicture($inst);
                    break;
            }
        },
        
        createLink : function(anchor, href, title, target, rel) {
            var $a = null;
            
            $a = '<a href="' + href + '"' ;
            
            if(title !== null) { $a += ' title="' + $.trim(title) + '"'; }
            if(target !== null) { $a += ' target="' + $.trim(target) + '"'; }
            if(rel !== null) { $a += ' rel="' + $.trim(rel) + '"'; }            
            
            $a += '>' + anchor + '</a>';
            
            return $a;
        },
                
        insertPicture: function($timymce)
        {
            var $iId = null;
            var $thumbnail = null;
            var $src = null;
            var $category = null;
                    
            if($timymce.selection.getNode().nodeName === 'IMG')
            {
                var $node = $($timymce.selection.getNode());
                $iId = $node.attr('data-id');
                $thumbnail = $node.attr('src');
                $src = $node.attr('data-src');
                $category = $node.attr('data-category');
            }
            
            
            
            $.ajax({
                url: '/ajax/media/media/get_media/category:picture',
                type:'GET',
                success: function(response)
                {
                    var $modal = $self.modalBox("Ajouter une image", response, "Inserer");
                    
                    var $radios = $modal.find('table tbody input[type=radio]');
                    
                    $radios.each(function(i, el) {
                        var $t = $(el);
                        
                        if($iId !== null && $t.val() === $iId)
                        {
                            $t.attr('checked', true);
                        }
                        
                        $t.bind('click', function() {
                            var $elm = $(this);
                            
                            $iId = $elm.val();
                            $thumbnail = $elm.attr('data-thumbnail');
                            $src = $elm.attr('data-src');
                            $category = $elm.attr('data-category');
                        });
                    });
                    
                    $modal.find('.btn-action').click(function() {
                        var $alignOptions = $modal.find('#align-options input[type=radio]:checked').val();
//                        console.log($thumbnail, $src, $category, $iId, $alignOptions)
                        var $xhtml = '<span class="' + $alignOptions + '"><img src="' + $thumbnail + '" data-src="' + $src + '" data-category="' + $category + '" data-id="' + $iId + '" /></span>';
                        
                        tinyMCE.execCommand('insertHTML', false, $xhtml);
                    });
                }
            });
            
        },
                
        insertVideo: function()
        {
            $.ajax({
                url: '/ajax/media/media/get_media/category:video',
                type:'GET',
                success: function(response)
                {
                    var $modal = $self.modalBox("Ajouter une vidéo", response, "Inserer");
                    
                    
                }
            });
        }
    }
})(jQuery);