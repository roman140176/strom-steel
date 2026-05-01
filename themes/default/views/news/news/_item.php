<?php
$excerpt = trim(strip_tags((string)$data->short_text));
if ($excerpt !== '' && function_exists('mb_strimwidth')) {
    $excerpt = mb_strimwidth($excerpt, 0, 160, '…', 'UTF-8');
}
$ts = strtotime($data->date);
$dateRus = $ts ? Yii::app()->dateFormatter->format('d LLLL', $ts) . ', ' . date('Y', $ts) : '';
$url = '/news/' . $data->slug;
?>
<article class="nws-card">
    <a class="nws-card__media" href="<?= $url ?>" aria-label="<?= CHtml::encode($data->title) ?>">
        <?= CHtml::image(
            $data->getImageUrl(840, 500, true),
            CHtml::encode($data->title),
            ['loading' => 'lazy', 'class' => 'nws-card__img']
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
            <a href="<?= $url ?>"><?= $data->title_short ?: $data->title ?></a>
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
