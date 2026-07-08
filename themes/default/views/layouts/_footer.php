<footer>
  <div class="container container-footer">
    <div class="footer__item">
      <div class="footer__item-title">Информация</div>
      <noindex>
        <ul class="menu_footer">
          <li><a href="/politika-konfidencialnosti">Политика конфиденциальности</a></li>
          <li><a href="/pravila-ispolzovaniya-materialov-sayta">Правила использования материалов сайта</a></li>
        </ul>
      </noindex>
      <a href="/" class="footer-col-logo">
        <?= CHtml::image($this->mainAssets . '/images/logo.svg', Yii::app()->getModule('yupe')->siteName) ?>
      </a>
      <noindex>
        <div class="copy">
          © <?= date('Y') ?> «Стром Трейд, Производство изделий из металла любой сложности.
        </div>
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
      <ul class="menu_footer">
        <li class="footer-li"><a href="/store">Каталог товаров</a></li>
      </ul>
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
      <a href="#" class="mail-footer no-margin db" data-target="#pmYandex" data-toggle="modal">
        <span>Показать на карте</span>
      </a>
    </div>

  </div>
  <section class="footer-credit">
    <div class="container footer-bottom-container d-flex">
      <a href="https://strike-team.ru/" class="footer-credit__brand" target="_blank" rel="noopener">
        <span class="footer-credit__logo" aria-hidden="true"><svg viewBox="0 0 102 68" fill="none" xmlns="http://www.w3.org/2000/svg"><g stroke="#F2A93C" stroke-width="4" stroke-linecap="round"><path d="M91.91 26.69 A25 25 0 0 0 75.31 10.09"></path><path d="M60.69 10.09 A25 25 0 0 0 50.32 16.32"></path><path d="M50.32 51.68 A25 25 0 0 0 60.69 57.91"></path><path d="M75.31 57.91 A25 25 0 0 0 91.91 41.31"></path><path d="M68 3 V14"></path><path d="M87 34 H98"></path><path d="M68 54 V65"></path></g><g transform="translate(42.5,21.9) scale(0.33)"><path fill="#F2A93C" d="m 42.2,57.5 h 25.7 c 2.9,0 5.3,-2.6 5.3,-5.9 0,-3.2 -2.4,-5.9 -5.3,-5.9 H 42.2 V 26.1 h 25.7 c 2.9,0 5.3,-2.6 5.3,-5.9 0,-3.2 -2.4,-5.9 -5.3,-5.9 H 42.2 V 0 H 31.4 C 16,0 3.7,12.1 0.2,28.2 L 0,29.5 0.1,43.8 v 0.4 c 3.2,16.5 15.5,29.1 31.2,29.1 h 10.9 z"></path></g><g stroke="#F2A93C" stroke-linecap="round"><path d="M13 34 H42" stroke-width="4"></path><path d="M19 28 H38" stroke-width="3.6"></path><path d="M22 40 H38" stroke-width="3.6"></path></g><circle cx="6" cy="34" r="2.3" fill="#FFC871"></circle></svg></span>
        <span class="footer-credit__name">SWS <span class="footer-credit__team">TEAM</span></span>
      </a>
      <span class="footer-credit__slogan">Разработка и усиление веб-проектов</span>
    </div>
  </section>
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