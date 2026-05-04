<?php
/**
 * @var Review[] $reviews
 */
?>
<section class="container reviews-carousel-section" aria-labelledby="reviews-carousel-title">
    <div class="reviews-carousel__head">
        <h2 id="reviews-carousel-title" class="page_title">Отзывы клиентов</h2>
        <a href="https://yandex.ru/maps/org/strom_treyd/1829653746/reviews/?indoorLevel=1&amp;ll=37.555319%2C55.741399&amp;z=17"
           class="all-objects reviews-carousel__more"
           target="_blank"
           rel="noopener noreferrer">
            Отзывы&nbsp;<span class="reviews-carousel__more-accent">Я</span>ндекс
            <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/or-arr.svg'); ?>
        </a>
    </div>

    <div class="swiper reviews-swiper">
        <div class="swiper-wrapper">
            <?php foreach ($reviews as $review): ?>
                <?php
                $rating = max(0, min(5, (int)$review->rating));
                $name = trim((string)$review->username);
                $fullText = trim((string)$review->text);
                $preview = trim((string)$review->preview_text);
                $hasPreview = $preview !== '';
                $cardText = $hasPreview ? $preview : $fullText;
                $cardId = 'review-' . (int)$review->id;
                $avatarUrl = !empty($review->image) ? $review->getImageUrl(120, 120) : null;
                $initial = $name !== '' ? mb_strtoupper(mb_substr($name, 0, 1, 'UTF-8'), 'UTF-8') : '';
                ?>
                <article class="swiper-slide reviews-card<?= $hasPreview ? ' reviews-card--has-more' : '' ?>">
                    <div class="reviews-card__rating" aria-label="Оценка: <?= $rating ?> из 5">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <svg class="reviews-card__star<?= $i <= $rating ? ' is-on' : '' ?>" width="18" height="18" viewBox="0 0 20 20" aria-hidden="true" focusable="false">
                                <path d="M10 1.5l2.6 5.27 5.82.85-4.21 4.1.99 5.78L10 14.77l-5.2 2.73.99-5.78L1.58 7.62l5.82-.85L10 1.5z" fill="currentColor"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <div class="reviews-card__text"><?= nl2br(CHtml::encode($cardText)) ?></div>
                    <?php if ($hasPreview): ?>
                        <button type="button" class="reviews-card__more" data-reviews-open="<?= $cardId ?>">
                            Читать полностью
                            <svg width="12" height="12" viewBox="0 0 7 7" fill="none" aria-hidden="true" focusable="false">
                                <path d="M0.39 4.05l-.01-.01h4.69L3.59 5.52a.4.4 0 0 0 0 .54l.23.24c.07.07.17.11.27.11.1 0 .2-.04.27-.11l2.52-2.52a.4.4 0 0 0 0-.54L4.36.7a.4.4 0 0 0-.54 0l-.23.23a.4.4 0 0 0 0 .54l1.49 1.48H.39a.39.39 0 0 0-.39.39v.32c0 .21.18.39.39.39z" fill="currentColor"/>
                            </svg>
                        </button>
                        <template data-reviews-content="<?= $cardId ?>">
                            <div class="reviews-modal__rating" aria-label="Оценка: <?= $rating ?> из 5">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <svg class="reviews-card__star<?= $i <= $rating ? ' is-on' : '' ?>" width="20" height="20" viewBox="0 0 20 20" aria-hidden="true" focusable="false">
                                        <path d="M10 1.5l2.6 5.27 5.82.85-4.21 4.1.99 5.78L10 14.77l-5.2 2.73.99-5.78L1.58 7.62l5.82-.85L10 1.5z" fill="currentColor"/>
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <div class="reviews-modal__text"><?= nl2br(CHtml::encode($fullText)) ?></div>
                            <?php if ($name !== '' || $avatarUrl): ?>
                                <div class="reviews-modal__person">
                                    <?php if ($avatarUrl): ?>
                                        <img class="reviews-modal__avatar" src="<?= $avatarUrl ?>" alt="<?= CHtml::encode($name) ?>" loading="lazy" decoding="async" width="56" height="56">
                                    <?php elseif ($initial !== ''): ?>
                                        <span class="reviews-modal__avatar reviews-card__avatar--initial" aria-hidden="true"><?= CHtml::encode($initial) ?></span>
                                    <?php endif; ?>
                                    <?php if ($name !== ''): ?>
                                        <span class="reviews-modal__author"><?= CHtml::encode($name) ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </template>
                    <?php endif; ?>
                    <?php if ($name !== '' || $avatarUrl): ?>
                        <div class="reviews-card__person">
                            <?php if ($avatarUrl): ?>
                                <img class="reviews-card__avatar" src="<?= $avatarUrl ?>" alt="<?= CHtml::encode($name) ?>" loading="lazy" decoding="async" width="40" height="40">
                            <?php elseif ($initial !== ''): ?>
                                <span class="reviews-card__avatar reviews-card__avatar--initial" aria-hidden="true"><?= CHtml::encode($initial) ?></span>
                            <?php endif; ?>
                            <?php if ($name !== ''): ?>
                                <span class="reviews-card__author"><?= CHtml::encode($name) ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="swiper-pagination reviews-swiper__pagination"></div>
        <button type="button" class="swiper-button-prev reviews-swiper__prev" aria-label="Предыдущий отзыв"></button>
        <button type="button" class="swiper-button-next reviews-swiper__next" aria-label="Следующий отзыв"></button>
    </div>

    <div class="reviews-modal" id="reviews-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="reviews-carousel-title">
        <div class="reviews-modal__overlay" data-reviews-close></div>
        <div class="reviews-modal__dialog" role="document">
            <button type="button" class="reviews-modal__close" data-reviews-close aria-label="Закрыть">&times;</button>
            <div class="reviews-modal__body"></div>
        </div>
    </div>
</section>
