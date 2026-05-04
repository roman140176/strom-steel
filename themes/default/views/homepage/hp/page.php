<?php

/** @var Page $page */
if ($page->layout) {
    $this->layout = "//layouts/{$page->layout}";
}
$this->title = $page->title;
$this->description = !empty($page->meta_description) ? $page->meta_description : Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = !empty($page->meta_keywords) ? $page->meta_keywords : Yii::app()->getModule('yupe')->siteKeyWords;
$this->main_page = true;
$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
?>
<main>
    <h1 class="sr-only">Металлоконструкции: бордюры, решётчатые настилы, водоотводы</h1>
    <div class="container sliders-container">
        <div class="swiper home-banner-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide home-banner-slide">
                    <picture>
                        <source type="image/avif" media="(min-width: 768px)" srcset="<?= $mainAssets ?>/images/page/curbs/curbs.avif">
                        <source type="image/avif" media="(max-width: 767px)" srcset="<?= $mainAssets ?>/images/page/curbs/curbs-mob.avif">
                        <source media="(min-width: 768px)" srcset="<?= $mainAssets ?>/images/page/curbs/curbs.png">
                        <source media="(max-width: 767px)" srcset="<?= $mainAssets ?>/images/page/curbs/curbs-mob.png">
                        <img src="<?= $mainAssets ?>/images/page/curbs/curbs.png" alt="Бордюры металлические — производство и монтаж" loading="eager" decoding="async">
                    </picture>
                </div>
                <div class="swiper-slide home-banner-slide">
                    <picture>
                        <source type="image/avif" media="(min-width: 768px)" srcset="<?= $mainAssets ?>/images/page/gangways/gangways.avif">
                        <source type="image/avif" media="(max-width: 767px)" srcset="<?= $mainAssets ?>/images/page/gangways/gangways-mob.avif">
                        <source media="(min-width: 768px)" srcset="<?= $mainAssets ?>/images/page/gangways/gangways.png">
                        <source media="(max-width: 767px)" srcset="<?= $mainAssets ?>/images/page/gangways/gangways-mob.png">
                        <img src="<?= $mainAssets ?>/images/page/gangways/gangways.png" alt="Трапы и лотки из нержавеющей стали" loading="eager" decoding="async">
                    </picture>
                </div>
                <div class="swiper-slide home-banner-slide">
                    <picture>
                        <source type="image/avif" media="(min-width: 768px)" srcset="<?= $mainAssets ?>/images/page/lattice-decking/lattice-decking.avif">
                        <source type="image/avif" media="(max-width: 767px)" srcset="<?= $mainAssets ?>/images/page/lattice-decking/lattice-decking-mob.avif">
                        <source media="(min-width: 768px)" srcset="<?= $mainAssets ?>/images/page/lattice-decking/lattice-decking.png">
                        <source media="(max-width: 767px)" srcset="<?= $mainAssets ?>/images/page/lattice-decking/lattice-decking-mob.png">
                        <img src="<?= $mainAssets ?>/images/page/lattice-decking/lattice-decking.png" alt="Решётчатые настилы — производство металлоконструкций" loading="eager" decoding="async">
                    </picture>
                </div>
                <div class="swiper-slide home-banner-slide">
                    <picture>
                        <source type="image/avif" media="(min-width: 768px)" srcset="<?= $mainAssets ?>/images/page/protection/protection.avif">
                        <source type="image/avif" media="(max-width: 767px)" srcset="<?= $mainAssets ?>/images/page/protection/protection-mob.avif">
                        <source media="(min-width: 768px)" srcset="<?= $mainAssets ?>/images/page/protection/protection.png">
                        <source media="(max-width: 767px)" srcset="<?= $mainAssets ?>/images/page/protection/protection-mob.png">
                        <img src="<?= $mainAssets ?>/images/page/protection/protection.png" alt="Системы грязезащиты" loading="eager" decoding="async">
                    </picture>
                </div>
            </div>
            <div class="swiper-pagination home-banner-swiper__pagination"></div>
            <button type="button" class="swiper-button-prev home-banner-swiper__prev" aria-label="Предыдущий слайд"></button>
            <button type="button" class="swiper-button-next home-banner-swiper__next" aria-label="Следующий слайд"></button>
        </div>
    </div>
    <div class="container">
        <h2 class="page_title page_title--main">Каталог продукции</h2>
        <?php $this->widget('application.modules.store.widgets.CatalogWidget', [
            'view' => 'homepage-categories'
        ]); ?>
    </div>
     <?php $this->widget('application.modules.page.widgets.PagesNewWidget', [
        'parent_id' => 2,
        'view' => 'homepage-services-banner',
    ]); ?>
    <section class="container home-videos">
        <h2 class="page_title">Производство</h2>
        <div class="hv-grid">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                <button type="button" class="hv-card home-video-card<?= $i === 1 ? ' hv-card--big' : '' ?>" data-video="/uploads/video/<?= $i ?>.mp4" aria-label="Смотреть видео <?= $i ?>">
                    <img class="hv-card__poster" src="/uploads/video/posters/<?= $i ?>.webp" alt="" loading="lazy" decoding="async">
                    <span class="hv-card__play" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM15.75 13.299C16.75 12.7217 16.75 11.2783 15.75 10.7009L11.25 8.10286C10.25 7.52551 9 8.24719 9 9.4019V14.598C9 15.7527 10.25 16.4744 11.25 15.8971L15.75 13.299Z" fill="currentColor"/>
                        </svg>
                    </span>
                </button>
            <?php endfor ?>
        </div>
    </section>
    <div class="video-modal" id="video-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Видеоплеер">
        <div class="video-modal__overlay" data-video-close></div>
        <div class="video-modal__dialog">
            <button type="button" class="video-modal__close" data-video-close aria-label="Закрыть">&times;</button>
            <div class="video-modal__player"></div>
        </div>
    </div>
   
</main>
<section class="widget-pages">

    <?php $this->widget('application.modules.page.widgets.PagesNewWidget', [
        'parent_id' => 3,
        'view' => 'works',
        'limit' => 4
    ]); ?>
</section>
<div class="container container-tabs">
    <div class="tabs-head">
        <h2 class="page_title">Хиты продаж</h2>
        <a href="/store" class="to-shop">
            К покупкам
            <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/hit-arrow.svg'); ?>
        </a>
    </div>
    <?php $this->widget('application.modules.store.widgets.CatalogWidget', [
        'view' => 'category'
    ]); ?>
    <div class="categoryes-contents"></div>
</div>
<?php
$faqAll = require Yii::app()->theme->basePath . '/views/page/page/_faq_data.php';
$faqHomeSelection = [
    ['payment', 0],
    ['curbs', 0],
    ['mud', 3],
    ['gratings', 0],
];
$faqHomeItems = [];
foreach ($faqHomeSelection as $pair) {
    list($k, $i) = $pair;
    if (isset($faqAll[$k]['items'][$i])) {
        $faqHomeItems[] = $faqAll[$k]['items'][$i];
    }
}

if (!function_exists('stromsteel_faq_answer_text')) {
    function stromsteel_faq_answer_text($html) {
        $text = preg_replace('#</(p|li|ul|ol|div)>#u', "$0 ", (string)$html);
        $text = strip_tags((string)$text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/\s+/u', ' ', $text);
        return trim((string)$text);
    }
}

$faqHomeSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => [],
];
foreach ($faqHomeItems as $item) {
    $faqHomeSchema['mainEntity'][] = [
        '@type' => 'Question',
        'name' => $item['q'],
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => stromsteel_faq_answer_text($item['a']),
        ],
    ];
}
?>
<section class="container faq-home">
    <div class="faq-home__head">
        <h2 class="page_title">Вопросы и ответы</h2>
        <a href="/faq" class="faq-home__more">
            <span>Все вопросы и ответы</span>
            <svg class="faq-home__more-arrow" width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                <path d="M0.393585 4.0489L0.382658 4.04651L5.06674 4.04651L3.59424 5.52225C3.52213 5.5943 3.48258 5.69191 3.48258 5.79434C3.48258 5.89678 3.52213 5.9937 3.59424 6.06592L3.82336 6.29516C3.89541 6.36721 3.99141 6.40704 4.0938 6.40704C4.19624 6.40704 4.2923 6.36749 4.36435 6.29544L6.8885 3.77151C6.96084 3.69918 7.00039 3.60283 7.00011 3.50034C7.00039 3.39727 6.96084 3.30086 6.8885 3.22864L4.36435 0.704491C4.2923 0.632499 4.19629 0.592889 4.0938 0.592889C3.99141 0.632499 3.89541 0.632555 3.82336 0.704491L3.59424 0.933726C3.52213 1.00566 3.48258 1.10173 3.48258 1.20417C3.48258 1.30655 3.52213 1.39755 3.59424 1.46954L5.08336 2.95354L0.388349 2.95354C0.177381 2.95354 0.000104904 3.13537 0.000104904 3.34622V3.67044C0.000104904 3.8813 0.182617 4.0489 0.393585 4.0489Z" fill="currentColor"/>
            </svg>
        </a>
    </div>
    <div class="faq-home__items">
        <?php foreach ($faqHomeItems as $item): ?>
            <details class="faq-item">
                <summary class="faq-item__summary">
                    <span class="faq-item__question"><?= CHtml::encode($item['q']) ?></span>
                    <svg class="faq-item__chevron" width="16" height="16" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                        <path d="M3 6l5 5 5-5" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </summary>
                <div class="faq-item__answer"><?= $item['a'] ?></div>
            </details>
        <?php endforeach; ?>
    </div>
    <a href="/faq" class="faq-home__more faq-home__more--mobile">Все вопросы и ответы</a>
</section>
<script type="application/ld+json">
<?= json_encode($faqHomeSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>
<section class="news-section">
    <div class="container news-container">
        <?php $this->widget('application.modules.news.widgets.LastNewsWidget', [
            'limit' => 3
        ]); ?>
    </div>
</section>
<section class="aboutus-section" aria-labelledby="aboutus-title">
    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <defs>
            <symbol id="aboutus-ico-pipe" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 3c1.4 1.8 2.4 3.2 2.4 4.4a2.4 2.4 0 1 1-4.8 0C9.6 6.2 10.6 4.8 12 3z" fill="currentColor" fill-opacity=".12"/>
                <path d="M3 12h18"/>
                <path d="M5 12l2 7h10l2-7"/>
                <path d="M9 14.5v3"/>
                <path d="M12 14.5v3"/>
                <path d="M15 14.5v3"/>
            </symbol>
            <symbol id="aboutus-ico-grate" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 14h13l5-4H8z"/>
                <path d="M3 14v5h13v-5"/>
                <path d="M16 14l5-4v5l-5 4"/>
                <path d="M7 12l1.5-1.2"/>
                <path d="M11 12l1.5-1.2"/>
                <path d="M15 12l1.5-1.2"/>
                <path d="M6 17h7"/>
            </symbol>
            <symbol id="aboutus-ico-mat" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                <path d="M7 4c0 1.6.4 2.6 1.4 3.2l3 1.6c.8.4 1.4 1 1.6 1.8l.3 1.4H6.4c-.5 0-.9-.4-.9-.9V4.9c0-.5.4-.9.9-.9H7z" fill="currentColor" fill-opacity=".10"/>
                <path d="M6 4h1c0 1.6.4 2.6 1.4 3.2l3 1.6c.8.4 1.4 1 1.6 1.8l.3 1.4H6.4c-.5 0-.9-.4-.9-.9V4.9c0-.5.4-.9.9-.9z"/>
                <rect x="3" y="14.5" width="18" height="6" rx="0.8"/>
                <path d="M3 17.5h18"/>
                <path d="M7 14.5v6"/>
                <path d="M11 14.5v6"/>
                <path d="M15 14.5v6"/>
                <path d="M19 14.5v6"/>
            </symbol>
            <symbol id="aboutus-ico-edge" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 11c3-4 7-4 9 0s6 4 9 0"/>
                <path d="M3 14c3-4 7-4 9 0s6 4 9 0"/>
                <path d="M5 14v3"/>
                <path d="M19 14v3"/>
                <path d="M8 8c.5-1.5 1.5-2 2.5-2"/>
                <path d="M9.2 8c0-1 .4-2 1-2.6"/>
                <path d="M14 8c.5-1.5 1.5-2 2.5-2"/>
            </symbol>
        </defs>
    </svg>
    <div class="container">
        <!-- <p class="aboutus-eyebrow">О компании</p> -->
        <h2 class="page_title" id="aboutus-title">Несколько слов о&nbsp;нас</h2>

        <div class="aboutus-hero">
            <div class="aboutus-text-col">
                <p class="aboutus-lead">
                    Компания «СТРОМ ТРЕЙД» — <b>торгово-производственное объединение</b> по&nbsp;производству изделий из&nbsp;металла любой&nbsp;сложности.
                </p>
                <p class="aboutus-text">
                    Нашим заказчикам мы предлагаем как типовые изделия из&nbsp;металла, так и&nbsp;изделия по&nbsp;индивидуальным проектам в&nbsp;соответствии с&nbsp;вашими требованиями.
                </p>
                <p class="aboutus-text">
                    Технический отдел разрабатывает чертежи и&nbsp;КМД по&nbsp;запросу, специалисты проводят шеф-монтаж и&nbsp;работы по&nbsp;монтажу изделий на&nbsp;объекте.
                </p>
            </div>

            <aside class="aboutus-side" aria-label="Производственная база">
                <p class="aboutus-side__title">Производственная база</p>
                <p class="aboutus-side__lead">
                    Собственное оборудование, материально-техническая база и&nbsp;производственные / складские помещения в&nbsp;Подмосковье.
                </p>
                <div class="aboutus-stats">
                    <div class="aboutus-stat">
                        <p class="aboutus-stat__num">10+</p>
                        <p class="aboutus-stat__label">лет на&nbsp;рынке</p>
                    </div>
                    <div class="aboutus-stat">
                        <p class="aboutus-stat__num">200+</p>
                        <p class="aboutus-stat__label">объектов сдано</p>
                    </div>
                    <div class="aboutus-stat">
                        <p class="aboutus-stat__num">10&nbsp;дн.</p>
                        <p class="aboutus-stat__label">объект под&nbsp;ключ от</p>
                    </div>
                </div>
            </aside>
        </div>

        <h3 class="aboutus-subtitle">В&nbsp;нашем ассортименте</h3>
        <div class="aboutus-features">
            <article class="aboutus-feature">
                <span class="aboutus-feature__icon" aria-hidden="true"><svg><use href="#aboutus-ico-pipe"/></svg></span>
                <h4 class="aboutus-feature__title">Нержавеющая сталь для&nbsp;пищевой промышленности</h4>
                <p class="aboutus-feature__text">Стандартные и&nbsp;щелевые лотки, трапы с&nbsp;горизонтальным и&nbsp;вертикальным выпусками.</p>
            </article>
            <article class="aboutus-feature">
                <span class="aboutus-feature__icon" aria-hidden="true"><svg><use href="#aboutus-ico-grate"/></svg></span>
                <h4 class="aboutus-feature__title">Решётчатые настилы и&nbsp;лестничные ступени</h4>
                <p class="aboutus-feature__text">Прессованные и&nbsp;сварные металлические настилы.</p>
            </article>
            <article class="aboutus-feature">
                <span class="aboutus-feature__icon" aria-hidden="true"><svg><use href="#aboutus-ico-mat"/></svg></span>
                <h4 class="aboutus-feature__title">Системы очистки обуви</h4>
                <p class="aboutus-feature__text">Стальные оцинкованные решётки и&nbsp;придверные ковры на&nbsp;алюминиевой основе.</p>
            </article>
            <article class="aboutus-feature">
                <span class="aboutus-feature__icon" aria-hidden="true"><svg><use href="#aboutus-ico-edge"/></svg></span>
                <h4 class="aboutus-feature__title">Металлические гибкие бордюры</h4>
                <p class="aboutus-feature__text">Из&nbsp;оцинкованной и&nbsp;нержавеющей стали для&nbsp;дорожек, клумб и&nbsp;газонов.</p>
            </article>
        </div>
    </div>
</section>
<?php $this->widget('application.modules.review.widgets.ReviewCarouselWidget', [
    'limit' => 9,
    'order' => 'ASC'
]); ?>
<section class="container cf-section" aria-labelledby="cf-title">
    <div class="cf-row">
        <div class="cf-card cf-card--info">
            <img class="cf-card__bg cf-card__bg--left" src="<?= $mainAssets ?>/images/left.avif" alt="" aria-hidden="true" loading="lazy" decoding="async">
            <div class="cf-card__content">
                <span class="cf-eyebrow">— Мы на связи</span>
                <h2 id="cf-title" class="cf-title">Остались вопросы?<br>Мы на связи:</h2>
                <p class="cf-lead">Ответим на вопросы по продукции, срокам, расчёту и доставке.</p>
                <ul class="cf-list">
                    <li class="cf-item">
                        <span class="cf-item__ico" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.7"/>
                                <path d="M12 7V12L15.5 14" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div class="cf-item__body">
                            <span class="cf-item__label">Время работы</span>
                            <span class="cf-item__value">Пн–Пт с 9:00 до 18:00</span>
                        </div>
                    </li>
                    <li class="cf-item">
                        <span class="cf-item__ico" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                <path d="M5.5 4.5C5.5 4.5 7 4 8.5 4C9 4 9.5 4.2 9.7 4.7L10.7 7C10.9 7.5 10.7 8.1 10.3 8.4L9 9.3C9.7 11 11 12.3 12.7 13L13.6 11.7C13.9 11.3 14.5 11.1 15 11.3L17.3 12.3C17.8 12.5 18 13 18 13.5C18 15 17.5 16.5 17.5 16.5C17.5 17.3 16.8 18 16 18C9.9 18 4 12.1 4 6C4 5.2 4.7 4.5 5.5 4.5Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div class="cf-item__body">
                            <span class="cf-item__label">Телефон</span>
                            <a class="cf-item__value cf-item__value--link" href="tel:+74955320720">+7 (495) 532-07-20</a>
                        </div>
                    </li>
                    <li class="cf-item">
                        <span class="cf-item__ico" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/>
                                <path d="M3 7L12 13L21 7" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div class="cf-item__body">
                            <span class="cf-item__label">E-mail</span>
                            <a class="cf-item__value cf-item__value--link" href="mailto:info@strom-trade.ru">info@strom-trade.ru</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="cf-card cf-card--cta">
            <img class="cf-card__bg cf-card__bg--right" src="<?= $mainAssets ?>/images/right.avif" alt="" aria-hidden="true" loading="lazy" decoding="async">
            <div class="cf-card__content">
                <span class="cf-cta-ico" aria-hidden="true">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                        <rect x="6" y="4" width="12" height="16" rx="2" stroke="currentColor" stroke-width="1.7"/>
                        <rect x="9" y="2.5" width="6" height="3" rx="1" stroke="currentColor" stroke-width="1.7"/>
                        <path d="M9.2 13L11 14.8L15 10.8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <h3 class="cf-cta-title">Или обратитесь<br>через форму связи</h3>
                <p class="cf-cta-text">Заполните форму — мы свяжемся с вами в ближайшее время и подготовим решение.</p>
                <a href="#" class="cf-cta-btn leave-request js-button" data-target="#CallbackFormEmail" data-toggle="modal">
                    <span>Оставить заявку</span>
                    <svg width="18" height="14" viewBox="0 0 18 14" fill="none" aria-hidden="true">
                        <path d="M11 1L17 7L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17 7H1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
