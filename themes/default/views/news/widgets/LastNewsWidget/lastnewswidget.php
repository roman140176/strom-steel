<?php Yii::import('application.modules.news.NewsModule'); ?>
<?php if (isset($models) && $models != []): ?>
    <div class="ob__i-head">
          <h2 class="page_title">
             Новости
          </h2>
          <a href="/news" class="all-objects">
                Все новости
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/or-arr.svg'); ?>
          </a>
    </div>
    <div class="last-news">
        <?php foreach ($models as $model): ?>
            <div class="last-news__item">
                <a class="ln__item-img" href="/news/<?= $model->slug?>">
                    <?= CHtml::image($model->getImageUrl(420,250,true), '', ['loading'=>'lazy']) ?>
                </a>
                <a class="ln__item-info" href="/news/<?= $model->slug?>">
                    <div class="news-date">
                        <?= $model->newsDateRusFormat()?>
                    </div>
                    <div class="news-title">
                        <?= $model->title_short?>
                    </div>
                </a>
                <div class="empty"></div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


