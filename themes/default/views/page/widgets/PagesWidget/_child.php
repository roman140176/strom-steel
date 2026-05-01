<a class="child-item" href="<?= Yii::app()->createUrl('/page/page/view', ['slug'=>$data->slug]) ?>">
    <div class="child-item_img">
        <img src="<?= $data->getImageUrl(0,0,true,null,'icon')?>" alt="<?= $data->title?>">
    </div>
    <div class="child-item__content_wrap">
        <div class="child-item_title">
             <?= $data->title_short ?>
        </div>
        <div class="child-item__short">
            <?= $data->short_content?>
        </div>
        <span class="child-item__detail">
            <span>Читать</span>
             <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </span>
    </div>
</a>
