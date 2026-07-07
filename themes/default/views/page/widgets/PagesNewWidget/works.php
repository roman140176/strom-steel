<?php
/**
 * Главная — секция «Реализованные объекты».
 * Виджет вызывается с parent_id=3, limit=4.
 *
 * @var Page[] $pages
 */

if (empty($pages)) {
    return;
}

$parent = $pages[0]->parentPage ?? null;
$allUrl = $parent ? Yii::app()->createUrl('/page/page/view', ['slug' => $parent->slug]) : '#';
$total  = count($pages);

$ssw_clean = static function ($html) {
    $text = preg_replace('#</(p|li|ul|ol|div)>#u', "$0 ", (string)$html);
    $text = strip_tags((string)$text);
    $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return trim(preg_replace('/\s+/u', ' ', $text));
};

// Данные у объектов неоднородные: previewtext может быть и «г. Москва»,
// и полным адресом; promo — и одной строкой типа продукции, и целым
// описанием поставки. Чтобы чипы оставались чипами — режем по словам.
$ssw_trim = static function ($text, $limit) {
    $text = (string)$text;
    if ($text === '' || mb_strlen($text, 'UTF-8') <= $limit) {
        return $text;
    }
    $cut = mb_substr($text, 0, $limit, 'UTF-8');
    $space = mb_strrpos($cut, ' ', 0, 'UTF-8');
    if ($space !== false && $space > $limit * 0.6) {
        $cut = mb_substr($cut, 0, $space, 'UTF-8');
    }
    return rtrim($cut, " ,.;:—-") . '…';
};

$ssw_promo_first = static function ($html) use ($ssw_clean) {
    $html = (string)$html;
    if ($html === '') {
        return '';
    }
    if (preg_match('#<li[^>]*>(.*?)</li>#siu', $html, $m)) {
        return $ssw_clean($m[1]);
    }
    return $ssw_clean($html);
};
?>
<section class="ssw-section" role="region" aria-label="Реализованные объекты"<?= $total === 1 ? ' data-ssw-single="1"' : '' ?>>
    <div class="container ssw-section__inner">
        <header class="ssw-head">
            <div class="ssw-head__title">
                <span class="ssw-eyebrow"><span class="ssw-eyebrow__line" aria-hidden="true"></span>Реализованные объекты</span>
                <h2 class="page_title ssw-head__h2">Наши объекты</h2>
            </div>
            <div class="ssw-head__meta">
                <a href="<?= CHtml::encode($allUrl) ?>" class="ssw-all">
                    <span>Все объекты</span>
                    <svg width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                        <path d="M0.393585 4.0489L0.382658 4.04651L5.06674 4.04651L3.59424 5.52225C3.52213 5.5943 3.48258 5.69191 3.48258 5.79434C3.48258 5.89678 3.52213 5.9937 3.59424 6.06592L3.82336 6.29516C3.89541 6.36721 3.99141 6.40704 4.0938 6.40704C4.19624 6.40704 4.2923 6.36749 4.36435 6.29544L6.8885 3.77151C6.96084 3.69918 7.00039 3.60283 7.00011 3.50034C7.00039 3.39727 6.96084 3.30086 6.8885 3.22864L4.36435 0.704491C4.2923 0.632499 4.19629 0.592889 4.0938 0.592889C3.99141 0.592889 3.89541 0.632499 3.82336 0.704491L3.59424 0.933726C3.52213 1.00566 3.48258 1.10173 3.48258 1.20417C3.48258 1.30655 3.52213 1.39755 3.59424 1.46954L5.08336 2.95354L0.388349 2.95354C0.177381 2.95354 0.000104904 3.13537 0.000104904 3.34622V3.67044C0.000104904 3.8813 0.182617 4.0489 0.393585 4.0489Z" fill="currentColor"/>
                    </svg>
                </a>
            </div>
        </header>

        <div class="ssw-carousel-wrap">
            <div class="swiper ssw-swiper" aria-roledescription="карусель">
                <div class="swiper-wrapper">
                    <?php foreach ($pages as $page): ?>
                        <?php
                            $title  = $page->under_title ?: $page->title_short;
                            $region = $ssw_trim($ssw_clean($page->previewtext), 36);
                            $promo  = $ssw_trim($ssw_promo_first($page->promo), 42);
                            $desc   = !empty($page->short_content)
                                ? $ssw_clean($page->short_content)
                                : $ssw_clean($page->year);
                            $url    = Yii::app()->createUrl('/page/page/view', ['slug' => $page->slug]);
                            $img    = $page->getImageUrl(720, 540, true, null, 'icon');
                        ?>
                        <article class="swiper-slide ssw-slide">
                            <a class="ssw-card" href="<?= CHtml::encode($url) ?>">
                                <div class="ssw-card__text">
                                    <?php if ($region !== '' || $promo !== ''): ?>
                                        <p class="ssw-card__chips">
                                            <?php if ($region !== ''): ?>
                                                <span class="ssw-chip"><?= CHtml::encode($region) ?></span>
                                            <?php endif; ?>
                                            <?php if ($region !== '' && $promo !== ''): ?>
                                                <span class="ssw-chip__sep" aria-hidden="true">·</span>
                                            <?php endif; ?>
                                            <?php if ($promo !== ''): ?>
                                                <span class="ssw-chip ssw-chip--accent"><?= CHtml::encode($promo) ?></span>
                                            <?php endif; ?>
                                        </p>
                                    <?php endif; ?>
                                    <h3 class="ssw-card__title"><?= $title ?></h3>
                                    <?php if ($desc !== ''): ?>
                                        <p class="ssw-card__desc"><?= CHtml::encode($desc) ?></p>
                                    <?php endif; ?>
                                    <span class="ssw-card__cta">
                                        Подробнее
                                        <svg width="18" height="14" viewBox="0 0 18 14" fill="none" aria-hidden="true">
                                            <path d="M11 1L17 7L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M17 7H1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                </div>
                                <div class="ssw-card__media">
                                    <img src="<?= CHtml::encode($img) ?>" alt="<?= CHtml::encode($title) ?>" loading="lazy" decoding="async">
                                    <span class="ssw-card__media-glow" aria-hidden="true"></span>
                                </div>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if ($total > 1): ?>
                <div class="ssw-controls">
                    <div class="ssw-progress" role="progressbar" aria-hidden="true">
                        <span class="ssw-progress__fill" data-ssw-progress></span>
                    </div>
                    <div class="ssw-nav-group">
                        <button type="button" class="ssw-nav ssw-nav--prev" aria-label="Предыдущий объект">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                <path d="M10 2L4 8L10 14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button type="button" class="ssw-nav ssw-nav--next" aria-label="Следующий объект">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                <path d="M6 2L12 8L6 14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
