<!DOCTYPE html>
<html lang="<?= Yii::app()->language; ?>">

<head>
  <?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::HEAD_START); ?>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta http-equiv="Content-Language" content="ru-RU" />

  <title><?= $this->title; ?></title>
  <meta name="description" content="<?= $this->description; ?>" />
  <meta name="keywords" content="<?= $this->keywords; ?>" />
  <meta name="google-site-verification" content="r9o5NLpmngkU98Und4E7C5i-KGBVsh7vb7axbgOSSy4" />

  <?php if (isset($this->meta_robots) && $this->meta_robots) : ?>
    <meta name="robots" content="<?= $this->meta_robots ?>" />
  <?php endif; ?>

  <?php if ($this->canonical) : ?>
    <link rel="canonical" href="<?= $this->canonical ?>" />
  <?php endif; ?>

  <?php
  $ogHost = Yii::app()->request->hostInfo;
  $ogUrl = $this->canonical ?: ($ogHost . Yii::app()->request->requestUri);
  $ogImage = $ogHost . $this->mainAssets . '/images/strom.webp';
  $ogSiteName = 'СТРОМ ТРЕЙД';
  ?>
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="<?= CHtml::encode($ogSiteName) ?>" />
  <meta property="og:title" content="<?= CHtml::encode($this->title) ?>" />
  <meta property="og:description" content="<?= CHtml::encode($this->description) ?>" />
  <meta property="og:url" content="<?= CHtml::encode($ogUrl) ?>" />
  <meta property="og:image" content="<?= CHtml::encode($ogImage) ?>" />
  <meta property="og:locale" content="ru_RU" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= CHtml::encode($this->title) ?>" />
  <meta name="twitter:description" content="<?= CHtml::encode($this->description) ?>" />
  <meta name="twitter:image" content="<?= CHtml::encode($ogImage) ?>" />

  <?php
  $schemaOrg = [
    '@context'    => 'https://schema.org',
    '@type'       => 'LocalBusiness',
    '@id'         => $ogHost . '/#organization',
    'name'        => 'СТРОМ ТРЕЙД',
    'legalName'   => 'ООО «СТРОМ ТРЕЙД»',
    'url'         => $ogHost . '/',
    'logo'        => $ogImage,
    'image'       => $ogImage,
    'telephone'   => '+74956643517',
    'email'       => Yii::app()->getModule('yupe')->email,
    'taxID'       => '7730188020',
    'vatID'       => '7730188020',
    'address'     => [
      '@type'           => 'PostalAddress',
      'streetAddress'   => 'ул. Киевская, д. 19',
      'addressLocality' => 'Москва',
      'postalCode'      => '121059',
      'addressCountry'  => 'RU',
    ],
    'geo'         => [
      '@type'     => 'GeoCoordinates',
      'latitude'  => 55.741318,
      'longitude' => 37.555274,
    ],
    'openingHoursSpecification' => [
      [
        '@type'     => 'OpeningHoursSpecification',
        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
        'opens'     => '09:00',
        'closes'    => '18:00',
      ],
    ],
    'contactPoint' => [
      [
        '@type'       => 'ContactPoint',
        'telephone'   => '+74956643517',
        'contactType' => 'sales',
        'areaServed'  => 'RU',
        'availableLanguage' => ['ru'],
      ],
      [
        '@type'       => 'ContactPoint',
        'telephone'   => '+74955320720',
        'contactType' => 'customer support',
        'areaServed'  => 'RU',
        'availableLanguage' => ['ru'],
      ],
    ],
    'priceRange'  => '₽₽',
    'description' => 'Производство и продажа металлоконструкций: бордюры, решётчатые настилы, водоотводы, лестницы, системы грязезащиты',
  ];
  ?>
  <script type="application/ld+json">
    <?= json_encode($schemaOrg, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
  </script>


  
  

  <?php
  Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/simplebar.min.js', CClientScript::POS_END);
  Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/css/style.min.css');
  Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/css/new-styles.css');
  Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/scripts.min.js', CClientScript::POS_END);
  Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/new-scripts.js', CClientScript::POS_END);

  Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/css/swiper-bundle.min.css');
  Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/swiper-bundle.min.js', CClientScript::POS_END);

  Yii::app()->getClientScript()->registerLinkTag('preconnect', null, 'https://fonts.googleapis.com');
  Yii::app()->getClientScript()->registerLinkTag('preconnect', null, 'https://fonts.gstatic.com', null, ['crossorigin' => '']);
  Yii::app()->getClientScript()->registerCssFile('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
  Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/css/custom.css');
  Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/custom.js', CClientScript::POS_END);

  Yii::app()->getClientScript()->registerCoreScript('maskedinput');

  ?>
  <script type="text/javascript">
    var yupeTokenName = '<?= Yii::app()->getRequest()->csrfTokenName; ?>';
    var yupeToken = '<?= Yii::app()->getRequest()->getCsrfToken(); ?>';
  </script>
  <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  <!-- <link rel="stylesheet" href="http://yandex.st/highlightjs/8.2/styles/github.min.css">
    <script src="http://yastatic.net/highlightjs/8.2/highlight.min.js"></script> -->
  <?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::HEAD_END); ?>
</head>

<body class="<?= Yii::app()->getModule('yupe')->isVictoryRibbonVisible() ? 'has-victory-band' : '' ?>">

  <?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::BODY_START); ?>

  <?php
  // echo ('<pre>');
  // print_r(Yii::app()->getTheme()->baseUrl);
  // exit;
  ?>

  <?php
  if (!isset($_COOKIE["utm_source"]) && $_GET["utm_source"]) {
    setcookie("utm_source", $_GET["utm_source"]);
  }
  if (!isset($_COOKIE["utm_medium"]) && $_GET["utm_medium"]) {
    setcookie("utm_medium", $_GET["utm_medium"]);
  }
  if (!isset($_COOKIE["utm_campaign"]) && $_GET["utm_campaign"]) {
    setcookie("utm_campaign", $_GET["utm_campaign"]);
  }
  if (!isset($_COOKIE["utm_content"]) && $_GET["utm_content"]) {
    setcookie("utm_content", $_GET["utm_content"]);
  }
  if (!isset($_COOKIE["utm_term"]) && $_GET["utm_term"]) {
    setcookie("utm_term", $_GET["utm_term"]);
  }
  ?>

  <div class='wrapper'>
    <?php $this->renderPartial('//layouts/_header'); ?>

    <!-- flashMessages -->
    <?php //$this->widget('yupe\widgets\YFlashMessages'); 
    ?>

    <div class="content">
      <?= $this->decodeWidgets($content); ?>
    </div>
    <!-- footer -->
    <?php $this->renderPartial('//layouts/_footer'); ?>
    <!-- footer end -->
  </div>

  <?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::BODY_END); ?>

  <div id="cartModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header box-style">
          <div data-dismiss="modal" class="modal-close">
            <div></div>
          </div>
          <div class="box-style__header">
            <div class="box-style__heading">
              Товар добавлен в корзину!
            </div>
          </div>
        </div>
        <div class="modal-body js-cart-modal-body">
        </div>
        <div class="modal-footer">
          <div class="d-flex cm-button">
            <a class="but-close" data-dismiss="modal" href="#">Продолжить покупки</a>
            <a class="but-to-cart" href="<?= Yii::app()->createUrl('cart/cart/index'); ?>">Перейти в корзину</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Yandex.Metrika counter -->

  <script type="text/javascript">
    (function(m, e, t, r, i, k, a) {
      m[i] = m[i] || function() {
        (m[i].a = m[i].a || []).push(arguments)
      };

      m[i].l = 1 * new Date();
      k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })

    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");



    ym(87693910, "init", {

      clickmap: true,

      trackLinks: true,

      accurateTrackBounce: true,

      webvisor: true

    });
  </script>

  <noscript>
    <div><img src="https://mc.yandex.ru/watch/87693910" style="position:absolute; left:-9999px;" alt="" /></div>
  </noscript>

  <!-- /Yandex.Metrika counter -->
  <!-- <script>
        window.replainSettings = {
            id: 'e3eb9a4b-86d8-487e-8546-409fd3d9d029'
        };
        (function(u) {
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = u;
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        })('https://widget.replain.cc/dist/client.js');
    </script> -->

  <div class='notifications top-right' id="notifications"></div>
  <div class="ajax-loading"></div>
  <?php $this->widget('application.modules.mail.widgets.CallbackWidget'); ?>
  <?php $this->widget('application.modules.mail.widgets.CallbackFormEmailWidget'); ?>
  <div id="CallbackEmailsuccess" class="hidden">
    !!!!!
  </div>

  <!-- Begin roistat -->
  <script>
    (function(w, d, s, h, id) {
      w.roistatProjectId = id;
      w.roistatHost = h;
      var p = d.location.protocol == "https:" ? "https://" : "http://";
      var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/" + id + "/init?referrer=" + encodeURIComponent(d.location.href);
      var js = d.createElement(s);
      js.charset = "UTF-8";
      js.async = 1;
      js.src = p + h + u;
      var js2 = d.getElementsByTagName(s)[0];
      js2.parentNode.insertBefore(js, js2);
    })(window, document, 'script', 'cloud.roistat.com', '3e620cb8b092a76836dff1cdf2060933');
  </script>
  <!-- End roistat -->
  <!-- amoCRM social button widget — отключён (выдавал ошибку social_services).
       Если потребуется снова, раскомментировать блок ниже и обновить hash/id в кабинете amoCRM.
  <script>
    (function(a, m, o, c, r, m) {
      a[m] = {
        id: "393265",
        hash: "77b81105b6a34ec7b75cefe4c33581bfaca32a0113195d5becbae60f23b29101",
        locale: "ru",
        inline: true,
        setMeta: function(p) {
          this.params = (this.params || []).concat([p])
        }
      };
      a[o] = a[o] || function() {
        (a[o].q = a[o].q || []).push(arguments)
      };
      var d = a.document,
        s = d.createElement('script');
      s.async = true;
      s.id = m + '_script';
      s.src = 'https://gso.amocrm.ru/js/button.js?1693982502';
      d.head && d.head.appendChild(s)
    }(window, 0, 'amoSocialButton', 0, 0, 'amo_social_button'));
  </script>
  -->

</body>

</html>
<?php $fancybox = $this->widget(
  'gallery.extensions.fancybox3.AlFancybox',
  [
    'target' => '[data-fancybox]',
    'lang'   => 'ru',
    'config' => [
      'animationEffect' => "fade",
      'buttons' => [
        "zoom",
        "close",
      ]
    ],
  ]
); ?>
<?php Yii::app()->clientScript->registerScript("show-phone", "
    $('.show-phone').on('click', function(e){
        e.preventDefault();
        $(this).addClass('hidden');
        $(this).next().removeClass('hidden');
    })
    var getSelectedText = function() {
        var text = '';
        if (window.getSelection) {
            text = window.getSelection().toString();
        } else if (document.selection) {
            text = document.selection.createRange().text;
        }
        return text.replace(/\s/g, '');
    }

    document.onmouseup = function(){
        var text = getSelectedText(),
            email = '" . Yii::app()->getModule('yupe')->email . "';

        if (text == email) {
            yaCounter68294278.reachGoal('copy_mail');
        }
    }
"); ?>