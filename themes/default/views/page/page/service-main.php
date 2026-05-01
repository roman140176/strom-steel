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

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
Yii::app()->clientScript->registerCssFile($mainAssets . '/css/uslugi.css');
?>

<div class="svh-page">

  <!-- 1. BREADCRUMBS -->
  <nav class="svh-crumbs" aria-label="Хлебные крошки">
    <div class="svh-crumbs__inner">
      <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', ['links' => $this->breadcrumbs]); ?>
    </div>
  </nav>

  <main>

    <!-- 2. HERO -->
    <section class="svh-hero" aria-labelledby="svh-hero-title">
      <div class="svh-hero__inner">
        <div class="svh-hero__main">
          <div class="svh-hero__eyebrow">Услуги компании</div>
          <h1 id="svh-hero-title">Полный цикл работ <em>с металлоконструкциями</em></h1>
          <p class="svh-hero__lead">
            «СТРОМ ТРЕЙД» проектирует и производит металлоконструкции любой
            сложности — типовые решения и индивидуальные проекты. Сопровождаем
            клиентов на всех этапах: от разработки идеи до монтажа на объекте.
          </p>
          <div class="svh-hero__chips">
            <span class="svh-chip"><span class="svh-chip__dot"></span>Производство в Подмосковье</span>
            <span class="svh-chip"><span class="svh-chip__dot"></span>ГОСТ&nbsp;/&nbsp;ТУ&nbsp;/&nbsp;ОСТ</span>
            <span class="svh-chip"><span class="svh-chip__dot"></span>Доставка в 85+ регионов РФ</span>
          </div>
          <div class="svh-hero__stats">
            <div class="svh-stat">
              <div class="svh-stat__num"><em>7+</em></div>
              <div class="svh-stat__label">направлений<br>изделий</div>
            </div>
            <div class="svh-stat">
              <div class="svh-stat__num">1–2 <em>дня</em></div>
              <div class="svh-stat__label">доставка<br>по Москве</div>
            </div>
            <div class="svh-stat">
              <div class="svh-stat__num"><em>85+</em></div>
              <div class="svh-stat__label">регионов<br>РФ</div>
            </div>
          </div>
        </div>

        <aside class="svh-hero__cta" aria-label="Контакт">
          <span class="svh-hero__cta-label">Связаться с нами</span>
          <a href="#" class="svh-btn svh-btn--primary" data-target="#CallbackFormEmail" data-toggle="modal">
            <span>Оставить заявку</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="16" height="16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
          <a href="tel:+74956643517" class="svh-btn svh-btn--ghost-dark svh-btn--phone">
            <span class="svh-btn__phone-sub">Прямой телефон</span>
            <span class="svh-btn__phone-num">+7 (495) 664-35-17</span>
          </a>
        </aside>
      </div>
    </section>

    <!-- 3. PROCESS FLOW -->
    <section class="svh-section svh-section--tight" aria-labelledby="svh-flow-title">
      <div class="svh-container">
        <div class="svh-section__head">
          <div>
            <span class="svh-eyebrow">Как мы работаем</span>
            <h2 class="svh-section__title" id="svh-flow-title">Полный цикл — от чертежа до готового объекта</h2>
          </div>
          <p class="svh-section__sub">Сшиваем 5 направлений услуг в единую цепочку. Один договор, одна ответственность, прозрачные сроки на каждом этапе.</p>
        </div>

        <ol class="svh-flow">
          <div class="svh-flow__line" aria-hidden="true"></div>
          <li class="svh-flow__step">
            <div class="svh-flow__num">1</div>
            <div class="svh-flow__title">Чертежи и КМД</div>
            <div class="svh-flow__hint">3D-моделирование, 7 этапов</div>
          </li>
          <li class="svh-flow__step">
            <div class="svh-flow__num">2</div>
            <div class="svh-flow__title">Лазерная резка / производство</div>
            <div class="svh-flow__hint">Сталь, латунь, алюминий, медь</div>
          </li>
          <li class="svh-flow__step">
            <div class="svh-flow__num">3</div>
            <div class="svh-flow__title">Контроль качества</div>
            <div class="svh-flow__hint">ГОСТ / ТУ / ОСТ</div>
          </li>
          <li class="svh-flow__step">
            <div class="svh-flow__num">4</div>
            <div class="svh-flow__title">Доставка</div>
            <div class="svh-flow__hint">1–2 дня по Москве, 85+ регионов</div>
          </li>
          <li class="svh-flow__step">
            <div class="svh-flow__num">5</div>
            <div class="svh-flow__title">Монтаж и шеф-монтаж</div>
            <div class="svh-flow__hint">Свои бригады или контроль</div>
          </li>
        </ol>
      </div>
    </section>

    <!-- 4. BENTO SERVICES -->
    <section class="svh-section" aria-labelledby="svh-bento-title">
      <div class="svh-container">
        <div class="svh-section__head">
          <div>
            <span class="svh-eyebrow">Каталог направлений</span>
            <h2 class="svh-section__title" id="svh-bento-title">Наши услуги</h2>
          </div>
          <p class="svh-section__sub">Каждая услуга — самостоятельное направление с детальной страницей, спецификациями и описанием технологического процесса.</p>
        </div>

        <div class="svh-bento">

          <!-- Flagship -->
          <article class="svh-card svh-card--flagship">
            <span class="svh-card__number">01 / 05</span>
            <div class="svh-card__icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 21V8l9-5 9 5v13"/>
                <path d="M3 21h18"/>
                <path d="M9 21v-7h6v7"/>
                <path d="M9 11h6"/>
              </svg>
            </div>
            <h3 class="svh-card__title">Изготовление металлоконструкций</h3>
            <p class="svh-card__desc">
              Производим типовые и индивидуальные металлоизделия любой сложности.
              Собственное оборудование, инженерный отдел, контроль на всех этапах
              производственного цикла.
            </p>
            <div class="svh-card__chips">
              <span class="svh-card__chip">Лестницы</span>
              <span class="svh-card__chip">Опоры</span>
              <span class="svh-card__chip">Площадки обслуживания</span>
              <span class="svh-card__chip">Ограждения</span>
              <span class="svh-card__chip">Закладные детали</span>
              <span class="svh-card__chip">Индивидуальные изделия</span>
            </div>
            <div class="svh-card__bottom">
              <div class="svh-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                Производство в Подмосковье
              </div>
              <a href="<?= Yii::app()->createUrl('page/page/view', ['slug' => 'izgotovlenie-metallokonstrukciy']) ?>" class="svh-card__link">
                Подробнее
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </a>
            </div>
          </article>

          <!-- Drawings -->
          <article class="svh-card svh-card--md">
            <div class="svh-card__icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2"/>
                <path d="M3 9h18M9 21V9"/>
                <path d="M13 14h5M13 17h3"/>
              </svg>
            </div>
            <h3 class="svh-card__title">Разработка чертежей и КМД</h3>
            <p class="svh-card__desc">
              3D-моделирование по ГОСТ, работа в Компас 3D и AutoCAD. От технического задания до полного комплекта рабочих чертежей.
            </p>
            <div class="svh-card__meta"><span class="svh-card__meta-dot"></span>7 этапов разработки</div>
            <a href="<?= Yii::app()->createUrl('page/page/view', ['slug' => 'razrabotka-chertezhey-i-kmd']) ?>" class="svh-card__link">
              Подробнее
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          </article>

          <!-- Mounting -->
          <article class="svh-card svh-card--md">
            <div class="svh-card__icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14.7 6.3a4 4 0 0 0-5.7 5.7L3 18l3 3 6-6a4 4 0 0 0 5.7-5.7l-2.5 2.5-2.5-2.5 2.5-2.5z"/>
              </svg>
            </div>
            <h3 class="svh-card__title">Монтаж и шеф-монтаж</h3>
            <p class="svh-card__desc">
              Собственные специалисты или контроль работ силами заказчика.
              Полный цикл от приёмки чертежей до сдачи готового объекта.
            </p>
            <div class="svh-card__meta"><span class="svh-card__meta-dot"></span>9 этапов работ</div>
            <a href="<?= Yii::app()->createUrl('page/page/view', ['slug' => 'montazh-i-shef-montazh']) ?>" class="svh-card__link">
              Подробнее
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          </article>

          <!-- Laser -->
          <article class="svh-card svh-card--md">
            <div class="svh-card__icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M13 2 4 14h7l-1 8 9-12h-7l1-8z"/>
              </svg>
            </div>
            <h3 class="svh-card__title">Лазерная резка</h3>
            <p class="svh-card__desc">
              Высокая точность реза по любым металлам — сталь, латунь,
              алюминий, медь. Онлайн-калькулятор стоимости работ на сайте.
            </p>
            <div class="svh-card__meta"><span class="svh-card__meta-dot"></span>Онлайн-калькулятор</div>
            <a href="<?= Yii::app()->createUrl('page/page/view', ['slug' => 'lazernaya-rezka']) ?>" class="svh-card__link">
              Подробнее
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          </article>

          <!-- Delivery -->
          <article class="svh-card svh-card--md">
            <div class="svh-card__icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 7h13v10H1zM14 10h5l3 3v4h-8z"/>
                <circle cx="6" cy="18" r="2"/>
                <circle cx="18" cy="18" r="2"/>
              </svg>
            </div>
            <h3 class="svh-card__title">Доставка</h3>
            <p class="svh-card__desc">
              1–2 дня по Москве, 85+ регионов РФ. Автотранспортом
              компании или самовывоз со склада в Подольске.
            </p>
            <div class="svh-card__meta"><span class="svh-card__meta-dot"></span>Авто или самовывоз</div>
            <a href="<?= Yii::app()->createUrl('page/page/view', ['slug' => 'dostavka']) ?>" class="svh-card__link">
              Подробнее
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          </article>

        </div>
      </div>
    </section>

    <!-- 5. WHY US -->
    <section class="svh-section svh-section--tight svh-section--white" aria-labelledby="svh-why-title">
      <div class="svh-container">
        <div class="svh-section__head">
          <div>
            <span class="svh-eyebrow">Преимущества</span>
            <h2 class="svh-section__title" id="svh-why-title">Почему выбирают СТРОМ ТРЕЙД</h2>
          </div>
          <p class="svh-section__sub">Свод преимуществ из всех направлений услуг — от проектирования до монтажа.</p>
        </div>

        <div class="svh-why">
          <div class="svh-why__item">
            <div class="svh-why__num">01</div>
            <div class="svh-why__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7" rx="1"/>
                <rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/>
                <rect x="14" y="14" width="7" height="7" rx="1"/>
              </svg>
            </div>
            <h3 class="svh-why__title">Комплексный подход</h3>
            <p class="svh-why__desc">От эскиза до монтажа на объекте — все этапы выполняем в одной компании.</p>
          </div>

          <div class="svh-why__item">
            <div class="svh-why__num">02</div>
            <div class="svh-why__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 12 11 14l4-4"/>
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
              </svg>
            </div>
            <h3 class="svh-why__title">Соответствие нормативам</h3>
            <p class="svh-why__desc">ГОСТ, ТУ, ОСТ. Контроль качества на каждом производственном этапе.</p>
          </div>

          <div class="svh-why__item">
            <div class="svh-why__num">03</div>
            <div class="svh-why__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
              </svg>
            </div>
            <h3 class="svh-why__title">Профессиональное оборудование</h3>
            <p class="svh-why__desc">Высокотехнологичное производство в Подмосковье, собственный парк оборудования.</p>
          </div>

          <div class="svh-why__item">
            <div class="svh-why__num">04</div>
            <div class="svh-why__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
              </svg>
            </div>
            <h3 class="svh-why__title">Доступные цены и бонусы</h3>
            <p class="svh-why__desc">Прозрачное обоснование стоимости, скидки постоянным клиентам.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- 6. PAY & LOGISTICS -->
    <section class="svh-section svh-section--tight" aria-labelledby="svh-pay-title">
      <div class="svh-container">
        <div class="svh-section__head">
          <div>
            <span class="svh-eyebrow">Условия работы</span>
            <h2 class="svh-section__title" id="svh-pay-title">Оплата и доставка</h2>
          </div>
          <p class="svh-section__sub">Работаем с физлицами и юрлицами. Доставляем по Москве, отправляем в регионы транспортными компаниями.</p>
        </div>

        <div class="svh-pay">
          <div class="svh-pay__col">
            <div class="svh-pay__head">
              <div class="svh-pay__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="2" y="5" width="20" height="14" rx="2"/>
                  <path d="M2 10h20M6 15h4"/>
                </svg>
              </div>
              <div>
                <div class="svh-pay__title">Оплата</div>
                <div class="svh-pay__sub">Для физических и юридических лиц</div>
              </div>
            </div>
            <div class="svh-pay__list">
              <div class="svh-pay__row">
                <div class="svh-pay__row-label">Физлица</div>
                <div class="svh-pay__row-value">Наличный расчёт в офисе или банковский перевод по реквизитам.</div>
              </div>
              <div class="svh-pay__row">
                <div class="svh-pay__row-label">Юрлица</div>
                <div class="svh-pay__row-value">Безналичный расчёт по договору; наличный приём в офисе компании.</div>
              </div>
            </div>
          </div>

          <div class="svh-pay__col">
            <div class="svh-pay__head">
              <div class="svh-pay__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 7h13v10H1zM14 10h5l3 3v4h-8z"/>
                  <circle cx="6" cy="18" r="2"/>
                  <circle cx="18" cy="18" r="2"/>
                </svg>
              </div>
              <div>
                <div class="svh-pay__title">Доставка</div>
                <div class="svh-pay__sub">Москва, регионы, самовывоз</div>
              </div>
            </div>
            <div class="svh-pay__list">
              <div class="svh-pay__row">
                <div class="svh-pay__row-label">Автотранспортом</div>
                <div class="svh-pay__row-value">1–2 дня по Москве и МО. В регионы — отправка проверенными транспортными компаниями.</div>
              </div>
              <div class="svh-pay__row">
                <div class="svh-pay__row-label">Самовывоз</div>
                <div class="svh-pay__row-value">МО, г. Подольск, мкр. Львовский, проезд Металлургов&nbsp;3Г.</div>
              </div>
            </div>
          </div>
        </div>

        <div class="svh-pay__more-wrap">
          <a href="<?= Yii::app()->createUrl('page/page/view', ['slug' => 'dostavka']) ?>" class="svh-pay__more">
            Подробнее о доставке
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
      </div>
    </section>

    <!-- 7. CTA + 8. TRUST STRIP -->
    <section class="svh-section svh-section--tight">
      <div class="svh-container">
        <div class="svh-cta">
          <div class="svh-cta__main">
            <div class="svh-eyebrow svh-cta__eyebrow">Обсудим ваш проект</div>
            <h2>Бесплатная консультация и расчёт</h2>
            <p class="svh-cta__desc">
              Свяжитесь с нами — обсудим задачу и предложим оптимальное решение
              по срокам, материалам и стоимости. Постоянным клиентам — бонусы и скидки.
            </p>
          </div>
          <div class="svh-cta__contact">
            <div>
              <div class="svh-cta__phone-label">Телефон отдела продаж</div>
              <a href="tel:+74956643517" class="svh-cta__phone">+7 (495) 664-35-17</a>
            </div>
            <a href="#" class="svh-btn svh-btn--primary" data-target="#CallbackFormEmail" data-toggle="modal">
              <span>Оставить заявку</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="16" height="16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
            <div class="svh-cta__email">
              E-mail: <a href="mailto:info@stromsteel.ru">info@stromsteel.ru</a>
            </div>
          </div>
        </div>

        <!-- 8. Trust strip -->
        <div class="svh-trust">
          <div class="svh-trust__item">
            <div class="svh-trust__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="m22 11-3 3-2-2"/>
              </svg>
            </div>
            <div class="svh-trust__text">Опытные специалисты</div>
          </div>
          <div class="svh-trust__item">
            <div class="svh-trust__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 21V8l9-5 9 5v13"/>
                <path d="M3 21h18M9 21v-7h6v7"/>
              </svg>
            </div>
            <div class="svh-trust__text">Собственное производство</div>
          </div>
          <div class="svh-trust__item">
            <div class="svh-trust__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                <path d="m9 12 2 2 4-4"/>
              </svg>
            </div>
            <div class="svh-trust__text">ГОСТ-качество</div>
          </div>
          <div class="svh-trust__item">
            <div class="svh-trust__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <path d="M2 12h20M12 2a15 15 0 0 1 4 10 15 15 0 0 1-4 10 15 15 0 0 1-4-10 15 15 0 0 1 4-10z"/>
              </svg>
            </div>
            <div class="svh-trust__text">Доставка по РФ</div>
          </div>
        </div>
      </div>
    </section>

  </main>
</div>
