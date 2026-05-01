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

// ── Обработка калькулятора лазерной резки ──────────────────────────────────
// Письмо собирается через шаблон themes/default/views/mail/mail/_laser-calc.php
// и отправляется через Yii::app()->mail (как и остальные формы услуг).
// reCAPTCHA проверяется только при включённом флаге Yii::app()->params['recaptchaEnabled'].
$calcErrors = [];
if (Yii::app()->request->isPostRequest && (int)($_POST['laser_calc'] ?? 0) === 1) {
  $userName    = trim((string)($_POST['user_name'] ?? ''));
  $userPhone   = trim((string)($_POST['user_phone'] ?? ''));
  $userEmail   = trim((string)($_POST['user_email'] ?? ''));
  $metalType   = trim((string)($_POST['metal_type'] ?? ''));
  $metalThick  = trim((string)($_POST['metal_thickness'] ?? ''));
  $metalMeters = trim((string)($_POST['metal_meters'] ?? ''));
  $metalBurns  = trim((string)($_POST['metal_burns'] ?? ''));

  if ($userName === '')    { $calcErrors[] = 'Заполните имя.'; }
  if ($userPhone === '')   { $calcErrors[] = 'Заполните телефон.'; }
  if ($metalType === '')   { $calcErrors[] = 'Выберите тип металла.'; }
  if ($metalThick === '')  { $calcErrors[] = 'Укажите толщину.'; }
  if ($metalMeters === '') { $calcErrors[] = 'Укажите количество метров.'; }
  if ($metalBurns === '')  { $calcErrors[] = 'Укажите количество прожигов.'; }
  if ($userEmail !== '' && !filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
    $calcErrors[] = 'Некорректный E-mail.';
  }

  // reCAPTCHA — проверяем только если флаг включён (на проде).
  if (empty($calcErrors) && !empty(Yii::app()->params['recaptchaEnabled'])) {
    $captcha = $_POST['g-recaptcha-response'] ?? '';
    if ($captcha === '') {
      $calcErrors[] = 'Пройдите проверку reCAPTCHA.';
    } else {
      $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'secret'   => Yii::app()->params['secretkey'],
        'response' => $captcha,
      ]);
      $rResp = curl_exec($ch);
      curl_close($ch);
      $rResp = CJSON::decode($rResp);
      if (empty($rResp['success'])) {
        $calcErrors[] = 'Не удалось пройти проверку reCAPTCHA.';
      }
    }
  }

  if (empty($calcErrors)) {
    $fileName = null;
    if (isset($_FILES['user_file']) && is_uploaded_file($_FILES['user_file']['tmp_name'])) {
      $fileName = $_FILES['user_file']['name'];
    }

    $body = $this->renderPartial('//mail/mail/_laser-calc', [
      'userName'       => $userName,
      'userPhone'      => $userPhone,
      'userEmail'      => $userEmail,
      'metalType'      => $metalType,
      'metalThickness' => $metalThick,
      'metalMeters'    => $metalMeters,
      'metalBurns'     => $metalBurns,
      'fileName'       => $fileName,
    ], true);

    try {
      $mail  = Yii::app()->mail;
      $to    = Yii::app()->getModule('yupe')->email;
      $from  = 'info@stromsteel.ru';
      $theme = 'Заявка на расчёт лазерной резки с сайта';

      if ($fileName !== null) {
        $mail->AddAttachment($_FILES['user_file']['tmp_name'], $fileName);
      }
      $mail->send($from, $to, $theme, $body);
      $successMessage = 'Заявка отправлена. Мы свяжемся с вами в ближайшее время.';

      if (Yii::app()->request->isAjaxRequest) {
        header('Content-Type: application/json; charset=UTF-8');
        echo CJSON::encode(['success' => true, 'message' => $successMessage]);
        Yii::app()->end();
      }

      Yii::app()->user->setFlash('calc_success', $successMessage);
      Yii::app()->controller->refresh();
    } catch (Exception $e) {
      $calcErrors[] = 'Не удалось отправить заявку. Попробуйте позже.';
    }
  }

  // На AJAX-запрос всегда отдаём JSON (и при ошибках, и если try{} рухнул).
  if (Yii::app()->request->isAjaxRequest) {
    header('Content-Type: application/json; charset=UTF-8');
    echo CJSON::encode(['success' => false, 'errors' => $calcErrors]);
    Yii::app()->end();
  }
}
?>

<div class="svc-page">

  <section class="svc-page__crumbs">
    <div class="container breadcrumbs-container">
      <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', ['links' => $this->breadcrumbs]); ?>
    </div>
  </section>

  <?php $this->renderPartial('_services_nav', ['current' => 'lazernaya-rezka']); ?>

  <!-- Tech-hero: тёмный блок с заголовком и 4 stat-карточками -->
  <div class="svc-tech-hero">
    <picture class="svc-tech-hero__media" aria-hidden="true">
      <source type="image/webp" srcset="<?= $this->mainAssets ?>/images/laser.webp">
      <img src="<?= $this->mainAssets ?>/images/laser.jpg" alt="" loading="lazy" decoding="async">
    </picture>
    <div class="svc-page__inner svc-tech-hero__inner">
      <div class="svc-tech-hero__tag">Высокоточная технология</div>
      <h1 class="svc-tech-hero__title">Лазерная резка<br>металла</h1>
      <p class="svc-tech-hero__desc">Высокоточный способ металлообработки для производства деталей различных форм и размеров. Лазерный луч раскраивает изделия посредством интенсивного теплового воздействия — процесс полностью автоматизирован, что исключает влияние человеческого фактора.</p>

      <div class="svc-hero-stats">
        <div class="svc-hero-stat">
          <div class="svc-hero-stat__icon"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
          <h3 class="svc-hero-stat__title">Высокая точность</h3>
          <p class="svc-hero-stat__desc">Возможность вырезать любую форму и изготовить идеально совместимые детали</p>
        </div>
        <div class="svc-hero-stat">
          <div class="svc-hero-stat__icon"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
          <h3 class="svc-hero-stat__title">Высокое качество</h3>
          <p class="svc-hero-stat__desc">Лазер не портит материал и не нарушает слой полировки в процессе резки</p>
        </div>
        <div class="svc-hero-stat">
          <div class="svc-hero-stat__icon"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg></div>
          <h3 class="svc-hero-stat__title">Высокая скорость</h3>
          <p class="svc-hero-stat__desc">Другие способы резки значительно уступают лазеру в скорости реза</p>
        </div>
        <div class="svc-hero-stat">
          <div class="svc-hero-stat__icon"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L12 12.75l-5.571-3m11.142 0l4.179 2.25L12 17.25 2.25 12l4.179-2.25m11.142 0l4.179 2.25L12 21.75l-9.75-5.25 4.179-2.25"/></svg></div>
          <h3 class="svc-hero-stat__title">Любые материалы</h3>
          <p class="svc-hero-stat__desc">Сталь, латунь, алюминий, медь и другие металлы различной толщины</p>
        </div>
      </div>
    </div>
  </div>

  <main class="svc-page__inner svc-page__main">

    <!-- Как работает лазерная резка -->
    <section class="svc-card">
      <div class="svc-card__head">
        <div class="svc-card__head-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"/></svg>
        </div>
        <h2>Как работает лазерная резка</h2>
      </div>
      <div class="svc-card__body">
        <p class="svc-intro">Раскрой происходит в несколько фаз. Лазер фокусируется на поверхности листа, обрабатывает материал с помощью высокой концентрации энергии. Работает с листами <strong>разной толщины,</strong> не оставляет окалины, минимизирует производственные отходы.</p>

        <div class="svc-phases">
          <div class="svc-phase">
            <div class="svc-phase__num">1</div>
            <h3 class="svc-phase__title">Нагрев</h3>
            <p class="svc-phase__desc">Лазер фокусируется на поверхности листа и нагревает его до температуры плавления</p>
          </div>
          <div class="svc-phase__arrow"><svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg></div>
          <div class="svc-phase">
            <div class="svc-phase__num">2</div>
            <h3 class="svc-phase__title">Плавление</h3>
            <p class="svc-phase__desc">Изделие начинает плавиться, в результате плавления образуется углубление</p>
          </div>
          <div class="svc-phase__arrow"><svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg></div>
          <div class="svc-phase">
            <div class="svc-phase__num">3</div>
            <h3 class="svc-phase__title">Испарение</h3>
            <p class="svc-phase__desc">Завершающий этап — на месте обработки появляется ровный, чистый рез</p>
          </div>
        </div>

        <div class="svc-notice" style="margin-top:1.5rem">
          <div class="svc-notice__ico">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
          </div>
          <p>После работы <strong>изделие не нуждается в дополнительной обработке</strong> и может сразу использоваться по назначению. Высокоточное воздействие и автоматизированное управление минимизируют производственные отходы.</p>
        </div>
      </div>
    </section>

    <!-- Калькулятор стоимости резки -->
    <section class="svc-calc-card">
      <div class="svc-calc-card__header">
        <h2 class="svc-calc-card__title">Рассчитать стоимость резки</h2>
        <div class="svc-calc-card__badge">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/></svg>
          Онлайн-расчёт
        </div>
      </div>

      <?php if (Yii::app()->user->hasFlash('calc_success')) : ?>
        <div class="svc-calc-card__alert svc-calc-card__alert--success">
          <?= CHtml::encode(Yii::app()->user->getFlash('calc_success')) ?>
        </div>
      <?php endif ?>
      <?php if (!empty($calcErrors)) : ?>
        <div class="svc-calc-card__alert svc-calc-card__alert--error">
          <?php foreach ($calcErrors as $err) : ?>
            <div><?= CHtml::encode($err) ?></div>
          <?php endforeach ?>
        </div>
      <?php endif ?>

      <form class="svc-calc-card__body" id="laser-calc-form" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="laser_calc" value="1">
        <input type="hidden" name="<?= Yii::app()->request->csrfTokenName ?>" value="<?= Yii::app()->request->csrfToken ?>">
        <div class="svc-calc-grid">
          <div>
            <label class="svc-calc-label">Тип металла <span class="svc-calc-req">*</span></label>
            <select class="svc-calc-select" name="metal_type" required>
              <option value="">Выберите тип</option>
              <option>Сталь</option>
              <option>Нержавеющая сталь</option>
              <option>Алюминий</option>
              <option>Латунь</option>
              <option>Медь</option>
            </select>
          </div>
          <div>
            <label class="svc-calc-label">Толщина <span class="svc-calc-req">*</span></label>
            <input class="svc-calc-input" type="text" name="metal_thickness" placeholder="мм" required>
          </div>
          <div>
            <label class="svc-calc-label">Кол-во метров <span class="svc-calc-req">*</span></label>
            <input class="svc-calc-input" type="text" name="metal_meters" placeholder="Кол-во метров" required>
          </div>
          <div>
            <label class="svc-calc-label">Кол-во прожигов <span class="svc-calc-req">*</span></label>
            <input class="svc-calc-input" type="text" name="metal_burns" placeholder="Кол-во прожигов" required>
          </div>
        </div>

        <div class="svc-calc-grid">
          <div>
            <label class="svc-calc-label">Ваше имя <span class="svc-calc-req">*</span></label>
            <input class="svc-calc-input" type="text" name="user_name" placeholder="Имя" required>
          </div>
          <div>
            <label class="svc-calc-label">Ваш телефон <span class="svc-calc-req">*</span></label>
            <?php $this->widget('CMaskedTextFieldPhone', [
              'name' => 'user_phone',
              'mask' => '+7(999)999-99-99',
              'htmlOptions' => [
                'class' => 'svc-calc-input data-mask',
                'data-mask' => 'phone',
                'placeholder' => '+7 (___) ___-__-__',
                'autocomplete' => 'off',
                'required' => true,
              ],
            ]); ?>
          </div>
          <div>
            <label class="svc-calc-label">Ваш E-mail <span class="svc-calc-req">*</span></label>
            <input class="svc-calc-input" type="email" name="user_email" placeholder="E-mail" required>
          </div>
          <div>
            <label class="svc-calc-label">Прикрепить файл</label>
            <label class="svc-calc-file">
              <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"/></svg>
              <span>Выбрать файл</span>
              <input type="file" name="user_file">
            </label>
          </div>
        </div>

        <?php if (!empty(Yii::app()->params['recaptchaEnabled'])) :
          Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js'); ?>
          <div class="svc-calc-captcha">
            <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key'] ?>" data-theme="dark"></div>
          </div>
        <?php endif ?>

        <div class="svc-calc-footer">
          <button type="submit" class="svc-calc-btn">
            Рассчитать
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
          </button>
          <p class="svc-calc-agree">Нажимая кнопку «Рассчитать», я даю согласие на обработку моих персональных данных в соответствии с <a href="/politika-konfidencialnosti" target="_blank">Соглашением об обработке персональных данных</a></p>
        </div>
      </form>
    </section>

    <!-- Info-cards: 2 колонки с тегами -->
    <div class="svc-info-grid">
      <article class="svc-info">
        <h3 class="svc-info__title">
          <span class="svc-info__icon">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
          </span>
          Где используется метод
        </h3>
        <p class="svc-info__desc">Услуги лазерной резки металла в Москве применяются для создания деталей и заготовок со сложными контурами. Метод задействован во многих областях.</p>
        <div class="svc-app-tags">
          <span class="svc-app-tag">Строительство</span>
          <span class="svc-app-tag">Автомобильная промышленность</span>
          <span class="svc-app-tag">Архитектура</span>
          <span class="svc-app-tag">Топливно-энергетический комплекс</span>
          <span class="svc-app-tag">Реклама</span>
        </div>
      </article>

      <article class="svc-info">
        <h3 class="svc-info__title">
          <span class="svc-info__icon">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
          </span>
          Что мы изготавливаем
        </h3>
        <p class="svc-info__desc">Мы изготавливаем <strong>металлоконструкции, декоративные элементы, рекламные баннеры, автомобильные детали, ограждения</strong> и многое другое.</p>
        <div class="svc-products-row">
          <div class="svc-product-tag">Металло-<br>конструкции</div>
          <div class="svc-product-tag">Декоративные элементы</div>
          <div class="svc-product-tag">Рекламные баннеры</div>
          <div class="svc-product-tag">Авто-<br>детали</div>
          <div class="svc-product-tag">Ограждения</div>
        </div>
      </article>
    </div>

  </main>

  <div style="height:3rem"></div>

</div>

<script>
(function () {
  var form = document.getElementById('laser-calc-form');
  if (!form) return;

  // Имя выбранного файла в кастомном лейбле «Выбрать файл».
  var fileInput = form.querySelector('input[type="file"]');
  var fileLabelText = fileInput ? fileInput.closest('.svc-calc-file').querySelector('span') : null;
  var fileLabelDefault = fileLabelText ? fileLabelText.textContent : 'Выбрать файл';
  if (fileInput) {
    fileInput.addEventListener('change', function () {
      if (fileLabelText) {
        fileLabelText.textContent = fileInput.files && fileInput.files[0] ? fileInput.files[0].name : fileLabelDefault;
      }
    });
  }

  // AJAX-сабмит формы калькулятора.
  var card = form.closest('.svc-calc-card');
  var submitBtn = form.querySelector('.svc-calc-btn');

  function clearAlerts() {
    if (!card) return;
    Array.prototype.forEach.call(card.querySelectorAll('.svc-calc-card__alert'), function (el) {
      el.parentNode.removeChild(el);
    });
  }

  function showAlert(type, content) {
    if (!card) return;
    var div = document.createElement('div');
    div.className = 'svc-calc-card__alert svc-calc-card__alert--' + type;
    if (Array.isArray(content)) {
      content.forEach(function (line) {
        var row = document.createElement('div');
        row.textContent = line;
        div.appendChild(row);
      });
    } else {
      div.textContent = content;
    }
    var header = card.querySelector('.svc-calc-card__header');
    if (header && header.nextSibling) {
      card.insertBefore(div, header.nextSibling);
    } else {
      card.insertBefore(div, form);
    }
    div.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }

  function resetCaptcha() {
    if (window.grecaptcha && typeof window.grecaptcha.reset === 'function') {
      try { window.grecaptcha.reset(); } catch (e) {}
    }
  }

  form.addEventListener('submit', function (event) {
    event.preventDefault();
    clearAlerts();
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.dataset.label = submitBtn.dataset.label || submitBtn.innerHTML;
      submitBtn.innerHTML = 'Отправка…';
    }

    var data = new FormData(form);
    fetch(form.action || window.location.href, {
      method: 'POST',
      body: data,
      credentials: 'same-origin',
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
    })
      .then(function (resp) { return resp.json(); })
      .then(function (json) {
        if (json && json.success) {
          showAlert('success', json.message || 'Заявка отправлена.');
          form.reset();
          if (fileLabelText) fileLabelText.textContent = fileLabelDefault;
          resetCaptcha();
        } else {
          var errs = (json && json.errors && json.errors.length) ? json.errors : ['Не удалось отправить заявку. Попробуйте позже.'];
          showAlert('error', errs);
          resetCaptcha();
        }
      })
      .catch(function () {
        showAlert('error', 'Не удалось отправить заявку. Попробуйте позже.');
        resetCaptcha();
      })
      .then(function () {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = submitBtn.dataset.label;
        }
      });
  });
})();
</script>
