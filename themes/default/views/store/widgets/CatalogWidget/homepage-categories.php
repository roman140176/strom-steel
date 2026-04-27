<?php if ($category) : ?>
    <div class="hpc-grid">
        <?php foreach ($category as $data) : ?>
            <a href="<?= $data->getCategoryUrl() ?>" class="hpc-card">
                <div class="hpc-card__icon" aria-hidden="true">
                    <?php if (!empty($data->svg_code)) : ?>
                        <?= $data->svg_code ?>
                    <?php else : ?>
                        <?= CHtml::image($data->getImageUrl(80, 80, true, null, 'image'), CHtml::encode($data->name), ['loading' => 'lazy']) ?>
                    <?php endif ?>
                </div>
                <div class="hpc-card__title">
                    <?= CHtml::encode($data->name) ?>
                </div>
                <span class="hpc-card__arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </span>
            </a>
        <?php endforeach ?>
    </div>
<?php endif ?>
