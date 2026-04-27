<?php if ($category) : ?>
    <div class="second-level-categories homepage-categories">
        <?php foreach ($category as $data) : ?>
            <a href="<?= $data->getCategoryUrl() ?>" class="csl__item">
                <?php if (!empty($data->svg_code)) : ?>
                    <div class="csl__svg" aria-hidden="true"><?= $data->svg_code ?></div>
                <?php else : ?>
                    <div class="csl__img">
                        <?= CHtml::image($data->getImageUrl(164, 125, true, null, 'image'), CHtml::encode($data->name), ['loading' => 'lazy']) ?>
                        <div class="csl__img_absolute">
                            <?= CHtml::image($data->getImageUrl(164, 125, true, null, 'thumbnale'), CHtml::encode($data->name), ['loading' => 'lazy']) ?>
                        </div>
                    </div>
                <?php endif ?>
                <div class="csl__name">
                    <?= CHtml::encode($data->name) ?>
                </div>
            </a>
        <?php endforeach ?>
    </div>
<?php endif ?>
