(function($){
    $.fn.forms = function(params)
    {
        var $data = null;
        
        return ($data !== null) ? $data:$data = new Forms(this, params);
    }   

    var Forms = function(element, params)
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

    Forms.prototype = {  
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
        fieldsetOptions: function() {
            $el.each(function(i, el) {
                var $t = $(el);
                
                $t.bind('change', function() {
                    var $elm = $(this);
                    var $id = '#' + $elm.val();
                    
                    $('fieldset.options').hide();
                    
                    $($id).fadeIn();
                });
            });
        }
    }
})(jQuery);