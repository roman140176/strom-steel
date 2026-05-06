<footer>
  <div class="container container-footer">
    <div class="footer__item">
      <a href="/"  class="logo-footer">
        <?= CHtml::image($this->mainAssets . '/images/logo.svg', Yii::app()->getModule('yupe')->siteName) ?>
      </a>
      <noindex>
        <div class="copy">
          © <?= date('Y') ?> «Стром Трейд, Производство <br>изделий из металла любой сложности.
        </div>
        <a href="/politika-konfidencialnosti" class="confidetial on__desk">
          Политика конфиденциальности
        </a>
        <br>
        <a href="/pravila-ispolzovaniya-materialov-sayta" class="rules-use on__desk">
          Правила использования <br>материалов сайта
        </a>
      </noindex>
      <div class="pays hidden">
        <div class="pays__img">
          <?= CHtml::image($this->mainAssets . '/images/icon/1.png') ?>
        </div>
        <div class="pays__img">
          <?= CHtml::image($this->mainAssets . '/images/icon/2.png') ?>
        </div>
        <div class="pays__img">
          <?= CHtml::image($this->mainAssets . '/images/icon/3.png') ?>
        </div>
        <div class="pays__img">
          <?= CHtml::image($this->mainAssets . '/images/icon/4.png') ?>
        </div>
      </div>
    </div>
    <div class="footer__item">
      <div class="footer__item-title">Навигация</div>
      <li class="footer-li"><a href="/store">Каталог товаров</a></li>
      <?php $this->widget('application.modules.menu.widgets.MenuWidget', [
        'name' => 'top-menu',
        'view' => 'footer'
      ]); ?>
    </div>
    <div class="footer__item" style="max-width: 248px">
      <?php
      $criteria = new CDbCriteria();
      $criteria->order = 't.sort ASC';
      ?>
      <?php $catalog = StoreCategory::model()->published()->roots()->findAll($criteria) ?>
      <div class="footer__item-title">Каталог продукции</div>
      <ul class="menu_footer">
        <?php foreach ($catalog as $key => $item) : ?>
          <li>
            <a href="<?= $item->getCategoryUrl() ?>">
              <?= $item->name ?>
            </a>
          </li>
        <?php endforeach ?>
      </ul>
    </div>
    <div class="footer__item">
      <div class="footer__item-title">Контакты</div>

      <a href="tel:+74956643517" class="footer-phone">+7 (495) 664-35-17</a>
      <a href="tel:+74955320720" class="footer-phone">+7 (495) 532-07-20</a>

      <a href="#" class="wmode mt js-button" data-target="#callbackModal" data-toggle="modal"><span>Заказать звонок</span></a>
      <div class="rejim-raboty">
        <?= Yii::app()->getModule('yupe')->wmode ?><br>
        Сб-Вс с 9:00 до 16:00
      </div>
      <a href="mailTo:<?= Yii::app()->getModule('yupe')->email ?>" class="mail-footer">
        <span><?= Yii::app()->getModule('yupe')->email ?></span>
      </a>
      <div class="wmode address">
        <?= Yii::app()->getModule('yupe')->buhgalter ?>
      </div>
      <a href="#" class="mail-footer no-margin db" data-target="#pmYandex" data-toggle="modal" style="margin-top:1rem">
        <span>Показать на карте</span>
      </a>
    </div>

  </div>
  <div class="container footer-bottom-container d-flex" style="border:0;">

  </div>
</footer>

<div id="pmYandex" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
          Закрыть
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="map-contacts" id="strom-map-modal">
          <noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. <a href="https://yandex.ru/maps/?ll=37.555274%2C55.741318&z=17">Открыть в Яндекс.Картах</a>.</noscript>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- 
<style>
  .ctc__desc-text {
    font-size: 14px;
  }

  .down-link svg path {
    fill: #1b4e9b;
  }

  .appointment {
    padding: 15px 0 40px;
  }

  .appointment__item {
    width: 24%;
    padding: 20px;
    border: 1px solid #dedede;
  }

  .appointment__item img {
    width: 100%;
  }

  .cat-desc-container h4 {
    margin-bottom: 15px;
  }

  .construct {
    margin-top: 20px;
    margin-bottom: 20px;
  }

  .proposal-list {
    margin-bottom: 20px !important;
    padding-left: 0;
    list-style-position: inside;
  }

  .sch-flex {
    margin-bottom: 20px;
  }

  .sch__img {
    width: 40%;
    padding: 30px 15px;
    border: 1px solid #dedede;
    text-align: center;
  }

  .sch__info {
    width: 60%;
    padding: 30px 15px;
    border: 1px solid #dedede;
    position: relative;
    left: -1px;
    line-height: 2;
  }

  .types-flex.d-flex {
    padding: 10px 0 30px;
  }

  .types-flex__item {
    padding: 30px 15px;
    border: 1px solid #dedede;
    margin-right: 10px;
  }

  .types-title {
    margin-bottom: 15px;
    text-align: center;
    font-weight: 900;
  }

  ol.mnt-list {
    line-height: 2;
    margin-bottom: 30px;
    padding-left: 0;
    list-style-position: inside;
  }

  .mnt-list li ul {
    padding-left: 10px;
    line-height: 1.1;
  }

  .notification-price {
    margin-top: 15px;
    color: #757575;
  }

  .gamma-img {
    padding-top: 30px;
  }

  .sr-wrap {
    display: flex;
    justify-content: center;
    padding: 15px;
    margin-bottom: 20px;
    background: #f8f8f8;
  }

  .sr-wrap a {
    width: 400px;
  }

  #news-tm img {
    width: 300px;
  }

  #news-tm {
    margin-top: 40px;
  }

  @media (max-width: 400px) {
    .sr-wrap a {
      width: 100%;
    }
  }
</style> -->