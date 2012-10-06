(function($){
    $.fn.global = function(params)
    {
        var $data = null;
        
        return ($data != null) ? $data:$data = new Global(this, params);
    }
    
    var Global = function(element, params)
    {
        this.$el = $(element);
        
        this.$params = $.extend({}, params);
        
        this.init();
    }
    
    Global.prototype = {
        init: function()
        {
           $('a[data-confirm-box=true]').tools().confirmBox();
           $('a[data-form-ajax=true]').tools().ajaxFormBox();
           $('input[type=checkbox]#checkAll').tools().checkAll();
           
           return this;
        }
    }
})(jQuery);

jQuery(function($) {
    $('*').global();
});