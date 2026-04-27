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

  <?php $this->renderPartial('_services_nav', ['current' => 'montazh-i-shef-montazh']); ?>

  <!-- Сплит-хиро: два панеля рядом — Монтаж и Шеф-монтаж -->
  <div class="svc-split-hero">
    <div class="svc-hero-panel svc-hero-panel--dark">
      <div>
        <div class="svc-hero-panel__tag">Услуга 1</div>
        <h1 class="svc-hero-panel__title">Монтаж изделий<br>на объекте</h1>
        <p class="svc-hero-panel__desc">Специалисты нашей компании выполняют монтажные работы с учётом специфики каждого объекта и конструкции по индивидуальным планам.</p>
      </div>
      <div class="svc-hero-panel__badge">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63"/></svg>
        Собственные специалисты
      </div>
    </div>
    <div class="svc-hero-panel svc-hero-panel--green">
      <div>
        <div class="svc-hero-panel__tag">Услуга 2</div>
        <h2 class="svc-hero-panel__title">Шеф-монтаж —<br>контроль и надзор</h2>
        <p class="svc-hero-panel__desc">Оперативное руководство и контроль квалифицированными специалистами «СТРОМ ТРЕЙД» над выполнением монтажных работ силами заказчика.</p>
      </div>
      <div class="svc-hero-panel__badge">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
        Акт сдачи-приёмки
      </div>
    </div>
  </div>

  <main class="svc-page__inner svc-page__main">

    <!-- Что влияет на стоимость -->
    <section class="svc-card">
      <div class="svc-card__head">
        <div class="svc-card__head-icon svc-card__head-icon--dark">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h2>Что влияет на стоимость монтажа</h2>
      </div>
      <div class="svc-card__body">
        <div class="svc-cost-factors">
          <div class="svc-cost-factor">
            <div class="svc-cost-factor__ico">
              <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
            </div>
            <h3 class="svc-cost-factor__title">Сложность</h3>
            <p class="svc-cost-factor__desc">Небольшие и лёгкие конструкции дешевле промышленных масштабов</p>
          </div>
          <div class="svc-cost-factor">
            <div class="svc-cost-factor__ico">
              <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/></svg>
            </div>
            <h3 class="svc-cost-factor__title">Метраж</h3>
            <p class="svc-cost-factor__desc">Чем больше площадь объекта, тем меньше затраты на 1 кв. м</p>
          </div>
          <div class="svc-cost-factor">
            <div class="svc-cost-factor__ico">
              <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 3v1m0 16v1M4.22 4.22l.707.707m12.02 12.02l.707.707M1 12h1m20 0h1M4.22 19.78l.707-.707M18.95 5.05l.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="svc-cost-factor__title">Вес</h3>
            <p class="svc-cost-factor__desc">Общая масса влияет на окончательную калькуляцию возводимой конструкции</p>
          </div>
          <div class="svc-cost-factor">
            <div class="svc-cost-factor__ico">
              <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
            </div>
            <h3 class="svc-cost-factor__title">Расположение</h3>
            <p class="svc-cost-factor__desc">Учитываются транспортные расходы и административное местоположение объекта</p>
          </div>
          <div class="svc-cost-factor">
            <div class="svc-cost-factor__ico">
              <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63"/></svg>
            </div>
            <h3 class="svc-cost-factor__title">Спецтехника</h3>
            <p class="svc-cost-factor__desc">Необходимость использования механизации процесса сборки</p>
          </div>
        </div>
      </div>
    </section>

    <!-- 9 этапов монтажа -->
    <section class="svc-card">
      <div class="svc-card__head">
        <div class="svc-card__head-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
        </div>
        <h2>9 этапов монтажа</h2>
        <span class="svc-card__head-label">От проекта до готового объекта</span>
      </div>
      <div class="svc-card__body">
        <div class="svc-process-flow">
          <div class="svc-process-step is-done"><div class="svc-process-step__num">1</div><div class="svc-process-step__label">Разработка чертежей</div></div>
          <div class="svc-process-step is-done"><div class="svc-process-step__num">2</div><div class="svc-process-step__label">Производство конструкций</div></div>
          <div class="svc-process-step is-done"><div class="svc-process-step__num">3</div><div class="svc-process-step__label">Контроль качества на производстве</div></div>
          <div class="svc-process-step is-done"><div class="svc-process-step__num">4</div><div class="svc-process-step__label">Согласование с заказчиком</div></div>
          <div class="svc-process-step is-done"><div class="svc-process-step__num">5</div><div class="svc-process-step__label">Транспортировка на объект</div></div>
          <div class="svc-process-step is-done"><div class="svc-process-step__num">6</div><div class="svc-process-step__label">Подготовка элементов к монтажу</div></div>
          <div class="svc-process-step is-done"><div class="svc-process-step__num">7</div><div class="svc-process-step__label">Подъём элементов к месту установки</div></div>
          <div class="svc-process-step is-done"><div class="svc-process-step__num">8</div><div class="svc-process-step__label">Установка и закрепление</div></div>
          <div class="svc-process-step is-active"><div class="svc-process-step__num">9</div><div class="svc-process-step__label">Проверка конструкции</div></div>
        </div>

        <div class="svc-results-row">
          <div class="svc-result">
            <div class="svc-result__check"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M4.5 12.75l6 6 9-13.5"/></svg></div>
            <div class="svc-result__text"><strong>Профессиональное исполнение</strong>Монтаж специалистами высокой квалификации</div>
          </div>
          <div class="svc-result">
            <div class="svc-result__check"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M4.5 12.75l6 6 9-13.5"/></svg></div>
            <div class="svc-result__text"><strong>Строгое соответствие проекту</strong>Монтаж выполняется в соответствии с утверждённой документацией</div>
          </div>
          <div class="svc-result">
            <div class="svc-result__check"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M4.5 12.75l6 6 9-13.5"/></svg></div>
            <div class="svc-result__text"><strong>Полный пакет документов</strong>Работа производится на основании всей необходимой разрешительной документации: сертификаты, свидетельства, протоколы</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Шеф-монтаж -->
    <section class="svc-card svc-card--accent">
      <div class="svc-card__head">
        <div class="svc-card__head-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
        </div>
        <h2>Шеф-монтаж от «СТРОМ ТРЕЙД»</h2>
      </div>
      <div class="svc-card__body">
        <p class="svc-intro"><strong>Шеф-монтаж</strong> — это оперативное руководство и контроль квалифицированными специалистами «СТРОМ ТРЕЙД» над выполнением монтажных работ силами привлечённых специалистов или собственными силами заказчика. Включает инструктаж персонала, оперативное управление работами и итоговую проверку качества.</p>

        <div class="svc-shef-steps">
          <div class="svc-shef-step">
            <div class="svc-shef-step__num">1</div>
            <div class="svc-shef-step__body">
              <h3 class="svc-shef-step__title">Оформление заявки и согласование</h3>
              <p class="svc-shef-step__desc">Проработка специалистами «СТРОМ ТРЕЙД» деталей проекта и согласование с заказчиком объёмов и графика работ. Заключение договора.</p>
            </div>
          </div>
          <div class="svc-shef-step">
            <div class="svc-shef-step__num">2</div>
            <div class="svc-shef-step__body">
              <h3 class="svc-shef-step__title">Выезд специалистов на объект</h3>
              <p class="svc-shef-step__desc">Выезд специалистов нашей компании на объект для оказания услуги шеф-монтажа.</p>
            </div>
          </div>
          <div class="svc-shef-step">
            <div class="svc-shef-step__num">3</div>
            <div class="svc-shef-step__body">
              <h3 class="svc-shef-step__title">Инструктаж, контроль и приёмка</h3>
              <p class="svc-shef-step__desc">Инструктаж специалистов заказчика, общетехнический и технологический контроль за ходом работ, итоговый контроль качества и составление акта сдачи-приёмки.</p>
            </div>
          </div>
        </div>

        <div class="svc-results-row">
          <div class="svc-result">
            <div class="svc-result__check"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M4.5 12.75l6 6 9-13.5"/></svg></div>
            <div class="svc-result__text"><strong>Готовое к эксплуатации изделие</strong>Установленное и полностью готовое к работе</div>
          </div>
          <div class="svc-result">
            <div class="svc-result__check"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M4.5 12.75l6 6 9-13.5"/></svg></div>
            <div class="svc-result__text"><strong>Выявленные неточности</strong>Возможные ошибки в процессе подготовки изделия к монтажу устранены</div>
          </div>
          <div class="svc-result">
            <div class="svc-result__check"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M4.5 12.75l6 6 9-13.5"/></svg></div>
            <div class="svc-result__text"><strong>Минимизированы риски</strong>Снижены затраты на монтаж и дальнейшую эксплуатацию изделия</div>
          </div>
        </div>

        <div class="svc-notice">
          <div class="svc-notice__ico">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
          </div>
          <p>Профессионально выполненные шеф-монтажные работы — это возможность <strong>предотвратить ошибки и нарушения</strong> при выполнении монтажа изделия на объекте, и как следствие, <strong>повышение качества и долговечности изделия.</strong></p>
        </div>
      </div>
    </section>

  </main>

  <!-- Форма (существующий виджет, маска телефона не трогаем). -->
  <div class="svc-page__form page-services" style="--photo-caption: ''">
    <?php $this->widget('application.modules.mail.widgets.ServicesFormsWidget', [
      'img' => '3.jpg',
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
