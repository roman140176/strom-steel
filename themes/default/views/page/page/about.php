<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title;
$this->breadcrumbs = $this->getBreadCrumbs();
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: Yii::app()->getModule('yupe')->siteKeyWords;

$mainAssets  = Yii::app()->controller->mainAssets;
$themeAssets = Yii::app()->getTheme()->getAssetsUrl();
Yii::app()->clientScript->registerCssFile($themeAssets . '/css/about.css');
?>
<div class="ab-page">
    <div class="ab-crumbs-wrap">
        <div class="container">
            <?php $this->widget(
                'bootstrap.widgets.TbBreadcrumbs',
                ['links' => $this->breadcrumbs]
            ); ?>
        </div>
    </div>

    <section class="ab-hero">
        <div class="container">
            <div class="ab-hero-grid">
                <div>
                    <div class="ab-eyebrow">О компании</div>
                    <h1 class="ab-h1">Производство изделий <em>из металла</em> любой сложности</h1>
                </div>
                <div>
                    <p class="ab-hero-lead">
                        Мы — торгово-производственное объединение по изготовлению изделий из металла любой сложности. Нашим заказчикам мы можем предложить как готовые изделия из металла, так и изделия, выполненные по индивидуальным проектам в соответствии с требованиями клиента.
                    </p>
                    <dl class="ab-hero-meta">
                        <div>
                            <dt>Профиль</dt>
                            <dd>Производство и торговля</dd>
                        </div>
                        <div>
                            <dt>Подход</dt>
                            <dd>Индивидуальные проекты</dd>
                        </div>
                        <div>
                            <dt>География</dt>
                            <dd>Москва и область</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </section>

    <section class="ab-s">
        <div class="container">
            <div class="ab-s-head">
                <div>
                    <div class="ab-s-num">— 01 / Ассортимент</div>
                </div>
                <div>
                    <h2 class="ab-s-title">Ассортимент <em>нашей компании</em></h2>
                    <p class="ab-s-sub">Четыре направления, в которых мы работаем — от металлоконструкций под заказ до элементов из нержавеющей стали.</p>
                </div>
            </div>

            <div class="ab-cat-grid">
                <article class="ab-cat-card">
                    <div class="ab-cat-num">01</div>
                    <h3>Элементы из нержавеющей стали</h3>
                    <ul>
                        <li>стандартные и щелевые лотки</li>
                        <li>трапы с горизонтальным и вертикальным выпусками</li>
                        <li>мебель и оборудование для гигиены</li>
                    </ul>
                </article>
                <article class="ab-cat-card">
                    <div class="ab-cat-num">02</div>
                    <h3>Металлические настилы</h3>
                    <ul>
                        <li>сварные решётчатые настилы</li>
                        <li>прессованные решётчатые настилы</li>
                        <li>лестничные ступени</li>
                    </ul>
                </article>
                <article class="ab-cat-card">
                    <div class="ab-cat-num">03</div>
                    <h3>Системы грязезащиты</h3>
                    <ul>
                        <li>стальные оцинкованные решётки</li>
                        <li>придверные ковры на алюминиевой основе</li>
                    </ul>
                </article>
                <article class="ab-cat-card">
                    <div class="ab-cat-num">04</div>
                    <h3>Металлические бордюры</h3>
                    <ul>
                        <li>стальные бордюры</li>
                        <li>бордюры из нержавеющей стали</li>
                        <li>крепежи для металлических бордюров</li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <section class="ab-s">
        <div class="container">
            <div class="ab-s-head">
                <div>
                    <div class="ab-s-num">— 02 / Услуги</div>
                </div>
                <div>
                    <h2 class="ab-s-title">Услуги, которые мы <em>предоставляем</em></h2>
                    <p class="ab-s-sub">От проектирования и подготовки чертежей до изготовления, доставки и монтажа на объекте заказчика.</p>
                </div>
            </div>

            <div class="ab-srv-grid">
                <article class="ab-srv-tile ab-srv-tile--t1">
                    <?= CHtml::image($mainAssets . '/images/page/about/3.avif', '', ['class' => 'ab-srv-tile__img', 'loading' => 'lazy', 'decoding' => 'async']) ?>
                    <div class="ab-srv-tile__body">
                        <div class="ab-srv-tile__num">— 01</div>
                        <h4>Металлические бордюры. Стальные бордюры. Бордюры из нержавеющей стали.</h4>
                    </div>
                </article>
                <article class="ab-srv-tile ab-srv-tile--t2">
                    <?= CHtml::image($mainAssets . '/images/page/about/7.avif', '', ['class' => 'ab-srv-tile__img', 'loading' => 'lazy', 'decoding' => 'async']) ?>
                    <div class="ab-srv-tile__body">
                        <div class="ab-srv-tile__num">— 02</div>
                        <h4>Разработка чертежей изделий в&nbsp;3D, схем и&nbsp;чертежей КМД</h4>
                    </div>
                </article>
                <article class="ab-srv-tile ab-srv-tile--t3">
                    <?= CHtml::image($mainAssets . '/images/page/about/4.avif', '', ['class' => 'ab-srv-tile__img', 'loading' => 'lazy', 'decoding' => 'async']) ?>
                    <div class="ab-srv-tile__body">
                        <div class="ab-srv-tile__num">— 03</div>
                        <h4>Оперативная доставка изделий до&nbsp;объекта</h4>
                    </div>
                </article>
                <article class="ab-srv-tile ab-srv-tile--t4">
                    <?= CHtml::image($mainAssets . '/images/page/about/6.avif', '', ['class' => 'ab-srv-tile__img', 'loading' => 'lazy', 'decoding' => 'async']) ?>
                    <div class="ab-srv-tile__body">
                        <div class="ab-srv-tile__num">— 04</div>
                        <h4>Монтаж изделий на&nbsp;объекте заказчика. Шефмонтаж под руководством технических специалистов</h4>
                    </div>
                </article>
                <article class="ab-srv-tile ab-srv-tile--t5">
                    <?= CHtml::image($mainAssets . '/images/page/about/5.avif', '', ['class' => 'ab-srv-tile__img', 'loading' => 'lazy', 'decoding' => 'async']) ?>
                    <div class="ab-srv-tile__body">
                        <div class="ab-srv-tile__num">— 05</div>
                        <h4>Высокоточная лазерная резка по&nbsp;чертежам заказчика</h4>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="ab-s">
        <div class="container">
            <div class="ab-s-head">
                <div>
                    <div class="ab-s-num">— 03 / Принципы</div>
                </div>
                <div>
                    <h2 class="ab-s-title">Наши <em>ценности</em></h2>
                    <p class="ab-s-sub">Подход, который мы держим на каждом проекте — от первого чертежа до сданного объекта.</p>
                </div>
            </div>

            <div class="ab-val-grid">
                <article class="ab-val-card">
                    <div class="ab-val-num">01</div>
                    <h4>Мы предлагаем комплексные решения</h4>
                    <ul>
                        <li>разработка чертежей</li>
                        <li>подбор материала</li>
                        <li>изготовление</li>
                        <li>доставка</li>
                        <li>монтаж</li>
                        <li>гарантия</li>
                    </ul>
                </article>
                <article class="ab-val-card">
                    <div class="ab-val-num">02</div>
                    <h4>Ответственное отношение к&nbsp;заказчику</h4>
                    <p>Обещаем только то, что можем выполнить — наше согласие — это обязательство выполнить достигнутые устные или письменные договорённости.</p>
                </article>
                <article class="ab-val-card">
                    <div class="ab-val-num">03</div>
                    <h4>Надёжный производитель</h4>
                    <p>В производстве используем передовые технологии. Все изделия соответствуют утверждённым ГОСТам и отвечают заявленным характеристикам.</p>
                </article>
                <article class="ab-val-card">
                    <div class="ab-val-num">04</div>
                    <h4>Ориентированность на&nbsp;клиента</h4>
                    <p>Мы всегда рядом с нашими заказчиками: осуществляем подготовку проектных решений, обеспечиваем высокий уровень сервиса и техническое сопровождение.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="ab-s">
        <div class="container">
            <div class="ab-team">
                <div class="ab-team-text">
                    <div class="ab-quote-mark">— Команда</div>
                    <p>В компании работает опытный персонал, сочетающий в себе профессиональные качества и исключительную ответственность. Гибкость в процессе сделки обеспечит вам высокий уровень сервиса, знание всех необходимых технических подробностей и приведёт к наиболее эффективному решению поставленных задач.</p>
                    <div class="ab-team-text__sig">— О подходе компании</div>
                </div>
                <div class="ab-team-photo" aria-hidden="true">
                    <?= CHtml::image($mainAssets . '/images/page/about/1.avif', '', ['loading' => 'lazy', 'decoding' => 'async']) ?>
                </div>
            </div>
        </div>
    </section>

    <section class="ab-s">
        <div class="container">
            <div class="ab-cta">
                <div class="ab-cta-img" aria-hidden="true">
                    <?= CHtml::image($mainAssets . '/images/page/about/2.avif', '', ['loading' => 'lazy', 'decoding' => 'async']) ?>
                </div>
                <div class="ab-cta-card">
                    <div class="ab-eyebrow ab-eyebrow--light">Не нашли в каталоге?</div>
                    <div>
                        <h3 class="ab-cta-title">Предложим индивидуальное решение под вашу задачу</h3>
                        <p class="ab-cta-text">Если в нашем каталоге не оказалось подходящего изделия, мы можем предложить свой собственный вариант решения — разработать индивидуальный проект, по которому будут работать наши высококвалифицированные инженеры и разработать под вас изделие.</p>
                    </div>
                    <a href="#" class="ab-btn js-button" data-target="#CallbackFormEmail" data-toggle="modal">
                        Оставить заявку
                        <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
