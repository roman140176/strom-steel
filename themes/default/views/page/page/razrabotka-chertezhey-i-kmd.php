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

  <?php $this->renderPartial('_services_nav', ['current' => 'razrabotka-chertezhey-i-kmd']); ?>

  <div class="svc-page__header">
    <div class="svc-page__inner svc-page__header-inner">
      <div class="svc-page__heading">
        <h1 class="svc-page__title">Разработка чертежей и КМД</h1>
        <p class="svc-page__sub">Проектирование металлоконструкций по индивидуальным заданиям с использованием 3D-графики, в соответствии с нормативной документацией (ГОСТ, ТУ, ОСТ).</p>
      </div>
      <div class="svc-page__badges">
        <div class="svc-page__badge">
          <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0H3"/></svg>
          Компас 3D и AutoCAD
        </div>
        <div class="svc-page__badge">
          <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.746 3.746 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.745 3.745 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
          ГОСТ / ТУ / ОСТ
        </div>
      </div>
    </div>
  </div>

  <main class="svc-page__inner svc-page__main">

    <!-- Этапы разработки -->
    <section class="svc-card">
      <div class="svc-card__head">
        <div class="svc-card__head-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z"/></svg>
        </div>
        <h2>Этапы разработки чертежей</h2>
      </div>
      <div class="svc-card__body">
        <p class="svc-intro">Основные этапы от начала разработки чертежей металлоконструкций до финального результата:</p>

        <ol class="svc-steps">
          <li class="svc-steps__item"><span class="svc-steps__num">1</span><div class="svc-steps__text"><strong>Определение типа изделия,</strong> его назначение и степень сложности — предварительное задание с общими данными</div></li>
          <li class="svc-steps__item"><span class="svc-steps__num">2</span><div class="svc-steps__text"><strong>Выбор подходящих материалов,</strong> подготовка первичного эскиза и модели для визуализации</div></li>
          <li class="svc-steps__item"><span class="svc-steps__num">3</span><div class="svc-steps__text"><strong>Составление плана</strong> необходимых сборочных работ конструкции в целом</div></li>
          <li class="svc-steps__item"><span class="svc-steps__num">4</span><div class="svc-steps__text"><strong>Согласование</strong> с заказчиком всех технических моментов</div></li>
          <li class="svc-steps__item"><span class="svc-steps__num">5</span><div class="svc-steps__text"><strong>Составление сметы,</strong> где указывается стоимость проектирования металлоконструкций</div></li>
          <li class="svc-steps__item"><span class="svc-steps__num">6</span><div class="svc-steps__text"><strong>Согласование проекта</strong></div></li>
          <li class="svc-steps__item"><span class="svc-steps__num">7</span><div class="svc-steps__text"><strong>Подготовка полного комплекта</strong> всех чертежей, включая монтажные</div></li>
        </ol>

        <div class="svc-tech-grid">
          <div class="svc-tech">
            <div class="svc-tech__icon">
              <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/></svg>
            </div>
            <div class="svc-tech__body">
              <h3 class="svc-tech__title">3D-моделирование</h3>
              <p class="svc-tech__desc">Все проекты разрабатываются с использованием 3D-графики. В моделях отображены все элементы вплоть до болтовых соединений</p>
            </div>
          </div>
          <div class="svc-tech">
            <div class="svc-tech__icon">
              <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
            </div>
            <div class="svc-tech__body">
              <h3 class="svc-tech__title">Нормативная документация</h3>
              <p class="svc-tech__desc">Все работы ведутся в строгом соответствии с ГОСТ, ТУ, ОСТ и другими нормативными документами</p>
            </div>
          </div>
          <div class="svc-tech">
            <div class="svc-tech__icon">
              <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="svc-tech__body">
              <h3 class="svc-tech__title">Гибкое ценообразование</h3>
              <p class="svc-tech__desc">Цена зависит от сложности и объёма. Окончательные расчёты объявляются после уточнения всей информации и проведения замеров</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Разработка КМД -->
    <section class="svc-card">
      <div class="svc-card__head">
        <div class="svc-card__head-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
        </div>
        <h2>Разработка чертежей КМД</h2>
      </div>
      <div class="svc-card__body">
        <p class="svc-intro"><strong>Проект КМД — Конструкции Металлические Деталировочные</strong> — это полное и детальное раскрытие разделов КМ, необходимое для перехода к изготовлению, сборке и монтажу металлоконструкций. Без этого раздела невозможно перейти к реализации проекта. По разделу формируется спецификация, по которой оцениваются затраты на изготовление деталей с учётом материалов, рабочего времени и привлечения специалистов.</p>

        <div class="svc-split-grid">
          <article class="svc-split svc-split--accent">
            <div class="svc-split__tag">Раздел 1</div>
            <h3 class="svc-split__title">Сборочные и детальные чертежи</h3>
            <p class="svc-split__desc">Передаются на производство для изготовления деталей и сборки отдельных узлов металлоконструкций. Содержат полную информацию для производственного цикла.</p>
          </article>
          <article class="svc-split">
            <div class="svc-split__tag">Раздел 2</div>
            <h3 class="svc-split__title">Монтажные чертежи</h3>
            <p class="svc-split__desc">Передаются специалистам для монтажа конструкций на объекте. Специалисты составляют карту сборочных операций и технологические карты монтажа непосредственно на объекте.</p>
          </article>
        </div>

        <div class="svc-benefits-grid">
          <article class="svc-benefit">
            <h3 class="svc-benefit__title">
              <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z"/></svg>
              Полная спецификация
            </h3>
            <p class="svc-benefit__desc">По КМД составляется сборочная спецификация, по которой специалисты составляют карту сборочных операций</p>
          </article>
          <article class="svc-benefit">
            <h3 class="svc-benefit__title">
              <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M2.25 6L9 12.75l4.286-4.286a11.948 11.948 0 014.306 6.43l.776 2.898m0 0l3.182-5.511m-3.182 5.51l-5.511-3.181"/></svg>
              Детализация элементов
            </h3>
            <p class="svc-benefit__desc">В проектировании детализированы стальные балки, прогоны, несущие и вспомогательные колонны, узлы соединений деталей и элементов</p>
          </article>
          <article class="svc-benefit">
            <h3 class="svc-benefit__title">
              <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0H3"/></svg>
              Компас 3D и AutoCAD
            </h3>
            <p class="svc-benefit__desc">Проектирование КМД осуществляется в профессиональном ПО Компас 3D и AutoCAD — высокое качество в короткие сроки</p>
          </article>
        </div>

        <div class="svc-notice">
          <div class="svc-notice__ico">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
          </div>
          <p>КМД выстраивается как часть <strong>рабочей документации проекта,</strong> по которой организуются строительные и монтажные работы с металлоконструкциями на объекте. Осуществляется проверка спецификации с выявлением недочётов проекта и их корректировка, после чего происходит закупка необходимого металла для производства.</p>
        </div>

      </div>
    </section>

  </main>

  <!-- Форма (существующий виджет, маска телефона не трогаем).
       Класс .page-services нужен, потому что стили .services-form scoped под него. -->
  <div class="svc-page__form page-services" style="--photo-caption: 'Проектирование в профессиональном ПО Компас 3D и AutoCAD — полный цикл от эскиза до рабочей документации'">
    <?php $this->widget('application.modules.mail.widgets.ServicesFormsWidget', [
      'img' => '2.jpg',
    ]); ?>
  </div>

  <!-- Галерея -->
  <section class="svc-page__inner svc-page__gallery-section">
    <div class="svc-section-label">Примеры чертежей</div>
    <div class="svc-gallery svc-gallery--3">
      <a href="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1600&q=85" class="svc-gallery__item" data-fancybox="works"><img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=75" alt="" loading="lazy"></a>
      <a href="https://images.unsplash.com/photo-1565793298595-6a879b1d9492?w=1600&q=85" class="svc-gallery__item" data-fancybox="works"><img src="https://images.unsplash.com/photo-1565793298595-6a879b1d9492?w=600&q=75" alt="" loading="lazy"></a>
      <a href="https://images.unsplash.com/photo-1518709779341-56cf4535e94a?w=1600&q=85" class="svc-gallery__item" data-fancybox="works"><img src="https://images.unsplash.com/photo-1518709779341-56cf4535e94a?w=600&q=75" alt="" loading="lazy"></a>
    </div>
  </section>

</div>
