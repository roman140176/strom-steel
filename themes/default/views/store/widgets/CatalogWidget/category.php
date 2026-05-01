<?php if($category): ?>
    <div class="tabs-links" id="tabs-div">
        <?php $n = 0; ?>
        <?php foreach ($category as $key => $data) : ?>
            <?php if ($data->getCountInHit()>0): ?>
            <?php $n++; ?>
                <div class="tabs-links_item" data-href="/tabstore/<?= $data->id; ?>">
                    <span>
                        <?= $data->name; ?>
                    </span>
                </div>
            <?php endif ?>
        <?php endforeach; ?>
        <?php if ($n > 5): ?>
            <div id="show-all">
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/cats.svg'); ?>
                <span>Все категории</span>
            </div>
        <?php endif ?>
    </div>
<?php endif; ?>
<?php if (count($category > 5)): ?>
    <?php Yii::app()->clientScript->registerScript("tabs", "
        $('.tabs-links_item').hide();
        $('.tabs-links_item').slice(0,4).show();
        $(document).delegate('#show-all','click',function(){
                var arr = $('.tabs-links_item:hidden').length;
                $(this).toggleClass('active');
                $('#tabs-div').toggleClass('active');
                if($(this).hasClass('active')){
                    $('.tabs-links_item').slice('-' + arr).show();
                    $(this).find('span').text('Свернуть');
                    }else{
                    $('.tabs-links_item').hide();
                    $('.tabs-links_item').slice(0,4).show();
                    $(this).find('span').text('Все категории');
                    }
            })
    "); ?>
<?php endif ?>