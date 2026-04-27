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
        <h2 class="page_title">Каталог продукции</h2>
        <?php $this->widget('application.modules.store.widgets.CatalogWidget', [
            'view' => 'homepage-categories'
        ]); ?>
    </div>
     <?php $this->widget('application.modules.page.widgets.PagesNewWidget', [
        'parent_id' => 2
    ]); ?>
    <section class="container home-videos">
        <h2 class="page_title">Производство</h2>
        <div class="home-videos-swiper-wrap">
            <div class="swiper home-videos-swiper">
                <div class="swiper-wrapper">
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <div class="swiper-slide">
                            <button type="button" class="home-video-card" data-video="/uploads/video/<?= $i ?>.mp4" aria-label="Смотреть видео <?= $i ?>">
                                <img class="home-video-card__poster" src="/uploads/video/posters/<?= $i ?>.webp" alt="" loading="lazy" decoding="async" width="270" height="480">
                                <span class="home-video-card__play" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" width="56" height="56"><path fill="currentColor" d="M8 5v14l11-7z"/></svg>
                                </span>
                            </button>
                        </div>
                    <?php endfor ?>
                </div>
                <div class="swiper-pagination home-videos-swiper__pagination"></div>
            </div>
            <button type="button" class="swiper-button-prev home-videos-swiper__prev" aria-label="Предыдущее видео"></button>
            <button type="button" class="swiper-button-next home-videos-swiper__next" aria-label="Следующее видео"></button>
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
<section class="container about-container">
    <h2 class="page_title">Несколько слов о нас</h2>
    <?php $about = Page::model()->findByPk(4) ?>
    <div class="about-content">
        <?= $about['short_content'] ?>
    </div>
    <div id="read-more">
        <span>Читать весь текст</span>
        <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/cats.svg'); ?>
    </div>
</section>
<section class="container container-form">
    <div class="form-info">
        <h2 class="page_title">Остались вопросы? Мы на связи:</h2>
        <small><?= Yii::app()->getModule('yupe')->wmode ?></small>
        <a href="tel:<?= Yii::app()->getModule('yupe')->p_reception ?>" class="form-info__tel">
            <?= Yii::app()->getModule('yupe')->reception ?>
        </a>
        <small>Почта для связи:</small>
        <a href="mailTo:<?= Yii::app()->getModule('yupe')->email ?>" class="form-info__email">
            <?= Yii::app()->getModule('yupe')->email ?>
        </a>
    </div>
    <div class="form-sender">
        <h2 class="page_title">Или обратитесь через форму связи</h2>
        <small>Наши специалисты свяжутся с вами в ближайшее время</small>
        <a href="#" class="leave-request js-button" data-target="#CallbackFormEmail" data-toggle="modal">
            Оставить заявку
            <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/form-arr.svg'); ?>
        </a>
    </div>
</section>
<?php
Yii::app()->clientScript->registerScript("items", "
        var items = $('.about-content').find('ol li').length;
        $('.about-content').find('ol li').slice(-9).hide();
        $('.about-content').find('p').hide();
        $('.about-content').append('<div class =\"half-opacity\"></div>');
        $(document).delegate('#read-more','click',function(){
            $(this).toggleClass('active');
            if($(this).hasClass('active')){
                $('.about-content').find('ol li:hidden').show();
                $('.about-content').find('p').show();
                $('.half-opacity').hide();
                $(this).find('span').text('Скрыть');
                }else{
                   $('.about-content').find('ol li').slice(-9).hide();
                    $('.about-content').find('p').hide();
                    $('.about-content').append('<div class =\"half-opacity\"></div>');
                    $(this).find('span').text('Читать весь текст');
                }
            })

    ");
?>
<style>
    .second-level-categories.homepage-categories{
        grid-template-columns: repeat(4,1fr);
    }
    .second-level-categories.homepage-categories .csl__item{
        background: rgb(242, 245, 248);
    }
     @media (max-width:991px){
        .second-level-categories.homepage-categories{
            grid-gap: 8px;
        }
     }
    @media (max-width:767px) {
        .second-level-categories.homepage-categories{
            grid-template-columns: repeat(2,1fr);
        }
    }
    @media (max-width:720px) {
        .second-level-categories.homepage-categories .csl__img{
            width: 100px;
        }
        .second-level-categories.homepage-categories .csl__img img{
            width: 100%;
            height: auto;
        }
        .second-level-categories.homepage-categories .csl__item{
            padding: 16px;
        }
    }
    @media (max-width:720px) {
        .second-level-categories.homepage-categories{
            grid-template-columns: repeat(2,50%);
        }
    }
</style>