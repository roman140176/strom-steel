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

});
