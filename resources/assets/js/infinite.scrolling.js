$(function () {
    $('.articles').jscroll({
        contentSelector: '.articles',
        nextSelector: '.pagination li:last a',
        callback: function () {
            $('.pagination').hide();
            $('.rating').each(function () {
                if ($(this).next() && $(this).next().hasClass('br-widget')) {
                } else {
                    // init rating
                    $(this).barrating(barrating_options);
                }
            });
        }
    });

    $.ajaxSetup({
        error: function (xhr, textStatus, errorThrown) {
            if ($('.jscroll-loading').length) {
                $('.pagination:last').show();
                $('.jscroll-loading').remove();
            }
        }
    });
});
