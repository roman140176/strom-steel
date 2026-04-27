<?php
$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
  Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/ion.rangeSlider/js/ion.rangeSlider.min.js', CClientScript::POS_END);
  Yii::app()->getClientScript()->registerCssFile($mainAssets . '/ion.rangeSlider/css/rangeSlider.min.css');
   ?>

<?php if ($category) : ?>
        <?php foreach ($category as $key => $data) : ?>

                <div class="category-list__item">
                    <div class="category-list__item-name">
                        <div class="cli-check">
                            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/wc.svg'); ?>
                        </div>
                        <?= $data->name?>
                    </div>
                    <div class="category-list__item-thumnale">
                        <div class="thumnale__box">
                            <?= CHtml::image($data->getImageUrl(0,0,true,null,'thumbnale')) ?>
                        </div>
                        <div class="lines_box">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                        <a href="collapse-<?= $data->id?>" class="accordion_link" data-url="<?= $data->getCategoryUrl()?>" role="button" data-toggle="collapse" aria-expanded="false">Подобрать</a>

                </div>
                <div class="collapse" id="collapse-<?= $data->id?>">

                </div>

        <?php endforeach; ?>

<?php endif; ?>

