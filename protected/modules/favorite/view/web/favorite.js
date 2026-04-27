/*добавление/удаление товаров в избранное*/
$(document).ready(function () {
    var svg_remove  = '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 51.997 51.997" style="enable-background:new 0 0 51.997 51.997;" xml:space="preserve"><g>    <path d="M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014C52.216,18.553,51.97,16.611,51.911,16.242z M49.521,21.261c-0.984,4.172-3.265,7.973-6.59,10.985L25.855,47.481L9.072,32.25c-3.331-3.018-5.611-6.818-6.596-10.99c-0.708-2.997-0.417-4.69-0.416-4.701l0.015-0.101C2.725,9.139,7.806,3.826,14.158,3.826c4.687,0,8.813,2.88,10.771,7.515l0.921,2.183l0.921-2.183c1.927-4.564,6.271-7.514,11.069-7.514c6.351,0,11.433,5.313,12.096,12.727C49.938,16.57,50.229,18.264,49.521,21.261z"/></g></svg>'
    var svg_add = '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="510px" height="510px" viewBox="0 0 510 510" style="enable-background:new 0 0 510 510;" xml:space="preserve"><g><g id="favorite"><path d="M255,489.6l-35.7-35.7C86.7,336.6,0,257.55,0,160.65C0,81.6,61.2,20.4,140.25,20.4c43.35,0,86.7,20.4,114.75,53.55C283.05,40.8,326.4,20.4,369.75,20.4C448.8,20.4,510,81.6,510,160.65c0,96.9-86.7,175.95-219.3,293.25L255,489.6z"  fill="#0e7e50";/></g></g></svg>'

    $(document).on('click', '.yupe-store-favorite-add', function (event) {
        event.preventDefault();
        var $this = $(this);
        var product = parseInt($this.data('id'));
        var data = {'id': product};
        data[yupeTokenName] = yupeToken;
        $.post(yupeStoreAddFavoriteUrl, data, function (data) {
            if (data.result) {
                $('.but-header__count').html(data.count).addClass('active');
                $('.but-favorite__icon__text').addClass('active')
                $this.removeClass('yupe-store-favorite-add')
                    .addClass('yupe-store-favorite-remove').addClass('text-error');
                $this.html(svg_add);
                if($(".but-favorite .toolbar-button").hasClass('no-active')){
                }
            }
            showNotify($this, data.result ? 'success' : 'danger', data.data);
        }, 'json');
    });

    $(document).on('click', '.yupe-store-favorite-remove', function (event) {
        event.preventDefault();
        var $this = $(this);
        var product = parseInt($this.data('id'));
        var data = {'id': product};
        data[yupeTokenName] = yupeToken;
        $.post(yupeStoreRemoveFavoriteUrl, data, function (data) {
            if (data.result) {
                $('.but-header__count').html(data.count);
                $this.removeClass('yupe-store-favorite-remove')
                    .removeClass('text-error').addClass('yupe-store-favorite-add');
                $this.html(svg_remove);
                if(data.count == 0){
                    $('.but-favorite__icon__text').removeClass('active');
                    $('.but-header__count').removeClass('active');
                }
            }
            showNotify($this, data.result ? 'success' : 'danger', data.data);
        }, 'json');
    });
   if($('.but-favorite__count').hasClass('active')){
        $('.but-favorite__icon__text').addClass('active')
    }else{
        $('.but-favorite__icon__text').removeClass('active');
    }
   $('.but-favorite__icon__text').on('click',function(){
    if($('.but-favorite__count').hasClass('active')){
        window.location.href='/favorite';
    }
   })
    $(document).on('click', '.favorite-delete', function (event) {
        event.preventDefault();
        var $this = $(this);
        var product = parseInt($this.data('id'));
        var data = {'id': product};
        data[yupeTokenName] = yupeToken;
        $('.ajax-loading').fadeIn(500);
        $.post(yupeStoreRemoveFavoriteUrl, data, function (data) {
            if (data.result) {
                $('.but-header__count').html(data.count);
                $this.parents('.tabs-hits__item').remove();
                if(data.count == 0){
                    $('.but-header__count').removeClass('active');
                    $(".list-view .favorite-box").html('<span class="empty">Нет результатов.</span>');
                }
            }
            $('.ajax-loading').delay(100).fadeOut(500);
        }, 'json');
    });

    $(document).on('click', '.yupe-product-favorite-add', function (event) {
        event.preventDefault();
        var $this = $(this);
        var product = parseInt($this.data('id'));
        var data = {'id': product};
        data[yupeTokenName] = yupeToken;
        $.post(yupeStoreAddFavoriteUrl, data, function (data) {
            if (data.result) {
                $('.but-header__count').html(data.count).addClass('active');
                $this.removeClass('yupe-product-favorite-add')
                    .addClass('yupe-product-favorite-remove').addClass('text-error');
                $this.html(svg_add);
            }
            showNotify($this, data.result ? 'success' : 'danger', data.data);
        }, 'json');
    });

    $(document).on('click', '.yupe-product-favorite-remove', function (event) {
        event.preventDefault();
        var $this = $(this);
        var product = parseInt($this.data('id'));
        var data = {'id': product};
        data[yupeTokenName] = yupeToken;
        $.post(yupeStoreRemoveFavoriteUrl, data, function (data) {
            if (data.result) {
                $('.but-header__count').html(data.count);
                $this.removeClass('yupe-product-favorite-remove')
                    .removeClass('text-error').addClass('yupe-product-favorite-add');
                $this.html(svg_remove);
                if(data.count == 0){
                    $('.but-header__count').removeClass('active');
                }
            }
            showNotify($this, data.result ? 'success' : 'danger', data.data);
        }, 'json');
    });
});