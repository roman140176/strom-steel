    $(function(){
    /* Функция определения шаблона на вывод товаров */
    function getTemplateProduct() {
        var box = $('.template-product__item.active');
        if(box.data('view') == "_item-list"){
            $('.template-product__item').addClass('active');
            box.removeClass('active');
            setCookie("store_item", "_item", {'path' : '/'});
            setTimeout(filterUpdate(), 3000);
        }

    }

    $(document).delegate(".countItem-wrapper__link", "click", function(){
        setCookie("store_count", $(this).data("count"), {'path' : '/'});
        $('.countItem-wrapper__link').removeClass('active');
        $(this).addClass('active');
        filterUpdate();
        return false;
    });


    /* Вызываем функцию при загрузке сайта  */
    var innerWidth = window.innerWidth;

    if(innerWidth < 769){
        getTemplateProduct();
    }

    /* Клик, чтобы изменить шаблон вывода товаров */
    $(document).delegate(".template-product__item", "click", function(){
        setCookie("store_item", $(this).data("view"), {'path' : '/'});
        $('.template-product__item').removeClass('active');
        $(this).addClass('active');
        filterUpdate();
        return false;
    });


    /* Функция для обновления списка */
    function filterUpdate(event) {
        var form = $('#store-filter'),
            data = form.serialize(),
            action = form.attr('action');
        // window.history.pushState(null, document.title, action+'?'+data);

        filterListSelected();
        $('.catalog-content__sidebar').removeClass('fade-sidebar');
        $('.ajax-loading').fadeIn(500);
        if ($('.template-product__list').hasClass('active')) {
            $('.product-list').addClass('list-horisontal')
        }else{
            $('.product-list').removeClass('list-horisontal')
        }

          $.ajax({
            data: data,
            url: action,
            success:function(html) {
                $('#store-filter').html($(html).find('#store-filter').html());
                $('#product-box').html($(html).find('#product-box').html());
                $('.filter-div').slice(0,$('.filter-div').lenth).show();
                $('.filter-button-block').hide();
                                },
            complete: function() {
                rangeUpdate();
            }
        });
        $('.ajax-loading').delay(100).fadeOut(500);

        return false;
    };

    function rangeUpdate() {
        var $rangePrice = $('#js-range-price'),
            $fromPrice = $('.js-from-price'),
            $toPrice = $('.js-to-price'),
            my_range_Price,
            minPrice = $('#js-range-price').data('min'),
            maxPrice = $('#js-range-price').data('max'),
            fromPrice,
            toPrice;

        var updateValuesPrice = function () {
            $fromPrice.prop('value', fromPrice);
            $toPrice.prop('value', toPrice);
        };

        $rangePrice.ionRangeSlider({
            onStart: function (data) {
                fromPrice = data.from;
                toPrice = data.to;

                // updateValuesPrice();
            },
            onChange: function (data) {
                fromPrice = data.from;
                toPrice = data.to;

                updateValuesPrice();
            },
            onFinish: function (data) {
                fromPrice = data.from;
                toPrice = data.to;

                updateValuesPrice();
            }
        });

        my_range_Price = $rangePrice.data('ionRangeSlider');

        var updateRangePrice = function () {
            my_range_Price.update({
                from: fromPrice,
                to: toPrice
            });
        };
    }


    $(document).delegate('.sorter li', 'click', function(){
        var elem = $(this);
        // $('.product-filter').addClass('view-loading');
        $('.ajax-loading').fadeIn(500);
        var top = $('#product-box').offset().top - 200;
        $('body,html').animate({
            scrollTop: top + 'px'
        }, 400);
        $.fn.yiiListView.update('product-box', {
            url: elem.attr('data-href'),
            complete:function() {
                elem.addClass('active');
            }
        });
        $('.ajax-loading').delay(100).fadeOut(500);
        return false;
    });


    /***/
    $('.filter-div').slice(0,5).show();
        $(document).delegate('.load-link','click',function(e){
        e.preventDefault();
        console.log($('.filter-div:visible').length);
        if($('.filter-div:hidden').length <= 5){
            $('.filter-button-block').fadeOut(500);
        }else{
            $('.filter-button-block').show();
        }
        slices(500);
    });
    function slices(time){

        setTimeout(function(){
            $('.filter-div:hidden').slice(0,5).slideDown();
        },time)

        };


    /*
     *  Фильтры у товаров
    */
    /* Скрыть/показать блок фильтры */
    $(document).delegate('.filter-block__header', 'click', function(e){
        var parent = $(this).parents('.filter-block');
        var parentPrice = $(this).parents('.price-block');
        $(this).toggleClass('no-active');
        parent.find('.filter-block__body').toggle().toggleClass('no-active');
        parentPrice.find('.filter-block__body').toggle().toggleClass('no-active');

        return false;
    });


    /* Автоматическое обновление списка при изменении */
    $(document).delegate('#store-filter .filter-block input', 'change', function(e){
        filterUpdate();
        return false;
    });
    //**************************
  $(document).delegate('.accordion_link','click',function(e){
            var dataUrl = $(this).data('url'),
                collapsed = $(this).attr('href');
                $(this).toggleClass('active');
                if($(this).hasClass('active')){
                    $(this).text('Свернуть')
                }else{
                    $(this).text('Подобрать');
                }
                if($('#'+collapsed).hasClass('in')){
                    $('#'+collapsed).collapse('hide')
                }
            $.ajax({
                    url: dataUrl,
                    success: function(html) {
                        $('#'+collapsed).html(html);
                        $('#'+collapsed).collapse('show');
                        $('.filter-div').show();
                        $('.filter-button-block').hide();
                        rangeUpdate();

                    }
                })
        return false;

            });
//*****************************************


    /* Клик по постраничной навигации */
    $(document).delegate('#product-box .pagination li a', 'click', function(){
        $('.ajax-loading').fadeIn(500);
        var top = $('#product-box').offset().top - 50;
        $('body,html').animate({
            scrollTop: top + 'px'
        }, 400);
        $('.ajax-loading').delay(100).fadeOut(500);
    });

     $(document).delegate('.pagination-box-category .pagination li a', 'click', function(){
        $('.ajax-loading').fadeIn(500);
        $('.ajax-loading').delay(100).fadeOut(500);
    });


    /* Клик по кнопке применить фильтры */
    $(document).delegate('.but-filter', 'click', function(e){
        filterUpdate();
        var innerWidth = window.innerWidth;
        if(innerWidth <= 1240){
            $('body').removeClass('bodymenu');
            // $('html').removeClass('htmlmenu');
            $(".sidebar-box").removeClass('active');
            $("#store-filter").removeClass('active');
        }
        return false;
    })

    /* Кнопка сбросить убираем выделенные фильтры */
    $(document).delegate('.reset-filter, #reset-filter, button[type=reset]', 'click', function(e){
        var parent = $('#store-filter');
        var elem = parent.find('input:checked, option:selected, .range-input');
        var type;
        $.each(elem, function(i, e) {
            type = $(this).attr('type')
            if (type=='radio') {
                $(this).prop('checked', false);
            } else if(type=='checkbox') {
                $(this).prop('checked', false);
            } else if(type=='range-input') {
                $(this).find('input').val('');
                rangeUpdate();
            } else {
                $(this).prop("selected", false)
            }
        });

        parent.removeClass('selected');
        filterUpdate();

        var innerWidth = window.innerWidth;
        if(innerWidth <= 1240){
            $('body').removeClass('bodymenu');
            // $('html').removeClass('htmlmenu');
            $(".sidebar-box").removeClass('active');
            $("#store-filter").removeClass('active');
        }

        return false;
    });

    $(document).delegate('.but-menu-filter','click',function(e){
          e.preventDefault();
          $('.catalog-content__sidebar').toggleClass('fade-sidebar');
          })
   // Показать - при выборе фильтра - чекбокса
    $(document).delegate('#store-filter input[type="checkbox"]', 'change', function(e){
        console.log('изменилось');
        var blockItem = $(this).parent('.filter-block__item');
        var buttonApply = '<a href="#" class="apply but-filter">Применить</a>';
        var dc = $('#store-filter input[type="checkbox"]').parent('.filter-block__item');

        if(blockItem.children('.but-filter').hasClass('apply') && $(this).prop("checked") === false){
            dc.children(".apply").remove();
            // blockItem.children(".apply").remove();
        } else if ($(this).prop("checked") === true) {
            dc.children(".apply").remove();
            blockItem.append(buttonApply);
        } else {
            dc.children(".apply").remove();
            // blockItem.append(buttonApply);
        }
    });

    // Клик вне чекбокса - показать - при выборе фильтра
    $(document).mouseup(function(e){

        if (!$(e.target).hasClass('apply')){
            $('.apply').remove();
        }
    })

    /* Вывод выбранных фильтров в список */
    function filterListSelected(){
        var selectedFilters = $('.selected-filters');
        var storeFilter = $('#store-filter');
        var elem = storeFilter.find('input:checked, option:selected, .range-input');
        var elems = [];
        selectedFilters.html('');
        $.each(elem, function(i, e) {
            var el = $(e);
            var type = null;
            var label = null;

            if (e.tagName==='INPUT') {
                type = el.attr('type');
                if (type=='radio') {
                    label = el.parents('div.radio-button').find('>label').text();
                    label += ' '+el.next('label').text();
                } else if(type=='checkbox') {
                    label = el.next().text();
                } else if(type=='text') {
                    var value = el.val();
                    if (value) {
                        // label = el.prev('label').text();
                        label = el.parents('.filter-block').find('.filter-block__header span').text();
                        label += ' '+el.val();
                    }
                }
            } else if(el.hasClass('range-input')) {
                var par = el.parents('.price-block').find('.filter-block__header span');
                type = 'number';
                var value = '';
                el.find('input').each(function(){
                    if($(this).val()){
                        value += ' - '+$(this).val();
                    }
                });
                if(value){
                    label = par.data('title');
                    label += ' '+value+' '+par.data('unit');
                }
            } else {
                type = 'select';
                label = el.text();
            }
            if (label && type) {
                elems.push({
                    el: el,
                    type: type,
                    label: label,
                });
            }
        });
        if(elems.length > 0){
            selectedFilters.append("<strong>Ваш выбор: </strong>");
        }

        $.each(elems, function(i, e) {
            var span = $('<span data-id=#'+e.el.attr("id")+' class="label label-default"></span>');
            span
                .text(e.label);

            selectedFilters.append(span);
        });
        if(elems.length > 0){
            selectedFilters.append('<span class="reset-filter">Очистить все</span>').addClass('active');
        } else{
            selectedFilters.removeClass('active');
        }

    }

    /* Удаление фильтров из списка примененных */
    $(document).delegate('.selected-filters .label', 'click', function(e){
        var id = $(this).attr('data-id');
        var type = $(id).attr('type');

        if (type=='radio') {
            $(id).prop('checked', false);
        } else if(type=='checkbox') {
            $(id).click();
        } else if(type=='range-input') {
            $(id).find('input').val('');
            var update = $(id).data('update');
            var slider = $(update).data("ionRangeSlider");
            slider.update({
                from: 0,
                to: $(update).data('max')
            });
            // rangeInputUpdate();
        } else {
            $(id).prop("selected", false)
        }

        filterUpdate();

        return false;
    });


    /**DDDDDDDDDDDDDDDDD*/
    //     function ChangeUrl(page, url) {
    //     var obj = {Page: page, Url: url};
    //     history.pushState(obj, obj.Page, obj.Url);
    // }

    // /* Функция для перехода на нужную категорию */
    // function filterCategoryUpdate() {
    //     var form = $('.preview-box-form'),
    //     data = form.serialize();
    //     $.ajax ({
    //         'data': data,
    //         'url': '',
    //         succes:function(html) {
    //             $('#swup').html($(html).find('swup').html());
    //             var page = window.location['href'],
    //                 url = form.find('input[type=checkbox]:checked').attr('data-url');
    //                     cosole.log(data);
    //                 //console.log(page);
    //             ChangeUrl(page, url);
    //         }
    //     });

    //     return false;
    // };

    // $(document).delegate('.preview-box-form input[type=checkbox]', 'change', function(e){

    //     $('.preview-box-form input[type=checkbox]').prop('checked', false);
    //     $(this).prop('checked', true);

    //     filterCategoryUpdate();
    // });

    /**FFFFFFFFFFFFFFFFF*/

    /* Кнопка (Показать еще) в фильтрах*/
    $(document).delegate('.filter-block__more', 'click', function(e){
        var parent = $(this).parents(".filter-block");
        var span = $(this).find("span");
        var text = span.data('text');
        if($(this).hasClass('active')){
            $(this).removeClass('active')
            parent.find(".filter-list.hidden-2").removeClass("hidden-2").addClass("hidden");
            parent.find('.filter-block__list').removeClass("active");
            span.data('text', span.text());
            span.text(text);

        } else {
            $(this).addClass('active')
            parent.find(".filter-list.hidden").removeClass("hidden").addClass("hidden-2");
            parent.find('.filter-block__list').addClass("active");
            span.data('text', span.text());
            span.text(text);
        }
        return false;
    });

    /* Функция для обновления sliderRange */
    function rangeInputUpdate(){
        $(".js-range").each(function(){
            var slider = $('#'+$(this).attr('id')).data("ionRangeSlider");
            $(slider).update({
                from: 0,
                to: $(this).data('max')
            });
        });
    }
});
    // возвращает cookie с именем name, если есть, если нет, то undefined
function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options) {

    options = options || {};

    var expires = options.expires;

    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value;

    for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }

    document.cookie = updatedCookie;
}
