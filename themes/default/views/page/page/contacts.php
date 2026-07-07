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

$email    = Yii::app()->getModule('yupe')->email;
$wmode    = Yii::app()->getModule('yupe')->wmode;
$routeUrl = 'https://yandex.ru/maps/?mode=routes&rtext=~55.741318%2C37.555274&rtt=auto';
?>
<div class="pageMainContent ct">
  <div class="container breadcrumbs-container">
    <?php $this->widget(
      'bootstrap.widgets.TbBreadcrumbs',
      ['links' => $this->breadcrumbs]
    ); ?>
  </div>

  <div class="container ct__container" id="map-container">
    <header class="ct__head">
      <span class="ct__eyebrow"><span class="ct__eyebrow-dot" aria-hidden="true"></span>Офис и производство в Москве</span>
      <h1 class="page_title ct__title"><?= $model->title; ?></h1>
      <p class="ct__lead">На связи в будни с 9:00 до 19:00 — звоните, пишите или приезжайте.</p>
    </header>

    <div class="ct__grid">
      <div class="ct__cards">

        <div class="ct-card">
          <span class="ct-card__icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.1-7-11a7 7 0 0 1 14 0c0 4.9-7 11-7 11Z"/><circle cx="12" cy="10" r="2.6"/></svg>
          </span>
          <div class="ct-card__body">
            <div class="ct-card__label">Адрес офиса и склада</div>
            <div class="ct-card__value">121059, г. Москва, ул. Киевская, д. 19</div>
            <a class="ct-card__link" href="<?= $routeUrl ?>" target="_blank" rel="noopener">
              Построить маршрут
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          </div>
        </div>

        <div class="ct-card">
          <span class="ct-card__icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 4h3l1.5 4-2 1.5a12 12 0 0 0 5 5l1.5-2 4 1.5v3a2 2 0 0 1-2.2 2A16 16 0 0 1 4.5 6.2 2 2 0 0 1 6.5 4Z"/></svg>
          </span>
          <div class="ct-card__body">
            <div class="ct-card__label">Телефоны</div>
            <a class="ct-card__value ct-card__value--link" href="tel:+74956643517">+7 (495) 664-35-17</a>
            <a class="ct-card__value ct-card__value--link" href="tel:+74955320720">+7 (495) 532-07-20</a>
          </div>
        </div>

        <div class="ct-card">
          <span class="ct-card__icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 7 8.5 6 8.5-6"/></svg>
          </span>
          <div class="ct-card__body">
            <div class="ct-card__label">E-mail</div>
            <a class="ct-card__value ct-card__value--link" href="mailto:<?= $email ?>"><?= $email ?></a>
            <button type="button" class="ct-copy" data-copy="<?= $email ?>">Скопировать</button>
          </div>
        </div>

        <div class="ct-card">
          <span class="ct-card__icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/></svg>
          </span>
          <div class="ct-card__body">
            <div class="ct-card__label">Время работы <span class="ct-status" data-ct-status hidden></span></div>
            <div class="ct-card__value"><?= $wmode ?></div>
            <div class="ct-card__muted">Сб-Вс: выходные</div>
          </div>
        </div>

      </div>

      <div class="ct__map">
        <div class="map-contacts ct__map-frame" id="strom-map-page" data-strom-map="auto">
          <noscript><span class="ct__map-fallback">Виджет карты использует JavaScript. <a href="https://yandex.ru/maps/?ll=37.555274%2C55.741318&z=17">Открыть в Яндекс.Картах</a>.</span></noscript>
        </div>
        <a class="ct__map-route" href="<?= $routeUrl ?>" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21s-7-6.1-7-11a7 7 0 0 1 14 0c0 4.9-7 11-7 11Z"/><circle cx="12" cy="10" r="2.4"/></svg>
          Построить маршрут
        </a>
      </div>
    </div>

    <div class="ct-cta">
      <div class="ct-cta__text">
        <div class="ct-cta__title">Остались вопросы?</div>
        <div class="ct-cta__sub">Перезвоним в течение рабочего дня и поможем с подбором и расчётом.</div>
      </div>
      <a href="#" class="but but-green js-button ct-cta__btn" data-target="#callbackModal" data-toggle="modal"><span>Заказать звонок</span></a>
    </div>

    <div class="ct-req">
      <div class="ct-req__title">Реквизиты</div>
      <div class="ct-req__grid">
        <div class="ct-req__row">
          <span class="ct-req__k">Организация</span>
          <span class="ct-req__v">ООО «СТРОМ ТРЕЙД»</span>
        </div>
        <div class="ct-req__row">
          <span class="ct-req__k">ИНН</span>
          <span class="ct-req__v">7730188020 <button type="button" class="ct-copy ct-copy--inline" data-copy="7730188020">копировать</button></span>
        </div>
        <div class="ct-req__row">
          <span class="ct-req__k">КПП</span>
          <span class="ct-req__v">773001001</span>
        </div>
        <div class="ct-req__row">
          <span class="ct-req__k">Генеральный директор</span>
          <span class="ct-req__v">Родионов Александр Витальевич</span>
        </div>
      </div>
    </div>
  </div>
</div>
