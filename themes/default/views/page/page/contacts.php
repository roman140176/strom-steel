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
  <div class="container" id="map-container">
    <h1 class="page_title"><?= $model->title; ?></h1>
    <address style="margin-top:2rem">
      <blockquote>
        <div class="adr_name"><strong>Адрес офиса и склада:</strong></div>
        <div class="adr_detail">
          121059, г. Москва, ул. Киевская д.19
        </div>
      </blockquote>
    </address>
    <div class="map-contacts" id="strom-map-page" data-strom-map="auto">
        <noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. <a href="https://yandex.ru/maps/?ll=37.555274%2C55.741318&z=17">Открыть в Яндекс.Картах</a>.</noscript>
    </div>
    <div class="adr-flex">
      <div class="adr-flex__item">
        <div class="af__item-name">Телефоны:</div>
        <a href="tel:+74956643517" class="tel-header">+7 (495) 664-35-17</a>
        <a href="tel:+74955320720" class="tel-header">+7 (495) 532-07-20</a>

      </div>
      <div class="adr-flex__item">
        <div class="af__item-name">E-mail:</div>
        <a href="mailTo:<?= Yii::app()->getModule('yupe')->email ?>" class="tel-header emel-c"><?= Yii::app()->getModule('yupe')->email ?></a>

      </div>
      <div class="adr-flex__item">
        <div class="af__item-name">Время работы:</div>
        <div class="wmodes"><span><?= Yii::app()->getModule('yupe')->wmode ?></span></div>
        <div class="wmodes"><span>Сб-Вс: выходные</span></div>
      </div>
      <blockquote>
        <div class="af__item-name">Реквизиты: ООО «СТРОМ ТРЕЙД», ИНН 7730188020 КПП 773001001</div>
        <div class="adr_detail">
          Генеральный директор: Родионов Александр Витальевич.
        </div>
      </blockquote>
    </div>
  </div>
</div>