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
?>

<div class="svc-page">

  <section class="svc-page__crumbs">
    <div class="container breadcrumbs-container">
      <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', ['links' => $this->breadcrumbs]); ?>
    </div>
  </section>

  <?php $this->renderPartial('_services_nav', ['current' => 'dostavka']); ?>

  <!-- Hero-banner с фоновым изображением и текстом поверх -->
  <section class="svc-hero-banner">
    <picture class="svc-hero-banner__picture">
      <!-- Мобильная версия — только JPG -->
      <source media="(max-width: 900px)" srcset="<?= $this->mainAssets ?>/images/hero-mob.jpg">
      <!-- Десктоп: WebP с PNG-фоллбэком -->
      <source type="image/webp" srcset="<?= $this->mainAssets ?>/images/hero.webp">
      <img src="<?= $this->mainAssets ?>/images/hero.png" alt="Доставка металлоконструкций по всей России" loading="eager" decoding="async">
    </picture>
    <div class="svc-hero-banner__overlay">
      <div class="svc-page__inner svc-hero-banner__text">
        <div class="svc-hero-banner__eyebrow">Услуги компании</div>
        <h1 class="svc-hero-banner__title">Доставка<br>по всей России</h1>
        <p class="svc-hero-banner__sub">СТРОМ ТРЕЙД обеспечивает доставку металлоконструкций в любой регион страны — быстро и надёжно.</p>
        <div class="svc-hero-banner__stats">
          <div class="svc-hero-banner__stat">
            <div class="svc-hero-banner__stat-val">1–<span>2</span></div>
            <div class="svc-hero-banner__stat-label">дня по Москве</div>
          </div>
          <div class="svc-hero-banner__stat">
            <div class="svc-hero-banner__stat-val">85<span>+</span></div>
            <div class="svc-hero-banner__stat-label">регионов РФ</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <main class="svc-page__inner svc-page__main">

    <!-- Оплата товара -->
    <section class="svc-card">
      <div class="svc-card__head">
        <div class="svc-card__head-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
        </div>
        <h2>Оплата товара</h2>
      </div>
      <div class="svc-card__body">
        <p class="svc-intro">Оплатить товар, приобретаемый в компании «СТРОМ ТРЕЙД», вы можете любым из предложенных способов:</p>

        <div class="svc-two-col">
          <div class="svc-pay">
            <div class="svc-pay__title">
              <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
              Для физических лиц
            </div>
            <ul class="svc-pay__list">
              <li>Наличными в шоу-руме: г.&nbsp;Москва, ул.&nbsp;Киевская&nbsp;д.&nbsp;19</li>
              <li>Банковским переводом через кассу банка или интернет-банк. Для оплаты необходимо согласовать сроки с менеджером и получить счёт-договор — приходит через e-mail, sms или мессенджер</li>
            </ul>
          </div>
          <div class="svc-pay">
            <div class="svc-pay__title">
              <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21"/></svg>
              Для юридических лиц
            </div>
            <ul class="svc-pay__list">
              <li>Безналичный расчёт путём оплаты выставленного счёта</li>
              <li>Наличный расчёт в офисе СТРОМ ТРЕЙД: г.&nbsp;Москва, ул.&nbsp;Киевская&nbsp;д.&nbsp;19</li>
            </ul>
          </div>
        </div>

        <div class="svc-notice">
          <div class="svc-notice__ico">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
          </div>
          <p><strong>Документы:</strong> физическим лицам — товарный и кассовые чеки. Юридическим лицам — УПД (Универсальный передаточный документ).</p>
        </div>
      </div>
    </section>

    <!-- Варианты доставки -->
    <section class="svc-card">
      <div class="svc-card__head">
        <div class="svc-card__head-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
        </div>
        <h2>Варианты доставки</h2>
      </div>
      <div class="svc-card__body">
        <p class="svc-intro">После согласования деталей с нашим менеджером, ваш заказ будет оперативно доставлен удобной для вас службой. <strong>Доставка действует по всей России!</strong></p>

        <div class="svc-two-col">
          <div class="svc-dlv">
            <div class="svc-dlv__head">
              <div class="svc-dlv__num">1</div>
              <div class="svc-dlv__title">Доставка автотранспортом на объект</div>
            </div>
            <div class="svc-dlv__items">
              <div class="svc-dlv__item">
                <div class="svc-dlv__label">По Москве</div>
                <p>В течение <strong>1–2 рабочих дней</strong> при наличии товара на складе. Для заказных позиций сроки оговариваются с менеджером.</p>
              </div>
              <div class="svc-dlv__item">
                <div class="svc-dlv__label">Регионы РФ</div>
                <p>Осуществляется транспортными компаниями. Срок зависит от региона.</p>
              </div>
            </div>
          </div>
          <div class="svc-dlv">
            <div class="svc-dlv__head">
              <div class="svc-dlv__num">2</div>
              <div class="svc-dlv__title">Самовывоз со склада</div>
            </div>
            <div class="svc-dlv__items">
              <div class="svc-dlv__item">
                <div class="svc-dlv__label">Адрес склада</div>
                <p><strong>МО, г. Подольск, мкл. Львовский, проезд Металлургов 3Г</strong></p>
              </div>
              <div class="svc-dlv__item">
                <div class="svc-dlv__label">Прочие товарные группы</div>
                <p>Адрес самовывоза согласовывается дополнительно с менеджерами компании.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="svc-notice svc-notice--warn">
          <div class="svc-notice__ico">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
          </div>
          <p>При доставке <strong>транспортными компаниями</strong> ответственность за сохранность товара несёт фирма-экспедитор.</p>
        </div>
      </div>
    </section>

  </main>

  <!-- Cost-banner: растяжка во всю ширину -->
  <section class="svc-cost-banner">
    <div class="svc-page__inner svc-cost-banner__inner">
      <div class="svc-cost-banner__left">
        <div class="svc-cost-banner__eyebrow">Стоимость доставки</div>
        <h2 class="svc-cost-banner__title">Стоимость рассчитывается<br>индивидуально</h2>
        <p class="svc-cost-banner__desc">Цена каждого заказа определяется исходя из веса, объёма товара и местоположения объекта. Менеджер рассчитает точную стоимость после уточнения параметров.</p>
        <div class="svc-cost-banner__chips">
          <div class="svc-cost-banner__chip">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 3v1m0 16v1M4.22 4.22l.707.707m12.02 12.02l.707.707M1 12h1m20 0h1M4.22 19.78l.707-.707M18.95 5.05l.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Вес товара
          </div>
          <div class="svc-cost-banner__chip">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/></svg>
            Объём
          </div>
          <div class="svc-cost-banner__chip">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
            Местоположение объекта
          </div>
        </div>
        <a href="/kontakty" class="svc-cost-banner__btn">
          Рассчитать стоимость
          <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
        </a>
      </div>
      <div class="svc-cost-banner__right">
        <img src="<?= $this->mainAssets ?>/images/cost-img.png" alt="Индивидуальный расчёт стоимости доставки" loading="eager" decoding="async">
     </div>
    </div>
  </section>

</div>
