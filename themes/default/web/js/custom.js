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
     Home banner Swiper — «наезд» поверх: активный стоит, новый наезжает
     ======================================================================== */
  (function initHomeBannerSwiper() {
    if (typeof Swiper === 'undefined') return;
    var el = document.querySelector('.home-banner-swiper');
    if (!el) return;

    var DURATION = 700;

    new Swiper(el, {
      loop: true,
      // fade со speed:0 — Swiper мгновенно переключает active без своей анимации
      // дальше мы сами анимируем incoming слайд через CSS transform по swipeDirection
      effect: 'fade',
      fadeEffect: { crossFade: true },
      speed: 0,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      pagination: {
        el: '.home-banner-swiper__pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.home-banner-swiper__next',
        prevEl: '.home-banner-swiper__prev',
      },
      a11y: {
        prevSlideMessage: 'Предыдущий слайд',
        nextSlideMessage: 'Следующий слайд',
      },
      on: {
        slideChangeTransitionStart: function () {
          var active = this.slides[this.activeIndex];
          var prev = this.slides[this.previousIndex];
          if (!active || !prev || active === prev) return;

          // Направление по realIndex с учётом loop wrap-around
          var cur = this.realIndex;
          var was = this.previousRealIndex;
          var n = this.slides.length;
          var forward;
          if (was === n - 1 && cur === 0) forward = true;
          else if (was === 0 && cur === n - 1) forward = false;
          else forward = cur > was;

          // Сбрасываем возможные предыдущие классы и форсим reflow, чтобы анимация перезапустилась
          active.classList.remove('is-coming-right', 'is-coming-left');
          void active.offsetHeight;
          active.classList.add(forward ? 'is-coming-right' : 'is-coming-left');

          // Предыдущий держим видимым под активным на время анимации
          prev.classList.add('is-staying');

          setTimeout(function () {
            active.classList.remove('is-coming-right', 'is-coming-left');
            prev.classList.remove('is-staying');
          }, DURATION + 50);
        },
      },
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

});
