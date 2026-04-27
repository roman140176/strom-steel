<a class="article-item" href="<?= $data->getCategoryUrl()?>">
    <div class="article-item_img">
        <img src="<?= $data->getImageUrl(0,0,true,null,'image')?>" alt="<?= $data->title?>">
    </div>
    <div class="article-item__content_wrap">
        <div class="article-item_title">
             <?= $data->title ?>
        </div>
        <span class="article-item__detail">
            <span>Подробнее</span>
             <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </span>
    </div>
</a>