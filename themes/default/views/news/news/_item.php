<div class="last-news__item">
    <a class="ln__item-img" href="/news/<?= $data->slug?>">
        <?= CHtml::image($data->getImageUrl(420,250,true), '', ['loading'=>'lazy']) ?>
    </a>
    <a class="ln__item-info in-view" href="/news/<?= $data->slug?>">
        <div class="news-date">
            <?= $data->newsDateRusFormat()?>
        </div>
        <div class="news-title">
            <?= $data->title_short?>
        </div>
    </a>
    <div class="empty"></div>
</div>