<a class="article-item" href="<?= Yii::app()->createUrl('/page/page/view', ['slug'=>$data->slug]) ?>">
    <div class="article-item_img">
        <img src="<?= $data->getImageUrl(0,0,true,null,'icon')?>" alt="<?= $data->title?>">
    </div>
    <div class="article-item__content_wrap">
        <div class="article-item_title">
             <?= $data->title_short ?>
        </div>
        <span class="article-item__detail">
            <span>Подробнее</span>
             <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </span>
    </div>
</a>
