<?php Yii::import('application.modules.news.NewsModule'); ?>
<?php if (isset($models) && $models != []): ?>
    <div class="nws-block">
        <div class="nws-block__head">
            <h2 class="nws-block__title">Новости</h2>
            <a href="/news" class="nws-block__all">
                <span>Все новости</span>
                <svg class="nws-block__all-arrow" width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                    <path d="M0.393585 4.0489L0.382658 4.04651L5.06674 4.04651L3.59424 5.52225C3.52213 5.5943 3.48258 5.69191 3.48258 5.79434C3.48258 5.89678 3.52213 5.9937 3.59424 6.06592L3.82336 6.29516C3.89541 6.36721 3.99141 6.40704 4.0938 6.40704C4.19624 6.40704 4.2923 6.36749 4.36435 6.29544L6.8885 3.77151C6.96084 3.69918 7.00039 3.60283 7.00011 3.50034C7.00039 3.39727 6.96084 3.30086 6.8885 3.22864L4.36435 0.704491C4.2923 0.632499 4.19629 0.592889 4.0938 0.592889C3.99141 0.632499 3.89541 0.632555 3.82336 0.704491L3.59424 0.933726C3.52213 1.00566 3.48258 1.10173 3.48258 1.20417C3.48258 1.30655 3.52213 1.39755 3.59424 1.46954L5.08336 2.95354L0.388349 2.95354C0.177381 2.95354 0.000104904 3.13537 0.000104904 3.34622V3.67044C0.000104904 3.8813 0.182617 4.0489 0.393585 4.0489Z" fill="currentColor"/>
                </svg>
            </a>
        </div>
        <div class="nws-grid">
            <?php foreach ($models as $model): ?>
                <?php
                $excerpt = trim(strip_tags((string)$model->short_text));
                if ($excerpt !== '' && function_exists('mb_strimwidth')) {
                    $excerpt = mb_strimwidth($excerpt, 0, 160, '…', 'UTF-8');
                }
                $rawDate = $model->date;
                $ts = strtotime($rawDate);
                $dateRus = $ts ? Yii::app()->dateFormatter->format('d LLLL', $ts) . ', ' . date('Y', $ts) : '';
                $url = '/news/' . $model->slug;
                ?>
                <article class="nws-card">
                    <a class="nws-card__media" href="<?= $url ?>" aria-label="<?= CHtml::encode($model->title) ?>">
                        <?= CHtml::image(
                            $model->getImageUrl(840, 500, true),
                            CHtml::encode($model->title),
                            ['loading' => 'lazy', 'decoding' => 'async', 'class' => 'nws-card__img', 'width' => 840, 'height' => 500]
                        ) ?>
                    </a>
                    <div class="nws-card__body">
                        <div class="nws-card__date">
                            <svg class="nws-card__date-ico" width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <rect x="3" y="5" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.6"/>
                                <path d="M3 9H21" stroke="currentColor" stroke-width="1.6"/>
                                <path d="M8 3V7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                                <path d="M16 3V7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                            </svg>
                            <span><?= $dateRus ?></span>
                        </div>
                        <h3 class="nws-card__title">
                            <a href="<?= $url ?>"><?= $model->title ?></a>
                        </h3>
                        <?php if ($excerpt !== ''): ?>
                            <p class="nws-card__text"><?= CHtml::encode($excerpt) ?></p>
                        <?php endif; ?>
                        <a class="nws-card__more" href="<?= $url ?>">
                            <span>Читать далее</span>
                            <svg width="16" height="12" viewBox="0 0 18 14" fill="none" aria-hidden="true">
                                <path d="M11 1L17 7L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17 7H1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
