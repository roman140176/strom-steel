<?php
/**
 * Страница новости «Ребрендинг компании СТРОМ ТРЕЙД».
 * Подключается через поле News.view = 'rebranding' в админке.
 *
 * @var $this  NewsController
 * @var $model News
 */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title . ' | Новости Стром Трейд';
$this->description = $model->meta_description
    ?: $model->title . '. Актуальные новости Стром Трейд о работе компании, примерах работ и производстве металлоконструкций.';
$this->keywords = $model->meta_keywords;

$months = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
$ts = strtotime($model->date);
$dateFormatted = (int)date('j', $ts) . ' ' . $months[(int)date('n', $ts) - 1] . ' ' . date('Y', $ts);

$crumbCurrent = $model->title_short ?: $model->title;
if (function_exists('mb_strlen') && mb_strlen($crumbCurrent) > 60) {
    $crumbCurrent = mb_substr($crumbCurrent, 0, 58) . '…';
}

$crumbs = [
    Yii::app()->createUrl('/') => 'Главная',
    Yii::app()->createUrl('/news/news/index') => 'Новости',
];
?>

<article class="nrb-root">

  <!-- ============ 1. HERO ============ -->
  <section class="nrb-hero">
    <div class="nrb-hero__media" aria-hidden="true"></div>
    <div class="nrb-hero__grid" aria-hidden="true"></div>
    <div class="nrb-container">
      <div class="nrb-hero__inner">
        <div class="nrb-hero__top">

          <nav class="nrb-hero__crumbs" aria-label="breadcrumbs">
            <?php $i = 0; foreach ($crumbs as $url => $label): ?>
              <a href="<?= $url ?>"><?= CHtml::encode($label) ?></a>
              <span class="nrb-hero__crumbs__sep" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
              </span>
            <?php $i++; endforeach; ?>
            <span class="nrb-hero__crumbs__current"><?= CHtml::encode($crumbCurrent) ?></span>
          </nav>

          <span class="nrb-hero__eyebrow">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 11-5.8-1.6"/></svg>
            Новости компании · <?= $dateFormatted ?>
          </span>
          <h1>Ребрендинг компании <span class="nrb-accent">СТРОМ&nbsp;ТРЕЙД</span></h1>
          <p class="nrb-hero__sub">Новый фирменный стиль и новое направление в производстве — от обновлённой визуальной идентичности до запуска линии металлических бордюров.</p>
          <div class="nrb-chips">
            <span class="nrb-chip">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
              Новый логотип
            </span>
            <span class="nrb-chip">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h16v10H4z"/><path d="M4 11h16M9 7v10M15 7v10"/></svg>
              Новое оборудование
            </span>
            <span class="nrb-chip">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 20h18M5 20V8h4v12M15 20V4h4v16"/></svg>
              Металлические бордюры
            </span>
          </div>
        </div>

        <div class="nrb-hero__meta">
          <span class="nrb-hero__meta-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 9h18M8 3v4M16 3v4"/></svg>
            <?= $dateFormatted ?>
          </span>
          <span class="nrb-hero__meta-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 8v4l3 2"/></svg>
            ~3 минуты чтения
          </span>
          <span class="nrb-hero__meta-cat">Корпоративные новости</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ 2. LEAD ============ -->
  <section class="nrb-lead">
    <div class="nrb-container">
      <div class="nrb-lead__inner">
        <span class="nrb-eyebrow">Главное</span>
        <p class="nrb-lead__text">
          В&nbsp;2026&nbsp;году компания «СТРОМ ТРЕЙД» прошла важную веху&nbsp;— провела ребрендинг и&nbsp;одновременно запустила новое направление производства. Обновлённый имидж, включая новый логотип и&nbsp;фирменную цветовую гамму, отражает не&nbsp;косметические перемены, а&nbsp;внутреннюю трансформацию: расширение производственных мощностей, переход к&nbsp;более высоким стандартам качества и&nbsp;запуск выпуска <strong>металлических бордюров</strong>&nbsp;— востребованного решения для городской и&nbsp;промышленной инфраструктуры.
        </p>
      </div>
    </div>
  </section>

  <!-- ============ 3. ЧТО ОБНОВИЛИ ============ -->
  <section class="nrb-features">
    <div class="nrb-container">
      <div class="nrb-features__head">
        <div>
          <span class="nrb-eyebrow">Четыре направления обновления</span>
          <h2>Что мы обновили</h2>
        </div>
        <span class="nrb-features__count"><b>04</b> &nbsp;/&nbsp; направления</span>
      </div>

      <div class="nrb-features__grid">
        <article class="nrb-feature">
          <span class="nrb-feature__num">01</span>
          <div class="nrb-feature__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 3a14 14 0 010 18M12 3a14 14 0 000 18M3 12h18"/></svg>
          </div>
          <h3>Новый образ — новые возможности</h3>
          <p>Обновлённая визуальная идентичность, новый логотип, фирменный сайт и&nbsp;расширенный портфель решений для клиентов.</p>
        </article>

        <article class="nrb-feature">
          <span class="nrb-feature__num">02</span>
          <div class="nrb-feature__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06A1.65 1.65 0 005.5 15a1.65 1.65 0 00-1.51-1H4a2 2 0 010-4h.09A1.65 1.65 0 005.5 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06A1.65 1.65 0 009 4.5 1.65 1.65 0 0010 2.99V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06A1.65 1.65 0 0019.4 9c.36.16.66.45.85.78"/></svg>
          </div>
          <h3>Современное оборудование</h3>
          <p>Инвестиции в&nbsp;станочный парк: новые гибочные и&nbsp;режущие станки, автоматизация ключевых производственных процессов.</p>
        </article>

        <article class="nrb-feature">
          <span class="nrb-feature__num">03</span>
          <div class="nrb-feature__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l8 4v6c0 5-3.5 9.3-8 10-4.5-.7-8-5-8-10V6l8-4z"/><path d="M9 12l2 2 4-4"/></svg>
          </div>
          <h3>Высокие стандарты качества</h3>
          <p>Многоступенчатый контроль на&nbsp;каждом этапе: соответствие ГОСТ, ТУ и&nbsp;собственным внутренним нормативам.</p>
        </article>

        <article class="nrb-feature">
          <span class="nrb-feature__num">04</span>
          <div class="nrb-feature__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
          </div>
          <h3>Надёжный партнёр для бизнеса</h3>
          <p>Гибкие условия сотрудничества, оперативные сроки, индивидуальный подход к&nbsp;проектам любой сложности.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- ============ 4. БОРДЮРЫ ============ -->
  <section class="nrb-product">
    <div class="nrb-container">
      <div class="nrb-product__grid">
        <div class="nrb-product__text">
          <span class="nrb-eyebrow">Новое направление</span>
          <h2>Производство металлических бордюров</h2>
          <p class="nrb-product__lead">
            СТРОМ&nbsp;ТРЕЙД расширил производственные мощности и&nbsp;начал выпуск металлических бордюров&nbsp;— современной альтернативы традиционным бетонным конструкциям. Решение, востребованное в&nbsp;городском благоустройстве, на&nbsp;промышленных площадках и&nbsp;в&nbsp;коммерческой недвижимости.
          </p>
          <ul class="nrb-bullets">
            <li>
              <span class="nrb-bullets__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
              </span>
              <span>
                <span class="nrb-bullets__title">Прочнее бетонных</span>
                <span class="nrb-bullets__desc">Выдерживают экстремальные нагрузки и&nbsp;температурные перепады от&nbsp;–50&nbsp;°C до&nbsp;+60&nbsp;°C.</span>
              </span>
            </li>
            <li>
              <span class="nrb-bullets__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
              </span>
              <span>
                <span class="nrb-bullets__title">Долговечные</span>
                <span class="nrb-bullets__desc">Расчётный срок службы&nbsp;25+&nbsp;лет без потери геометрии и&nbsp;эстетики.</span>
              </span>
            </li>
            <li>
              <span class="nrb-bullets__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
              </span>
              <span>
                <span class="nrb-bullets__title">Устойчивые к&nbsp;коррозии</span>
                <span class="nrb-bullets__desc">Защитное покрытие сохраняет металл от&nbsp;агрессивных воздействий городской среды и&nbsp;реагентов.</span>
              </span>
            </li>
          </ul>
        </div>

        <figure class="nrb-product__media">
          <?php $mainAssets = Yii::app()->controller->mainAssets; ?>
          <img src="<?= $mainAssets ?>/images/two.avif" alt="Металлические бордюры на производстве" loading="lazy" decoding="async">
          <span class="nrb-product__badge">Новинка · 2026</span>
          <figcaption>Производственная линия металлических бордюров, г.&nbsp;Москва</figcaption>
        </figure>
      </div>
    </div>
  </section>

  <!-- ============ 5. СФЕРЫ ПРИМЕНЕНИЯ ============ -->
  <section class="nrb-apps">
    <div class="nrb-container">
      <span class="nrb-eyebrow">Где применяются</span>
      <h3>Сферы применения металлических бордюров</h3>
      <div class="nrb-apps__cloud">
        <span class="nrb-apps__chip">Городское благоустройство</span>
        <span class="nrb-apps__chip">Парковки и&nbsp;стоянки</span>
        <span class="nrb-apps__chip">Дороги и&nbsp;тротуары</span>
        <span class="nrb-apps__chip">Парковые зоны</span>
        <span class="nrb-apps__chip">Набережные</span>
        <span class="nrb-apps__chip">Промышленные площадки</span>
        <span class="nrb-apps__chip">Логистические комплексы</span>
        <span class="nrb-apps__chip">Частные территории</span>
        <span class="nrb-apps__chip">Коммерческая недвижимость</span>
      </div>
    </div>
  </section>

  <!-- ============ 6. ЦИТАТА ============ -->
  <section class="nrb-quote-wrap">
    <div class="nrb-container">
      <blockquote class="nrb-quote">
        <span class="nrb-quote__mark" aria-hidden="true">«</span>
        <span class="nrb-quote__eyebrow">Слово руководителя</span>
        <p class="nrb-quote__text">
          Ребрендинг для нас&nbsp;— это не&nbsp;просто изменение визуала, а&nbsp;отражение внутренней трансформации. Приобретение нового оборудования и&nbsp;запуск нового производства свидетельствуют о&nbsp;переходе к&nbsp;более высоким стандартам качества и&nbsp;расширении наших услуг. Мы&nbsp;стремимся предложить клиентам надёжные решения, отвечающие современным требованиям рынка.
        </p>
        <div class="nrb-quote__author">
          <span class="nrb-quote__avatar">АР</span>
          <span>
            <span class="nrb-quote__name">Александр Родионов</span>
            <span class="nrb-quote__role">Генеральный директор СТРОМ&nbsp;ТРЕЙД</span>
          </span>
        </div>
      </blockquote>
    </div>
  </section>

  <!-- ============ 7. STATS ============ -->
  <section class="nrb-stats">
    <div class="nrb-container">
      <div class="nrb-stats__head">
        <span class="nrb-eyebrow">Что стоит за&nbsp;ребрендингом</span>
        <h2>Цифры, которые говорят за&nbsp;нас</h2>
      </div>
      <div class="nrb-stats__row">
        <div class="nrb-stat">
          <span class="nrb-stat__index">01</span>
          <div class="nrb-stat__num">10<small>+&nbsp;лет</small></div>
          <div class="nrb-stat__label">на&nbsp;рынке металлоконструкций</div>
        </div>
        <div class="nrb-stat">
          <span class="nrb-stat__index">02</span>
          <div class="nrb-stat__num">85<small>+</small></div>
          <div class="nrb-stat__label">регионов доставки по&nbsp;РФ</div>
        </div>
        <div class="nrb-stat">
          <span class="nrb-stat__index">03</span>
          <div class="nrb-stat__num">7<small>+</small></div>
          <div class="nrb-stat__label">направлений изделий из&nbsp;металла</div>
        </div>
        <div class="nrb-stat">
          <span class="nrb-stat__index">04</span>
          <div class="nrb-stat__num">25<small>+&nbsp;лет</small></div>
          <div class="nrb-stat__label">расчётный срок службы металлических бордюров</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ 8. CTA ============ -->
  <section class="nrb-cta-wrap">
    <div class="nrb-container">
      <div class="nrb-cta">
        <div class="nrb-cta__inner">
          <div>
            <span class="nrb-cta__eyebrow">Обсудим сотрудничество</span>
            <h2>Узнайте больше о&nbsp;новых возможностях</h2>
            <p class="nrb-cta__desc">
              Свяжитесь с&nbsp;менеджерами отдела продаж&nbsp;— расскажем подробнее о&nbsp;металлических бордюрах, обсудим условия партнёрства и&nbsp;предложим решение под&nbsp;ваш проект.
            </p>
          </div>
          <div class="nrb-cta__actions">
            <a href="#CallbackFormEmail" class="nrb-btn nrb-btn--primary" data-toggle="modal">
              <span>Оставить заявку</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
            </a>
            <a href="tel:+74956643517" class="nrb-btn nrb-btn--outline">
              <span>+7 (495) 664-35-17</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
            </a>
            <p class="nrb-cta__email">
              или e-mail: <a href="mailto:info@stromsteel.ru">info@stromsteel.ru</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ BACK LINK ============ -->
  <nav class="nrb-back">
    <div class="nrb-container">
      <a href="<?= Yii::app()->createUrl('/news/news/index') ?>" class="nrb-back__link">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Все новости
      </a>
    </div>
  </nav>

</article>
