/* Custom overlay scripts — loaded last, override base theme */
jQuery(function ($) {

  /* ========================================================================
     Cookie consent
     ======================================================================== */
  (function initCookieConsent() {
    var STORAGE_KEY = 'cookie_consent';

    try {
      if (window.localStorage && localStorage.getItem(STORAGE_KEY) === 'accepted') {
        return;
      }
    } catch (e) {
      // localStorage недоступен (например, приватный режим) — всё равно показываем баннер
    }

    var bannerHtml =
      '<div class="cookie-banner" id="cookie-banner" role="region" aria-label="Уведомление об использовании cookie">' +
        '<p class="cookie-banner__text">' +
          'Используя наш сайт, вы соглашаетесь с ' +
          '<a href="/politika-konfidencialnosti" class="cookie-banner__link" target="_blank" rel="noopener noreferrer">условиями</a> использования cookie.' +
        '</p>' +
        '<div class="cookie-banner__actions">' +
          '<button type="button" class="cookie-banner__more" id="cookie-banner-more">Подробнее</button>' +
          '<button type="button" class="cookie-banner__accept" id="cookie-banner-accept">Согласен</button>' +
        '</div>' +
      '</div>';

    var modalHtml =
      '<div class="cookie-modal" id="cookie-modal" role="dialog" aria-modal="true" aria-hidden="true" aria-labelledby="cookie-modal-title">' +
        '<div class="cookie-modal__overlay" data-cookie-close></div>' +
        '<div class="cookie-modal__dialog">' +
          '<button type="button" class="cookie-modal__close" data-cookie-close aria-label="Закрыть">&times;</button>' +
          '<div class="cookie-modal__content">' +
            '<p id="cookie-modal-title">Продолжая использовать наш сайт, вы даёте согласие на обработку файлов cookie, пользовательских данных (сведения о местоположении; тип и версия ОС; тип и версия браузера; тип устройства и разрешение его экрана; источник, откуда пришёл на сайт пользователь; с какого сайта или по какой рекламе; язык ОС и браузера; какие страницы открывает и на какие кнопки нажимает пользователь; IP-адрес) в целях функционирования сайта, проведения ретаргетинга и проведения статистических исследований и обзоров.</p>' +
            '<p>Если вы не хотите, чтобы ваши данные обрабатывались, покиньте наш сайт.</p>' +
            '<a href="/politika-konfidencialnosti" class="cookie-modal__policy" target="_blank" rel="noopener noreferrer">Политика обработки персональных данных</a>' +
          '</div>' +
        '</div>' +
      '</div>';

    var $body = $('body');
    $body.append(bannerHtml);
    $body.append(modalHtml);

    var $banner = $('#cookie-banner');
    var $modal = $('#cookie-modal');

    // Показываем плашку с анимацией после вставки в DOM
    requestAnimationFrame(function () {
      requestAnimationFrame(function () {
        $banner.addClass('is-visible');
      });
    });

    // «Согласен» — сохраняем и прячем плашку
    $banner.on('click', '#cookie-banner-accept', function () {
      try {
        localStorage.setItem(STORAGE_KEY, 'accepted');
      } catch (e) {}
      $banner.removeClass('is-visible');
      setTimeout(function () { $banner.remove(); }, 300);
    });

    // «Подробнее» — открыть модалку
    $banner.on('click', '#cookie-banner-more', function () {
      openModal();
    });

    // Закрытие модалки: крестик или клик по оверлею
    $modal.on('click', '[data-cookie-close]', function () {
      closeModal();
    });

    // Escape
    $(document).on('keydown.cookieModal', function (e) {
      if (e.key === 'Escape' && $modal.hasClass('is-open')) {
        closeModal();
      }
    });

    function openModal() {
      $modal.addClass('is-open').attr('aria-hidden', 'false');
    }

    function closeModal() {
      $modal.removeClass('is-open').attr('aria-hidden', 'true');
    }
  })();

  /* ========================================================================
     Hero на главной: видеофон (desktop ≥992px) / свайпер баннеров (mobile).
     Единый контроллер: на init и при resize вокруг 992px переставляем активный
     блок в DOM, инициализируем/уничтожаем Swiper, ставим/паузим видео.
     Неактивный блок в DOM не висит — это и экономит трафик, и убирает фоновую
     работу (autoplay/Swiper autoplay) в неиспользуемом режиме.
     ======================================================================== */
  (function initHomeHero() {
    var videoEl = document.querySelector('.home-hero-video');
    var bannersEl = document.querySelector('.home-hero-banners');
    if (!videoEl && !bannersEl) return;

    // Якорь для возврата элемента на исходное место в <main>
    var parent = (videoEl || bannersEl).parentNode;
    var anchor = document.createComment(' home-hero anchor ');
    parent.insertBefore(anchor, videoEl || bannersEl);

    // Сразу деттачим оба — вставлять будем только активный
    if (videoEl && videoEl.parentNode) videoEl.parentNode.removeChild(videoEl);
    if (bannersEl && bannersEl.parentNode) bannersEl.parentNode.removeChild(bannersEl);

    var swiper = null;
    var current = null; // 'video' | 'banners'

    function showVideo() {
      if (current === 'video') return;
      destroyBanners();
      if (videoEl) {
        parent.insertBefore(videoEl, anchor);
        var v = videoEl.querySelector('video');
        if (v) {
          try {
            v.muted = true;
            var p = v.play();
            if (p && typeof p.catch === 'function') p.catch(function () {});
          } catch (e) {}
        }
      }
      current = 'video';
    }

    function showBanners() {
      if (current === 'banners') return;
      pauseVideo();
      if (videoEl && videoEl.parentNode) videoEl.parentNode.removeChild(videoEl);
      if (bannersEl) {
        parent.insertBefore(bannersEl, anchor);
        initSwiper();
      }
      current = 'banners';
    }

    function pauseVideo() {
      if (!videoEl) return;
      var v = videoEl.querySelector('video');
      if (v) { try { v.pause(); } catch (e) {} }
    }

    function destroyBanners() {
      if (swiper) {
        try { swiper.destroy(true, true); } catch (e) {}
        swiper = null;
      }
      if (bannersEl && bannersEl.parentNode) bannersEl.parentNode.removeChild(bannersEl);
    }

    function initSwiper() {
      if (typeof Swiper === 'undefined' || swiper || !bannersEl) return;
      var el = bannersEl.querySelector('.home-banner-swiper');
      if (!el) return;
      var DURATION = 700;
      swiper = new Swiper(el, {
        loop: true,
        effect: 'fade',
        fadeEffect: { crossFade: true },
        speed: 0,
        autoplay: { delay: 5000, disableOnInteraction: false, pauseOnMouseEnter: true },
        pagination: { el: '.home-banner-swiper__pagination', clickable: true },
        navigation: { nextEl: '.home-banner-swiper__next', prevEl: '.home-banner-swiper__prev' },
        a11y: { prevSlideMessage: 'Предыдущий слайд', nextSlideMessage: 'Следующий слайд' },
        on: {
          slideChangeTransitionStart: function () {
            var active = this.slides[this.activeIndex];
            var prev = this.slides[this.previousIndex];
            if (!active || !prev || active === prev) return;
            var cur = this.realIndex, was = this.previousRealIndex, n = this.slides.length;
            var forward;
            if (was === n - 1 && cur === 0) forward = true;
            else if (was === 0 && cur === n - 1) forward = false;
            else forward = cur > was;
            active.classList.remove('is-coming-right', 'is-coming-left');
            void active.offsetHeight;
            active.classList.add(forward ? 'is-coming-right' : 'is-coming-left');
            prev.classList.add('is-staying');
            setTimeout(function () {
              active.classList.remove('is-coming-right', 'is-coming-left');
              prev.classList.remove('is-staying');
            }, DURATION + 50);
          },
        },
      });
    }

    var mq = window.matchMedia('(min-width: 992px)');
    function apply(matches) { matches ? showVideo() : showBanners(); }
    if (mq.addEventListener) mq.addEventListener('change', function (e) { apply(e.matches); });
    else if (mq.addListener) mq.addListener(function (e) { apply(e.matches); });
    apply(mq.matches);

    // Scroll-down индикатор: плавно скроллим к блоку «Каталог продукции».
    // Делегируем на document — .hhv-scroll живёт внутри видеоблока, который
    // монтируется/демонтируется контроллером выше.
    document.addEventListener('click', function (e) {
      var btn = e.target && e.target.closest ? e.target.closest('.hhv-scroll') : null;
      if (!btn) return;
      e.preventDefault();
      var target = document.querySelector('.page_title--main');
      if (!target) return;
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  })();

  /* ========================================================================
     FAQ-страница (/faq) — переключение табов разделов через hash
     ======================================================================== */
  (function initFaqTabs() {
    var tabsContainer = document.querySelector('.faq-tabs');
    if (!tabsContainer) return;

    var tabs = Array.prototype.slice.call(tabsContainer.querySelectorAll('.faq-tab'));
    var panels = Array.prototype.slice.call(document.querySelectorAll('.faq-panel'));
    if (!tabs.length || !panels.length) return;

    var keys = tabs.map(function (tab) { return tab.getAttribute('data-target'); });
    var firstKey = keys[0];

    function setActiveSection(key) {
      if (keys.indexOf(key) === -1) {
        key = firstKey;
      }
      tabs.forEach(function (tab) {
        var isActive = tab.getAttribute('data-target') === key;
        tab.classList.toggle('is-active', isActive);
        tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
      });
      panels.forEach(function (panel) {
        var isActive = panel.getAttribute('data-section') === key;
        panel.classList.toggle('is-active', isActive);
      });
    }

    tabs.forEach(function (tab) {
      tab.addEventListener('click', function (event) {
        event.preventDefault();
        var key = tab.getAttribute('data-target');
        setActiveSection(key);
        if (window.history && typeof window.history.replaceState === 'function') {
          window.history.replaceState(null, '', '#' + key);
        } else {
          window.location.hash = key;
        }
      });
    });

    window.addEventListener('hashchange', function () {
      setActiveSection((window.location.hash || '').replace(/^#/, ''));
    });

    var initialKey = (window.location.hash || '').replace(/^#/, '');
    setActiveSection(initialKey || firstKey);
  })();

  /* ========================================================================
     Reviews — Swiper-карусель отзывов + модалка «Читать полностью»
     ======================================================================== */
  (function initReviewsCarousel() {
    var swiperEl = document.querySelector('.reviews-swiper');
    if (swiperEl && typeof Swiper !== 'undefined') {
      new Swiper(swiperEl, {
        slidesPerView: 1.1,
        spaceBetween: 16,
        grabCursor: true,
        watchOverflow: true,
        pagination: {
          el: '.reviews-swiper__pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.reviews-swiper__next',
          prevEl: '.reviews-swiper__prev',
        },
        a11y: {
          prevSlideMessage: 'Предыдущий отзыв',
          nextSlideMessage: 'Следующий отзыв',
          slideRole: '',
        },
        breakpoints: {
          576: { slidesPerView: 1.6, spaceBetween: 18 },
          768: { slidesPerView: 2.2, spaceBetween: 20 },
          992: { slidesPerView: 3.2, spaceBetween: 24 },
          1200: { slidesPerView: 3.5, spaceBetween: 28 },
          1440: { slidesPerView: 4.5, spaceBetween: 30 },
        },
      });
    }

    var modal = document.getElementById('reviews-modal');
    if (!modal) return;
    var body = modal.querySelector('.reviews-modal__body');
    var lastFocused = null;

    function openModal(id) {
      var tpl = document.querySelector('[data-reviews-content="' + id + '"]');
      if (!tpl || !tpl.content) return;
      lastFocused = document.activeElement;
      body.innerHTML = '';
      body.appendChild(tpl.content.cloneNode(true));
      modal.classList.add('is-open');
      modal.setAttribute('aria-hidden', 'false');
      document.body.classList.add('reviews-modal-open');
      var closeBtn = modal.querySelector('.reviews-modal__close');
      if (closeBtn) closeBtn.focus();
    }

    function closeModal() {
      modal.classList.remove('is-open');
      modal.setAttribute('aria-hidden', 'true');
      document.body.classList.remove('reviews-modal-open');
      body.innerHTML = '';
      if (lastFocused && typeof lastFocused.focus === 'function') {
        lastFocused.focus();
      }
    }

    document.addEventListener('click', function (event) {
      var trigger = event.target.closest('[data-reviews-open]');
      if (trigger) {
        event.preventDefault();
        openModal(trigger.getAttribute('data-reviews-open'));
        return;
      }
      if (event.target.closest('[data-reviews-close]')) {
        event.preventDefault();
        closeModal();
      }
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && modal.classList.contains('is-open')) {
        closeModal();
      }
    });
  })();

  /* ========================================================================
     Home videos — vertical reels carousel + lightbox
     ======================================================================== */
  (function initHomeVideos() {
    var swiperEl = document.querySelector('.home-videos-swiper');
    if (swiperEl && typeof Swiper !== 'undefined') {
      new Swiper(swiperEl, {
        slidesPerView: 'auto',
        spaceBetween: 20,
        centeredSlides: false,
        grabCursor: true,
        pagination: {
          el: '.home-videos-swiper__pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.home-videos-swiper__next',
          prevEl: '.home-videos-swiper__prev',
        },
        a11y: {
          prevSlideMessage: 'Предыдущее видео',
          nextSlideMessage: 'Следующее видео',
        },
        breakpoints: {
          720: { spaceBetween: 24 },
          1100: { spaceBetween: 30 },
        },
      });
    }

    var modal = document.getElementById('video-modal');
    if (!modal) return;
    var playerWrap = modal.querySelector('.video-modal__player');
    var lastFocused = null;

    function openModal(src) {
      lastFocused = document.activeElement;
      playerWrap.innerHTML = '';
      var video = document.createElement('video');
      video.src = src;
      video.controls = true;
      video.autoplay = true;
      video.playsInline = true;
      video.preload = 'auto';
      playerWrap.appendChild(video);
      modal.classList.add('is-open');
      modal.setAttribute('aria-hidden', 'false');
      document.body.classList.add('video-modal-open');
      var closeBtn = modal.querySelector('.video-modal__close');
      if (closeBtn) closeBtn.focus();
    }

    function closeModal() {
      modal.classList.remove('is-open');
      modal.setAttribute('aria-hidden', 'true');
      document.body.classList.remove('video-modal-open');
      var video = playerWrap.querySelector('video');
      if (video) {
        try { video.pause(); } catch (e) {}
        video.removeAttribute('src');
        video.load();
      }
      playerWrap.innerHTML = '';
      if (lastFocused && typeof lastFocused.focus === 'function') {
        lastFocused.focus();
      }
    }

    document.addEventListener('click', function (event) {
      var card = event.target.closest('.home-video-card');
      if (card) {
        event.preventDefault();
        var src = card.getAttribute('data-video');
        if (src) openModal(src);
        return;
      }
      if (event.target.closest('[data-video-close]')) {
        event.preventDefault();
        closeModal();
      }
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && modal.classList.contains('is-open')) {
        closeModal();
      }
    });
  })();

  /* ========================================================================
     Header — гостевой дропдаун ЛК (Войти / Регистрация)
     ======================================================================== */
  (function initHeaderLkDropdown() {
    var $guest = $('.header-lk__guest');
    if (!$guest.length) return;
    var $btn = $guest.find('.header-lk__btn');

    $btn.on('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      var willOpen = !$guest.hasClass('is-open');
      $guest.toggleClass('is-open', willOpen);
      $btn.attr('aria-expanded', willOpen ? 'true' : 'false');
    });

    $(document).on('click', function (e) {
      if (!$guest.hasClass('is-open')) return;
      if ($guest.is(e.target) || $guest.has(e.target).length) return;
      $guest.removeClass('is-open');
      $btn.attr('aria-expanded', 'false');
    });

    $(document).on('keydown', function (e) {
      if (e.key === 'Escape' && $guest.hasClass('is-open')) {
        $guest.removeClass('is-open');
        $btn.attr('aria-expanded', 'false');
        $btn.trigger('focus');
      }
    });
  })();

  /* Yandex map widget — injects iframe once per container.
     Containers opt-in via [data-strom-map="auto"] (auto-init on ready)
     or window.stromInitMap('container-id') (called by triggers). */
  (function initStromMap() {
    var MAP_SRC = 'https://yandex.ru/map-widget/v1/org/strom_treyd/1829653746/?indoorLevel=1&ll=37.555319%2C55.741399&z=17';
    var inited = {};

    window.stromInitMap = function (containerId) {
      if (!containerId || inited[containerId]) return;
      var el = document.getElementById(containerId);
      if (!el) return;
      inited[containerId] = true;
      var iframe = document.createElement('iframe');
      iframe.src = MAP_SRC;
      iframe.title = 'Стром Трейд на карте';
      iframe.loading = 'lazy';
      iframe.allow = 'fullscreen';
      iframe.setAttribute('frameborder', '0');
      iframe.style.cssText = 'width:100%;height:100%;min-height:420px;border:0;display:block;';
      el.appendChild(iframe);
    };

    var autoNodes = document.querySelectorAll('[data-strom-map="auto"]');
    for (var i = 0; i < autoNodes.length; i++) {
      if (autoNodes[i].id) window.stromInitMap(autoNodes[i].id);
    }

    var modalTrigger = document.querySelector('[data-target="#pmYandex"]');
    if (modalTrigger) {
      modalTrigger.addEventListener('click', function () {
        window.stromInitMap('strom-map-modal');
      });
    }
  })();

  /* ========================================================================
     Модалка «Прислать чертёж» (#sendDrawingModal) — AJAX-сабмит + UX файла.
     Бэкенд — POST-обработчик в начале themes/default/views/homepage/hp/page.php.
     ======================================================================== */
  (function initDrawingForm() {
    var form = document.getElementById('drawing-form');
    if (!form) return;

    var fileInput  = form.querySelector('input[type="file"]');
    var fileLabel  = form.querySelector('.drawing-form__file-label');
    var fileBox    = form.querySelector('.drawing-form__file');
    var fileDefault = fileLabel ? (fileLabel.getAttribute('data-default') || fileLabel.textContent) : '';

    if (fileInput) {
      fileInput.addEventListener('change', function () {
        var f = fileInput.files && fileInput.files[0];
        if (f) {
          if (fileLabel) fileLabel.textContent = f.name;
          if (fileBox) fileBox.classList.add('is-filled');
        } else {
          if (fileLabel) fileLabel.textContent = fileDefault;
          if (fileBox) fileBox.classList.remove('is-filled');
        }
      });
    }

    var alertBox  = form.querySelector('[data-role="drawing-alert"]');
    var submitBtn = form.querySelector('.drawing-form__submit');
    var submitLbl = form.querySelector('.drawing-form__submit-label');

    function showAlert(type, lines) {
      if (!alertBox) return;
      alertBox.className = 'drawing-form__alert drawing-form__alert--' + type;
      alertBox.innerHTML = lines.map(function (l) {
        return '<div>' + l + '</div>';
      }).join('');
      alertBox.hidden = false;
    }
    function clearAlert() {
      if (!alertBox) return;
      alertBox.hidden = true;
      alertBox.innerHTML = '';
      alertBox.className = 'drawing-form__alert';
    }
    function setLoading(loading) {
      if (!submitBtn) return;
      submitBtn.disabled = loading;
      if (submitLbl) submitLbl.textContent = loading ? 'Отправка…' : 'Отправить';
    }

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      clearAlert();
      setLoading(true);

      var fd = new FormData(form);

      fetch(window.location.pathname, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: fd,
        credentials: 'same-origin',
      }).then(function (r) {
        return r.json();
      }).then(function (json) {
        setLoading(false);
        if (json && json.success) {
          showAlert('success', [json.message || 'Заявка отправлена. Мы свяжемся с вами в ближайшее время.']);
          form.reset();
          if (fileLabel) fileLabel.textContent = fileDefault;
          if (fileBox) fileBox.classList.remove('is-filled');
          // Закрыть модалку через 2.5 секунды.
          setTimeout(function () {
            try { $('#sendDrawingModal').modal('hide'); } catch (e) {}
            clearAlert();
          }, 2500);
        } else {
          var errs = (json && json.errors && json.errors.length) ? json.errors : ['Не удалось отправить заявку.'];
          showAlert('error', errs);
        }
      }).catch(function () {
        setLoading(false);
        showAlert('error', ['Сетевая ошибка. Попробуйте ещё раз.']);
      });
    });
  })();

  /* ========================================================================
     Stromsteel Works (.ssw-*) — карусель «Реализованные объекты» на главной
     View: themes/default/views/page/widgets/PagesNewWidget/works.php
     Поведение: автопрокрутка 6 с, пауза при hover/focus, после ручного
     клика по стрелкам автоплей останавливается навсегда. Прогресс-бар
     считаем сами на rAF, чтобы корректно паузить/возобновлять.
     ======================================================================== */
  (function initStromsteelWorks() {
    var section = document.querySelector('.ssw-section');
    if (!section) return;
    var swiperEl = section.querySelector('.ssw-swiper');
    if (!swiperEl || typeof Swiper === 'undefined') return;

    var slidesCount = swiperEl.querySelectorAll('.swiper-slide').length;
    if (slidesCount === 0) return;

    var currentEl = section.querySelector('[data-ssw-current]');
    var progressFill = section.querySelector('[data-ssw-progress]');
    var prevBtn = section.querySelector('.ssw-nav--prev');
    var nextBtn = section.querySelector('.ssw-nav--next');

    var AUTOPLAY_MS = 6000;
    var stopped = false;
    var paused = false;
    var startTs = 0;
    var elapsed = 0;
    var rafId = null;

    function setProgress(pct) {
      if (progressFill) progressFill.style.width = pct + '%';
    }
    function tick(now) {
      if (paused || stopped) return;
      var t = elapsed + (now - startTs);
      setProgress(Math.min(100, (t / AUTOPLAY_MS) * 100));
      if (t < AUTOPLAY_MS) rafId = requestAnimationFrame(tick);
    }
    function startTimer() {
      if (stopped) return;
      elapsed = 0;
      setProgress(0);
      paused = false;
      cancelAnimationFrame(rafId);
      startTs = performance.now();
      rafId = requestAnimationFrame(tick);
    }
    function pauseTimer() {
      if (stopped || paused) return;
      paused = true;
      elapsed += performance.now() - startTs;
      cancelAnimationFrame(rafId);
    }
    function resumeTimer() {
      if (stopped || !paused) return;
      paused = false;
      startTs = performance.now();
      rafId = requestAnimationFrame(tick);
    }
    function stopTimer() {
      stopped = true;
      paused = false;
      cancelAnimationFrame(rafId);
      setProgress(100);
    }
    function updateCounter(sw) {
      if (!currentEl) return;
      var idx = ((sw && typeof sw.realIndex === 'number') ? sw.realIndex : 0) + 1;
      currentEl.textContent = (idx < 10 ? '0' : '') + idx;
    }

    var useLoop = slidesCount > 1;
    var swiper = new Swiper(swiperEl, {
      slidesPerView: 1,
      spaceBetween: 0,
      speed: 650,
      loop: useLoop,
      grabCursor: useLoop,
      watchOverflow: true,
      autoplay: useLoop ? {
        delay: AUTOPLAY_MS,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      } : false,
      navigation: {
        nextEl: '.ssw-nav--next',
        prevEl: '.ssw-nav--prev',
      },
      a11y: {
        prevSlideMessage: 'Предыдущий объект',
        nextSlideMessage: 'Следующий объект',
      },
      on: {
        init: function () {
          updateCounter(this);
          if (useLoop) startTimer();
        },
        slideChange: function () {
          updateCounter(this);
          if (!stopped && useLoop) startTimer();
        },
        autoplayPause: function () { pauseTimer(); },
        autoplayResume: function () { resumeTimer(); },
        autoplayStop: function () { stopTimer(); },
      },
    });

    function stopAll() {
      if (swiper && swiper.autoplay && typeof swiper.autoplay.stop === 'function') {
        try { swiper.autoplay.stop(); } catch (e) {}
      }
      stopTimer();
    }
    if (prevBtn) prevBtn.addEventListener('click', stopAll);
    if (nextBtn) nextBtn.addEventListener('click', stopAll);
  })();

  // Ленивая загрузка Google reCAPTCHA: скрипт уходит в сеть только когда
  // открывается модалка, содержащая .g-recaptcha. Экономит ~340 KB на пейджвью
  // для пользователей, которые форму не вызывают.
  (function () {
    if (!window.jQuery) return;
    var loaded = false;
    jQuery(document).on('show.bs.modal', function (e) {
      var $captchas = jQuery(e.target).find('.g-recaptcha');
      if (!$captchas.length) return;
      // api.js уже загружен (например, формой чертежа в explicit-режиме,
      // где авторендера нет) — отрисовываем неотрисованные виджеты вручную.
      if (window.grecaptcha && typeof window.grecaptcha.render === 'function') {
        $captchas.each(function () {
          var sitekey = this.getAttribute('data-sitekey');
          if (!sitekey || this.children.length) return; // нет ключа или уже отрисован
          try { window.grecaptcha.render(this, { sitekey: sitekey }); } catch (err) {}
        });
        return;
      }
      if (loaded || window.grecaptcha) return;
      var s = document.createElement('script');
      s.src = 'https://www.google.com/recaptcha/api.js';
      s.async = true;
      s.defer = true;
      document.head.appendChild(s);
      loaded = true;
    });
  })();

  /* ========================================================================
     Новостные кейсы — интерактивная схема (.nce-schematic-wrap)
     Легенда .nce-leg ссылается якорями на аннотации SVG (#anno-..). Штатный
     переход по якорю подсвечивает аннотацию через :target, но заодно прыгает
     страницей к ней. Перехватываем клик: подсветку-«замок» даём классом
     .is-active (тот же вид, что :target), а страницей не прыгаем — лишь на
     узких экранах, где схема может оказаться выше зоны видимости, мягко её
     подводим. Хеш/история не трогаются (ср. replaceState в FAQ-табах выше).
     ======================================================================== */
  (function initSchematicLegend() {
    var wraps = document.querySelectorAll('.nce-schematic-wrap');
    if (!wraps.length) return;

    // зеркало правил .nce-anno:target из стилей новости (через те же CSS-переменные)
    var style = document.createElement('style');
    style.textContent =
      '.nce-anno.is-active .nce-anno__shape{stroke:var(--g-bright);stroke-width:2.6}' +
      '.nce-anno.is-active .nce-anno__fill{fill:rgba(67,201,140,.28)}' +
      '.nce-anno.is-active .nce-anno__line{stroke:var(--g-bright);stroke-dasharray:none}' +
      '.nce-anno.is-active .nce-anno__badge{fill:var(--g);stroke:var(--g-soft)}';
    document.head.appendChild(style);

    document.addEventListener('click', function (e) {
      var leg = e.target && e.target.closest ? e.target.closest('.nce-leg') : null;
      if (!leg) return;
      var href = leg.getAttribute('href') || '';
      if (href.charAt(0) !== '#' || href.length < 2) return;
      var anno = document.getElementById(href.slice(1));
      if (!anno || !anno.classList.contains('nce-anno')) return;

      e.preventDefault(); // гасим штатный прыжок к якорю

      // снимаем подсветку с соседних аннотаций той же схемы, ставим на текущую
      var svg = anno.ownerSVGElement || (anno.closest ? anno.closest('svg') : null);
      if (svg) {
        var active = svg.querySelectorAll('.nce-anno.is-active');
        for (var i = 0; i < active.length; i++) active[i].classList.remove('is-active');
      }
      anno.classList.add('is-active');

      // на узком экране схема может быть выше зоны видимости — мягко подводим;
      // на десктопе схема и легенда видны вместе, страницу не двигаем
      var anatomy = leg.closest ? leg.closest('.nce-anatomy') : null;
      var wrap = (anatomy && anatomy.querySelector('.nce-schematic-wrap')) || wraps[0];
      var r = wrap.getBoundingClientRect();
      var vh = window.innerHeight || document.documentElement.clientHeight;
      if (r.top < 0 || r.bottom > vh) {
        wrap.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    });
  })();

  /* ========================================================================
     Каталог — выезжающее двухпанельное меню (off-canvas)
     ======================================================================== */
  (function initCatalogDrawer() {
    var trigger = document.getElementById('catalog-trigger');
    var drawer = document.getElementById('catalog-drawer');
    if (!trigger || !drawer) return;

    function toArr(nl) { return Array.prototype.slice.call(nl); }

    var cats = toArr(drawer.querySelectorAll('.cat-drawer__cat'));
    var subs = toArr(drawer.querySelectorAll('.cat-drawer__sub'));
    var mq = window.matchMedia('(max-width: 900px)');
    var closeTimer = null;

    function isMobile() { return mq.matches; }

    function setActive(catId) {
      cats.forEach(function (c) {
        var on = c.getAttribute('data-cat') === catId;
        c.classList.toggle('is-active', on);
        var link = c.querySelector('.cat-drawer__cat-link');
        if (link) { link.setAttribute('aria-selected', on ? 'true' : 'false'); }
      });
      subs.forEach(function (s) {
        s.classList.toggle('is-active', s.getAttribute('data-cat') === catId);
      });
    }

    function openDrawer() {
      if (closeTimer) { clearTimeout(closeTimer); closeTimer = null; }
      drawer.hidden = false;
      void drawer.offsetWidth; // reflow, чтобы проиграть transition
      drawer.classList.add('is-open');
      document.body.classList.add('cat-drawer-open');
      trigger.setAttribute('aria-expanded', 'true');
      var closeBtn = drawer.querySelector('.cat-drawer__close');
      if (closeBtn) { closeBtn.focus(); }
    }

    function closeDrawer() {
      drawer.classList.remove('is-open', 'is-sub-open');
      document.body.classList.remove('cat-drawer-open');
      trigger.setAttribute('aria-expanded', 'false');
      closeTimer = setTimeout(function () {
        if (!drawer.classList.contains('is-open')) { drawer.hidden = true; }
      }, 420);
      trigger.focus();
    }

    trigger.addEventListener('click', function (e) {
      e.preventDefault();
      if (drawer.classList.contains('is-open')) { closeDrawer(); } else { openDrawer(); }
    });

    toArr(drawer.querySelectorAll('[data-cat-close]')).forEach(function (el) {
      el.addEventListener('click', function (e) { e.preventDefault(); closeDrawer(); });
    });

    document.addEventListener('keydown', function (e) {
      if ((e.key === 'Escape' || e.keyCode === 27) && drawer.classList.contains('is-open')) { closeDrawer(); }
    });

    cats.forEach(function (c) {
      var id = c.getAttribute('data-cat');
      var link = c.querySelector('.cat-drawer__cat-link');
      c.addEventListener('mouseenter', function () { if (!isMobile()) { setActive(id); } });
      if (link) {
        link.addEventListener('focus', function () { if (!isMobile()) { setActive(id); } });
        link.addEventListener('click', function (e) {
          if (isMobile()) {
            e.preventDefault();
            setActive(id);
            drawer.classList.add('is-sub-open');
          }
          // десктоп: обычный переход по ссылке категории
        });
      }
    });

    var back = drawer.querySelector('[data-cat-back]');
    if (back) { back.addEventListener('click', function () { drawer.classList.remove('is-sub-open'); }); }
  })();


  /* ========================================================================
     Мобильное меню (<=1360px): галочка-индикатор у «Каталог».
     Раскрытие дерева делает базовый scripts.min.js (slideToggle
     .catalog-menu-wrapper) — здесь лишь синхронизируем поворот стрелки.
     ======================================================================== */
  (function initMobileCatalogArrow() {
    var links = document.querySelectorAll('.catalog-main-link');
    if (!links.length) return;
    Array.prototype.forEach.call(links, function (link) {
      link.addEventListener('click', function () {
        link.classList.toggle('is-open');
      });
    });
  })();

  /* ========================================================================
     Подложка блока фильтров. Пока ionRangeSlider/аккордеон достраивают фильтры,
     держим поверх блока «Готовим фильтры…». Снимаем не по фиксированному таймеру,
     а когда DOM блока перестал меняться: MutationObserver с дебаунсом — reveal
     через SETTLE мс после последней мутации (т.е. когда перестройка реально
     закончилась). START — если мутаций нет вовсе; CAP — предохранитель от залипания.
     ======================================================================== */
  (function initFiltersLoader() {
    var boxes = document.querySelectorAll('.sidebar-box');
    if (!boxes.length) return;
    if (typeof MutationObserver === 'undefined') {
      // деградация: без наблюдателя снимаем на window.load
      window.addEventListener('load', function () {
        Array.prototype.forEach.call(boxes, function (box) { box.classList.add('filters-ready'); });
      });
      return;
    }
    var SETTLE = 450;  // тишина после последней мутации -> фильтры собраны
    var START = 900;   // если перестройки не было вовсе
    var CAP = 6000;    // жёсткий предел
    Array.prototype.forEach.call(boxes, function (box) {
      var loader = box.querySelector('[data-filters-loading]');
      if (!loader) return;
      var timer = null, revealed = false;
      function reveal() {
        if (revealed) return;
        revealed = true;
        obs.disconnect();
        clearTimeout(timer);
        box.classList.add('filters-ready');
        setTimeout(function () { if (loader.parentNode) loader.parentNode.removeChild(loader); }, 450);
      }
      function bump(ms) { clearTimeout(timer); timer = setTimeout(reveal, ms); }
      var obs = new MutationObserver(function () { bump(SETTLE); });
      obs.observe(box, { childList: true, subtree: true, attributes: true });
      bump(START);
      setTimeout(reveal, CAP);
    });
  })();

  /* ========================================================================
     Страница контактов: живой бейдж «Открыто/Закрыто» (Пн-Пт 9:00–19:00 по
     Москве) + копирование телефона/почты/ИНН по клику (.ct-copy).
     ======================================================================== */
  (function initContactsPage() {
    var badge = document.querySelector('[data-ct-status]');
    if (badge) {
      var d;
      try { d = new Date(new Date().toLocaleString('en-US', { timeZone: 'Europe/Moscow' })); }
      catch (e) { d = new Date(); }
      var day = d.getDay();
      var mins = d.getHours() * 60 + d.getMinutes();
      var open = day >= 1 && day <= 5 && mins >= 540 && mins < 1140;
      badge.hidden = false;
      badge.className = open ? 'ct-status is-open' : 'ct-status is-closed';
      badge.textContent = open ? 'Открыто сейчас' : 'Закрыто';
    }

    var copies = document.querySelectorAll('.ct-copy');
    Array.prototype.forEach.call(copies, function (b) {
      var orig = b.textContent;
      b.addEventListener('click', function () {
        var val = b.getAttribute('data-copy') || '';
        var done = function () {
          b.textContent = 'Скопировано'; b.classList.add('is-copied');
          setTimeout(function () { b.textContent = orig; b.classList.remove('is-copied'); }, 1600);
        };
        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(val).then(done, done);
        } else {
          var ta = document.createElement('textarea'); ta.value = val;
          document.body.appendChild(ta); ta.select();
          try { document.execCommand('copy'); } catch (e) {}
          document.body.removeChild(ta); done();
        }
      });
    });
  })();
});
