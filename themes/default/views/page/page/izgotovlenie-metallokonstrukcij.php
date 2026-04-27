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

  <?php $this->renderPartial('_services_nav', ['current' => 'izgotovlenie-metallokonstrukciy']); ?>

  <div class="svc-page__header">
    <div class="svc-page__inner svc-page__header-inner">
      <div class="svc-page__heading">
        <h1 class="svc-page__title">Изготовление металлоконструкций</h1>
        <p class="svc-page__sub">Изготовление по индивидуальным чертежам — востребованная услуга в строительстве. Специалисты СТРОМ ТРЕЙД готовы создать широкий ассортимент изделий из металла по проектам заказчика или предоставить типовые решения.</p>
      </div>
      <div class="svc-page__badge">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.746 3.746 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.745 3.745 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
        Производство в Подмосковье
      </div>
    </div>
  </div>

  <main class="svc-page__inner svc-page__main">

    <!-- Изделия -->
    <section class="svc-card">
      <div class="svc-card__head">
        <div class="svc-card__head-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z"/></svg>
        </div>
        <h2>Мы предлагаем следующие изделия</h2>
      </div>
      <div class="svc-card__body">
        <p class="svc-intro">При изготовлении металлоконструкций специалисты компании учитывают все требования конкретного заказчика. Производство осуществляется на современном высокотехнологичном оборудовании в условиях производственных помещений, расположенных в Подмосковье.</p>
        <div class="svc-products-grid">
          <div class="svc-product-tile">
            <div class="svc-product-tile__ico">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
            </div>
            <div class="svc-product-tile__name">Лестницы — внутренние и наружные, для всех видов объектов любой сложности</div>
          </div>
          <div class="svc-product-tile">
            <div class="svc-product-tile__ico">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
            </div>
            <div class="svc-product-tile__name">Опоры</div>
          </div>
          <div class="svc-product-tile">
            <div class="svc-product-tile__ico">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z"/></svg>
            </div>
            <div class="svc-product-tile__name">Площадки обслуживания</div>
          </div>
          <div class="svc-product-tile">
            <div class="svc-product-tile__ico">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
            </div>
            <div class="svc-product-tile__name">Различные виды ограждений</div>
          </div>
          <div class="svc-product-tile">
            <div class="svc-product-tile__ico">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 7.5l-2.25-1.313M21 7.5v2.25m0-2.25l-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3l2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75l2.25-1.313M12 21.75V19.5m0 2.25l-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-9 5.25-9-5.25v-2.25l9 5.25 9-5.25z"/></svg>
            </div>
            <div class="svc-product-tile__name">Закладные детали</div>
          </div>
          <div class="svc-product-tile svc-product-tile--accent">
            <div class="svc-product-tile__ico">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
            </div>
            <div class="svc-product-tile__name">Изделия по индивидуальным чертежам заказчика</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Преимущества -->
    <section class="svc-card">
      <div class="svc-card__head">
        <div class="svc-card__head-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
        </div>
        <h2>Наши металлоконструкции отличаются</h2>
      </div>
      <div class="svc-card__body">
        <div class="svc-features-grid">
          <article class="svc-feature">
            <span class="svc-feature__num">1</span>
            <div class="svc-feature__icon"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg></div>
            <h3 class="svc-feature__title">Надёжность</h3>
            <p class="svc-feature__desc">Все сварные швы и осевые соединения тщательно проверяются на производстве</p>
          </article>
          <article class="svc-feature">
            <span class="svc-feature__num">2</span>
            <div class="svc-feature__icon"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4.5 12.75l6 6 9-13.5"/></svg></div>
            <h3 class="svc-feature__title">Высокое качество</h3>
            <p class="svc-feature__desc">Контроль ведётся на всех этапах — от подбора сырья до финальной приёмки</p>
          </article>
          <article class="svc-feature">
            <span class="svc-feature__num">3</span>
            <div class="svc-feature__icon"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg></div>
            <h3 class="svc-feature__title">Точность</h3>
            <p class="svc-feature__desc">Для получения отличного результата на производстве есть всё необходимое оборудование и инструменты</p>
          </article>
          <article class="svc-feature">
            <span class="svc-feature__num">4</span>
            <div class="svc-feature__icon"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            <h3 class="svc-feature__title">Доступная цена</h3>
            <p class="svc-feature__desc">Мы устанавливаем полную стоимость, всегда предоставляем обоснование для каждого вида работ</p>
          </article>
        </div>
      </div>
    </section>

    <!-- Причины -->
    <section class="svc-card">
      <div class="svc-card__head">
        <div class="svc-card__head-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
        </div>
        <h2>Причины выбрать наше предприятие</h2>
      </div>
      <div class="svc-card__body">
        <ol class="svc-reasons">
          <li class="svc-reasons__item"><span class="svc-reasons__num">1</span><div class="svc-reasons__text">Работы ведутся на <strong>современном профессиональном оборудовании</strong></div></li>
          <li class="svc-reasons__item"><span class="svc-reasons__num">2</span><div class="svc-reasons__text"><strong>Опыт и квалификация</strong> специалистов позволяет тщательно контролировать процесс выполнения заказа и гарантирует высокое качество</div></li>
          <li class="svc-reasons__item"><span class="svc-reasons__num">3</span><div class="svc-reasons__text">Сотрудничество только с <strong>проверенными поставщиками материалов</strong>, применяемых для создания металлических конструкций</div></li>
          <li class="svc-reasons__item"><span class="svc-reasons__num">4</span><div class="svc-reasons__text"><strong>Доступная цена металлоконструкций</strong>, не превышающая средних рыночных предложений по рынку. Для постоянных клиентов действует <strong>система бонусов и скидок</strong></div></li>
          <li class="svc-reasons__item"><span class="svc-reasons__num">5</span><div class="svc-reasons__text"><strong>Сроки</strong> реализации проектов соблюдаются</div></li>
          <li class="svc-reasons__item"><span class="svc-reasons__num">6</span><div class="svc-reasons__text">Подготовка изделий с <strong>использованием в любых климатических и производственных условиях</strong>: путём нанесения различных видов покрытий, горячее цинкование, порошковое покрытие и т.д.</div></li>
          <li class="svc-reasons__item"><span class="svc-reasons__num">7</span><div class="svc-reasons__text"><strong>Индивидуальный подход</strong> к каждому заказу: согласование внешнего вида металлоконструкций по индивидуальным чертежам или эскизам, предоставленным перед заключением договора</div></li>
          <li class="svc-reasons__item"><span class="svc-reasons__num">8</span><div class="svc-reasons__text"><strong>Комплексный подход:</strong> изделия, при необходимости, могут быть не только изготовлены, но и доставлены на объект и собраны на месте нашими специалистами</div></li>
        </ol>
        <div class="svc-notice">
          <div class="svc-notice__ico">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
          </div>
          <p>Если вам нужны металлоконструкции, соответствующие установленным стандартам, изготовленные из качественного материала и по вашим чертежам — <strong>обращайтесь.</strong> Связаться с нами можно через форму заявки на сайте, по телефону или через e-mail.</p>
        </div>
      </div>
    </section>

  </main>

  <!-- Форма (существующий виджет, маска телефона не трогаем).
       Класс .page-services нужен, потому что стили .services-form scoped под него.
       Подпись для фото-карточки прокидываем через CSS-переменную --photo-caption. -->
  <div class="svc-page__form page-services" style="--photo-caption: 'Производство металлоконструкций любой сложности по индивидуальным проектам'">
    <?php $this->widget('application.modules.mail.widgets.ServicesFormsWidget', [
      'img' => '1.jpg',
    ]); ?>
  </div>

  <!-- Галерея -->
  <section class="svc-page__inner svc-page__gallery-section">
    <div class="svc-section-label">Примеры работ</div>
    <div class="svc-gallery">
      <a href="https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=1600&q=85" class="svc-gallery__item" data-fancybox="works"><img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=400&q=75" alt="" loading="lazy"></a>
      <a href="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1600&q=85" class="svc-gallery__item" data-fancybox="works"><img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&q=75" alt="" loading="lazy"></a>
      <a href="https://images.unsplash.com/photo-1565793298595-6a879b1d9492?w=1600&q=85" class="svc-gallery__item" data-fancybox="works"><img src="https://images.unsplash.com/photo-1565793298595-6a879b1d9492?w=400&q=75" alt="" loading="lazy"></a>
      <a href="https://images.unsplash.com/photo-1518709779341-56cf4535e94a?w=1600&q=85" class="svc-gallery__item" data-fancybox="works"><img src="https://images.unsplash.com/photo-1518709779341-56cf4535e94a?w=400&q=75" alt="" loading="lazy"></a>
    </div>
  </section>

</div>
