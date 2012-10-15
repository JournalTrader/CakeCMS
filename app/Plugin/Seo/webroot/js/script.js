jQuery(function($) {
    var $titleInput = $('form').find('input#title');
    var $inputSlug = $('input#SeoSlug');
    
    if(jQuery().tools)
    {
        var $slug = $titleInput.tools().getSlug();

        if ($inputSlug.val() === '') { $inputSlug.val($slug); }

        $titleInput.keyup(function() {
            var $t = $(this);
            var $val = $t.val();

            $slug = $t.tools().getSlug();

            $inputSlug.val($slug);
        });        
    }
    

});
