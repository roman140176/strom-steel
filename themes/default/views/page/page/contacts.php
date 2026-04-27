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
    <!-- <address>
      <blockquote>
        <div class="adr_name"><strong>Адрес офиса:</strong></div>
        <div class="adr_detail">
          <?= Yii::app()->getModule('yupe')->buhgalter ?>
        </div>
      </blockquote>
    </address>
    <div class="map-contacts" id="map-contacts">
      <a class="dg-widget-link" href="http://2gis.ru/moscow/firm/70000001026119653/center/37.555274,55.741318/zoom/16?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=bigMap">Посмотреть на карте Москвы</a>
      <div class="dg-widget-link"><a href="http://2gis.ru/moscow/center/37.555274,55.741318/zoom/16/routeTab/rsType/bus/to/37.555274,55.741318╎Стром Трейд, торговая компания?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=route">Найти проезд до Стром Трейд, торговая компания</a></div>
      <script charset="utf-8" src="https://widgets.2gis.com/js/DGWidgetLoader.js"></script>
      <script charset="utf-8">
        new DGWidgetLoader({
          "width": 640,
          "height": 600,
          "borderColor": "#a3a3a3",
          "pos": {
            "lat": 55.741318,
            "lon": 37.555274,
            "zoom": 16
          },
          "opt": {
            "city": "moscow"
          },
          "org": [{
            "id": "70000001026119653"
          }]
        });
      </script><noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. Включите его в настройках вашего браузера.</noscript>
    </div> -->
    <address style="margin-top:2rem">
      <blockquote>
        <div class="adr_name"><strong>Адрес офиса и склада:</strong></div>
        <div class="adr_detail">
          121059, г. Москва, ул. Киевская д.19
        </div>
      </blockquote>
    </address>
    <div class="map-contacts" id="map-contacts">
        <a class="dg-widget-link" href="http://2gis.ru/moscow/firm/70000001026119653/center/37.555274,55.741318/zoom/16?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=bigMap">Посмотреть на карте Москвы</a><div class="dg-widget-link"><a href="http://2gis.ru/moscow/center/37.555274,55.741318/zoom/16/routeTab/rsType/bus/to/37.555274,55.741318╎Стром Трейд, торговая компания?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=route">Найти проезд до Стром Трейд, торговая компания</a></div><script charset="utf-8" src="https://widgets.2gis.com/js/DGWidgetLoader.js"></script><script charset="utf-8">new DGWidgetLoader({"width":640,"height":600,"borderColor":"#a3a3a3","pos":{"lat":55.741318,"lon":37.555274,"zoom":16},"opt":{"city":"moscow"},"org":[{"id":"70000001026119653"}]});</script><noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. Включите его в настройках вашего браузера.</noscript>
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