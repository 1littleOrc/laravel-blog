$(function () {
    $('.articles').jscroll({
        contentSelector: '.articles',
        nextSelector: '.pagination li:last a',
        callback: function () {
            $('.pagination').remove();
            $('.rating').each(function(){
                if($(this).next() && $(this).next().hasClass('br-widget')){}else{
                    // init rating
                    $(this).barrating(barrating_options);
                }
            });
        }
    });
});