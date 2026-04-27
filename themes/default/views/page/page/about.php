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
<div class="pageMainContent">
  <div class="container breadcrumbs-container">
    <?php $this->widget(
      'bootstrap.widgets.TbBreadcrumbs',
      [
        'links' => $this->breadcrumbs,
      ]
    ); ?>
  </div>
  <div class="container page-services">
    <h1 class="page_title"><?= $model->title; ?></h1>
    <div class="untitle">
      <b>Компания «СТРОМ ТРЕЙД»</b> — это торгово-производственное объединение по изготовлению изделий из металла любой сложности. Нашим заказчикам мы можем предложить как типовые изделия из металла, так и изделия, выполненные по индивидуальным проектам в соответствии с требованиями клиентов.
    </div>
    <h3>
      Ассортимент нашей компании:
    </h3>
    <div class="company-production-list">   
      <div class="cpl__item">
        <div class="cpl__item-head">
          Элементы из нержавеющей стали
        </div>
        <ul class="cpl__item-list">
          <li>
            стандартные и щелевые лотки
          </li>
          <li>
            трапы с горизонтальным и вертикальным выпусками
          </li>
          <li>
            мебель и оборудование для гигиены
          </li>
        </ul>
      </div>
      <div class="cpl__item">
        <div class="cpl__item-head">
          Металлические настилы
        </div>
        <ul class="cpl__item-list">
          <li>
            сварные решетчатые настилы
          </li>
          <li>
            прессованные решетчатые настилы
          </li>
          <li>
            лестничные ступени
          </li>
        </ul>
      </div>
      <div class="cpl__item">
        <div class="cpl__item-head">
          Системы грязезащиты
        </div>
        <ul class="cpl__item-list">
          <li>
            стальные оцинкованные решётки
          </li>
          <li>
            придверные ковры на алюминиевой основе
          </li>
        </ul>
      </div>
      <div class="cpl__item">
        <div class="cpl__item-head">
          Металлоконструкции под заказ
        </div>
        <ul class="cpl__item-list">
          <li>
            лестницы
          </li>
          <li>
            опоры
          </li>
          <li>
            площадки обслуживания
          </li>
          <li>
            ограждения
          </li>
          <li>
            закладные
          </li>
        </ul>
      </div>   
    </div>
  </div>

  <div class="container page-services">
    <h3>
      Услуги, предоставляемые компанией «СТРОМ ТРЕЙД:
    </h3>
    <div class="strange-block">
      <div class="strange-block_item" id="item1">
        <?= CHtml::image(Yii::app()->controller->mainAssets . '/images/page/about/3.jpg') ?>
        <p>Изготовление металлоконструкций любой сложности по индивидуальным чертежам.</p>
      </div>
      <div class="strange-block_item" id="item2">
        <?= CHtml::image(Yii::app()->controller->mainAssets . '/images/page/about/7.jpg') ?>
        <p>Разработка чертежей изделий в 3D, схем и чертежей КМД.</p>
      </div>
      <div class="strange-block_item" id="item3">
        <?= CHtml::image(Yii::app()->controller->mainAssets . '/images/page/about/6.jpg') ?>
        <p>Монтаж изделий на объекте заказчика. <br>
          Шефмонтаж под руководством технических специалистов.</p>
      </div>
      <div class="strange-block_item" id="item4">
        <?= CHtml::image(Yii::app()->controller->mainAssets . '/images/page/about/4.jpg') ?>
        <p>Оперативная доставка удобным для вас способом</p>
      </div>
      <div class="strange-block_item" id="item5">
        <?= CHtml::image(Yii::app()->controller->mainAssets . '/images/page/about/5.jpg') ?>
        <p>Высокоточная лазерная резка по чертежам заказчика.</p>
      </div>
    </div>
  </div>

  <div class="container page-services">
    <h3>Наши ценности</h3>
  </div>
  <div class="container container-value d-flex page-services">
    <div class="cv__item">
      <div class="cv__num">1</div>
      <div class="cv__head">Мы предлагаем комплексные решения:</div>
      <div class="cv__content">
        <div class="cv__content-grid">
          <ul>
            <li>
              разработка чертежей
            </li>
            <li>
              подбор материала
            </li>
            <li>
              изготовление изделия
            </li>
            <li>
              доставка
            </li>
            <li>
              монтаж
            </li>
            <li>
              гарантии
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="cv__item">
      <div class="cv__num">2</div>
      <div class="cv__head">Ответственное отношение к заказчику</div>
      <div class="cv__content">
        Обещаем только то, что можем выполнить! Наше согласие — это обязательство выполнить достигнутые устные или письменные договорённости.
      </div>
    </div>
    <div class="cv__item">
      <div class="cv__num">3</div>
      <div class="cv__head">Надежный производитель</div>
      <div class="cv__content">
        В производстве используем передовые технологии. Все изделия соответствуют установленным ГОСТам и отвечают заявленным характеристикам.
      </div>
    </div>
    <div class="cv__item">
      <div class="cv__num">4</div>
      <div class="cv__head">Ориентированность на клиента</div>
      <div class="cv__content">
        Мы всегда рядом с нашими заказчиками, осуществляем подготовку проектных решений, обеспечиваем высокий уровень сервиса и технической поддержки проектов.
      </div>
    </div>
  </div>

  <div class="container page-services">
    <div class="info-block">
      <div class="info">
        В компании работает опытный персонал, сочетающий в себе профессиональные качества и увлечённость делом, который в процессе сделки обеспечит вам высокий уровень сервиса, окажет всю необходимую техническую поддержку и реализует наиболее эффективные решения поставленных задач.
      </div>
      <div class="image">
        <?= CHtml::image(Yii::app()->controller->mainAssets . '/images/page/about/1.jpg') ?>
      </div>
    </div>
    <div class="form-block">
      <div class="image">
        <?= CHtml::image(Yii::app()->controller->mainAssets . '/images/page/about/2.jpg') ?>
      </div>
      <div class="info">
        Если в нашем каталоге не нашлось подходящих изделий, вы можете предложить свой собственный вариант решения проблемы — предоставить индивидуальный проект, по которому будут работать наши высококвалифицированные инженеры и разработают под вас изделия.
        <a href="#" class="info-btn js-button" data-target="#CallbackFormEmail" data-toggle="modal">
          Отправить заявку
          <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
            <path d="M12.5303 6.53033C12.8232 6.23744 12.8232 5.76256 12.5303 5.46967L7.75736 0.696699C7.46447 0.403806 6.98959 0.403806 6.6967 0.696699C6.40381 0.989593 6.40381 1.46447 6.6967 1.75736L10.9393 6L6.6967 10.2426C6.40381 10.5355 6.40381 11.0104 6.6967 11.3033C6.98959 11.5962 7.46447 11.5962 7.75736 11.3033L12.5303 6.53033ZM0 6.75H12V5.25H0V6.75Z" fill="#1B4E9B" />
          </svg>
        </a>
      </div>
    </div>
  </div>

  <!-- <div class="container container-thums d-flex posrel">
    <div class="ct__left">
      <div class="ct__left-absolute abs">
        Обратившись в ООО ПК «СТРОМ СТИЛ», <span>Вы получите:</span>
      </div>
      <ol>
        <li>Изготовление продукции по проектной документации заказчика. </li>
        <li>Эскизный проект и разработку КМД. </li>
        <li>Индивидуальную техническую консультацию.</li>
        <li>Подбор материалов и составление спецификации согласно вашему проекту. </li>
        <li>Рекомендации и подробные схемы по монтажу и эксплуатации от производителей.</li>
        <li>Оперативную доставку удобным для вас способом.</li>
        <li>Шефмонтаж.</li>
        <li>Заводскую гарантию на оборудование. </li>
      </ol>
    </div>
    <div class="ct__right posrel">
      <?= CHtml::image($model->getImageUrl(675, 400, true, null, "image"), Yii::app()->getModule('yupe')->siteName, ['']) ?>
      <div class="text__right abs">
        ШЕФМОНТАЖ
      </div>
    </div>
  </div>
  <div class="container container-thums-bottom posrel d-flex">
    <div class="ctb__left">
      <div class="ctb_absolute-bg abs"></div>
      <div class="layer-img abs">
        <?= CHtml::image($this->mainAssets . '/images/page/ob.jpg') ?>
      </div>
      <?= CHtml::image($model->getImageUrl(652, 387, true, null, "icon"), Yii::app()->getModule('yupe')->siteName, ['class' => 'ctb__img']) ?>
    </div>
    <div class="ctb__right">
      <div class="ctb__header">
        <span>Преимущества оборудования,</span> <br>приобретаемого у «ПК «СТРОМ СТИЛ»:
      </div>
      <ol>
        <li><span>Качество</span> оборудования подтверждено сертификатами соответствия ГОССТАНДАРТА России</li>
        <li>Оборудование изготавливается по <span>европейским стандартам</span> качества с учетом особенностей <span>российских климатических</span> и эксплуатационных условий</li>
        <li>При производстве оборудования используются передовые материалы и технологии</li>
        <li><span>Цены от производителей</span></li>
      </ol>
      <a href="/store" class="to-sale d-flex">
        К покупкам
        <svg width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0)">
            <path d="M0.393478 4.0489L0.382551 4.04651L5.06663 4.04651L3.59413 5.52225C3.52202 5.5943 3.48247 5.69191 3.48247 5.79434C3.48247 5.89678 3.52202 5.9937 3.59413 6.06592L3.82325 6.29516C3.8953 6.36721 3.99131 6.40704 4.09369 6.40704C4.19613 6.40704 4.29219 6.36749 4.36424 6.29544L6.8884 3.77151C6.96073 3.69918 7.00028 3.60283 7 3.50034C7.00028 3.39727 6.96073 3.30086 6.8884 3.22864L4.36424 0.704491C4.29219 0.632499 4.19619 0.592889 4.09369 0.592889C3.99131 0.592889 3.8953 0.632555 3.82325 0.704491L3.59413 0.933726C3.52202 1.00566 3.48247 1.10173 3.48247 1.20417C3.48247 1.30655 3.52202 1.39755 3.59413 1.46954L5.08325 2.95354L0.388242 2.95354C0.177274 2.95354 -1.90735e-06 3.13537 -1.90735e-06 3.34622V3.67044C-1.90735e-06 3.8813 0.18251 4.0489 0.393478 4.0489Z" fill="white" />
          </g>
          <defs>
            <clipPath id="clip0">
              <rect width="7" height="7" fill="white" transform="translate(7 7) rotate(-180)" />
            </clipPath>
          </defs>
        </svg>
      </a>
    </div>
  </div> -->
</div>
<!-- <section class="our-value"> -->

<!-- </section> -->
<!-- <div class="for-claims container d-flex">
  <div class="claims__left posrel">
    В компании работает опытный персонал, сочетающий в себе профессиональные качества и увлеченность делом, который в процессе сделки обеспечит Вам высокий уровень сервиса, окажет всю необходимую техническую поддержку и реализует наиболее эффективные решения поставленных задач.
    <div class="left__absolute abs">
      <?= CHtml::image($this->mainAssets . '/images/page/final.jpg') ?>
      <span>СТРОМ СТИЛ</span>
    </div>
    <div class="for-claims__box_mob">
      <div class="for-claims__content">
        Если в нашем каталоге не нашлось подходящих изделий,
        Вы можете предложить свой собственный вариант решения проблемы – предоставить индивидуальный проект, по которому будут работать наши высококвалифицированные инженеры и разработают под вас изделия.
      </div>
      <a href="#" class="for-claims__button js-button" data-target="#CallbackFormEmail" data-toggle="modal">
        Оставить заявку
        <svg width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0)">
            <path d="M0.393478 3.93255L0.382551 3.93023L5.06663 3.93023L3.59413 5.36357C3.52202 5.43355 3.48247 5.52834 3.48247 5.62784C3.48247 5.72734 3.52202 5.82147 3.59413 5.89161L3.82325 6.11426C3.8953 6.18424 3.99131 6.22293 4.09369 6.22293C4.19613 6.22293 4.29219 6.18451 4.36424 6.11454L6.8884 3.66314C6.96073 3.59289 7.00028 3.49931 7 3.39976C7.00028 3.29966 6.96073 3.20602 6.8884 3.13588L4.36424 0.684263C4.29219 0.61434 4.19619 0.575869 4.09369 0.575869C3.99131 0.575869 3.8953 0.614395 3.82325 0.684263L3.59413 0.906911C3.52202 0.976779 3.48247 1.07008 3.48247 1.16958C3.48247 1.26902 3.52202 1.3574 3.59413 1.42733L5.08325 2.86868L0.388242 2.86868C0.177274 2.86868 -1.90735e-06 3.04528 -1.90735e-06 3.25007V3.56498C-1.90735e-06 3.76977 0.18251 3.93255 0.393478 3.93255Z" fill="#1B4E9B" />
          </g>
          <defs>
            <clipPath id="clip0">
              <rect width="7" height="6.79883" fill="white" transform="translate(7 6.79883) rotate(-180)" />
            </clipPath>
          </defs>
        </svg>
      </a>
    </div>
  </div>
  <div class="claims__right posrel">
    <?= CHtml::image($model->getImageUrl(832, 500, true, null, "svg")) ?>
    <div class="for-claims__box abs">
      <div class="for-claims__content">
        Если в нашем каталоге не нашлось подходящих изделий,
        Вы можете предложить свой собственный вариант решения проблемы – предоставить индивидуальный проект, по которому будут работать наши высококвалифицированные инженеры и разработают под вас изделия.
      </div>
      <a href="#" class="for-claims__button js-button" data-target="#CallbackFormEmail" data-toggle="modal">
        Оставить заявку
        <svg width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0)">
            <path d="M0.393478 3.93255L0.382551 3.93023L5.06663 3.93023L3.59413 5.36357C3.52202 5.43355 3.48247 5.52834 3.48247 5.62784C3.48247 5.72734 3.52202 5.82147 3.59413 5.89161L3.82325 6.11426C3.8953 6.18424 3.99131 6.22293 4.09369 6.22293C4.19613 6.22293 4.29219 6.18451 4.36424 6.11454L6.8884 3.66314C6.96073 3.59289 7.00028 3.49931 7 3.39976C7.00028 3.29966 6.96073 3.20602 6.8884 3.13588L4.36424 0.684263C4.29219 0.61434 4.19619 0.575869 4.09369 0.575869C3.99131 0.575869 3.8953 0.614395 3.82325 0.684263L3.59413 0.906911C3.52202 0.976779 3.48247 1.07008 3.48247 1.16958C3.48247 1.26902 3.52202 1.3574 3.59413 1.42733L5.08325 2.86868L0.388242 2.86868C0.177274 2.86868 -1.90735e-06 3.04528 -1.90735e-06 3.25007V3.56498C-1.90735e-06 3.76977 0.18251 3.93255 0.393478 3.93255Z" fill="#1B4E9B" />
          </g>
          <defs>
            <clipPath id="clip0">
              <rect width="7" height="6.79883" fill="white" transform="translate(7 6.79883) rotate(-180)" />
            </clipPath>
          </defs>
        </svg>
      </a>
    </div>
  </div>
</div> -->

<!-- <a href="#" class="for-claims__button js-button" data-target="#CallbackFormEmail" data-toggle="modal">
        Оставить заявку
        <svg width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0)">
            <path d="M0.393478 3.93255L0.382551 3.93023L5.06663 3.93023L3.59413 5.36357C3.52202 5.43355 3.48247 5.52834 3.48247 5.62784C3.48247 5.72734 3.52202 5.82147 3.59413 5.89161L3.82325 6.11426C3.8953 6.18424 3.99131 6.22293 4.09369 6.22293C4.19613 6.22293 4.29219 6.18451 4.36424 6.11454L6.8884 3.66314C6.96073 3.59289 7.00028 3.49931 7 3.39976C7.00028 3.29966 6.96073 3.20602 6.8884 3.13588L4.36424 0.684263C4.29219 0.61434 4.19619 0.575869 4.09369 0.575869C3.99131 0.575869 3.8953 0.614395 3.82325 0.684263L3.59413 0.906911C3.52202 0.976779 3.48247 1.07008 3.48247 1.16958C3.48247 1.26902 3.52202 1.3574 3.59413 1.42733L5.08325 2.86868L0.388242 2.86868C0.177274 2.86868 -1.90735e-06 3.04528 -1.90735e-06 3.25007V3.56498C-1.90735e-06 3.76977 0.18251 3.93255 0.393478 3.93255Z" fill="#1B4E9B" />
          </g>
          <defs>
            <clipPath id="clip0">
              <rect width="7" height="6.79883" fill="white" transform="translate(7 6.79883) rotate(-180)" />
            </clipPath>
          </defs>
        </svg>
      </a> -->