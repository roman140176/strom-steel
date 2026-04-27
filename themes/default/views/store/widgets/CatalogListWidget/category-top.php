<?php if ($category) : ?>
        <?php foreach ($category as $key => $data) : ?>
                <a href="<?= $data->getCategoryUrl()?>" class="csl__item">
                    <div class="csl__img">
                        <?= CHtml::image($data->getImageUrl(164,125,true,null,'image')) ?>
                    </div>
                    <div class="csl__name">
                        <?= $data->name?>
                    </div>
                </a>
        <?php endforeach; ?>

<?php endif; ?>