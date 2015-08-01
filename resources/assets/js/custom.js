$(function () {
    $('.rating').barrating({
            theme: 'css-stars',
            onSelect: function (value, text) {
                var select = $(this).parent().prev();
                var article = select.attr('name').split('_')[1];
                if (value == '') {
                    value = select.find('option[selected]').attr('value');
                }
                $.post('/vote.ajax', {article: article, value: value}, function (value) {
                    select.barrating('set', value);
                    select.parent().prev().text('Спасибо, рейтинг обновлен с учетом Вашего голоса.');
                });
            }
        }
    );
});