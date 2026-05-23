# Swiper patterns

Swiper.js — единственный карусельный движок в проекте. Подключён глобально (CSS + JS) в `main.php`.

## Унифицированные стрелки

Все стрелки навигации в проекте — единый стиль через `::before` с `mask-image`.

**Эталон:** `.objects-carousel`. Применяется к стрелкам:
- `.home-banner-swiper-prev/-next` (баннер на главной).
- `.home-videos-swiper-prev/-next` (карусель видео).
- `.reviews-swiper__prev/__next` (отзывы).
- `.ssw-swiper-prev/-next` (объекты).
- `.svc-*` карусели на service-страницах.

**CSS-паттерн** (упрощённо, см. `custom.css`):

```css
.home-banner-swiper-prev,
.home-banner-swiper-next,
.reviews-swiper__prev,
.reviews-swiper__next,
.objects-carousel .swiper-button-prev,
.objects-carousel .swiper-button-next {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: #fff;
  border: 1px solid #d9dde8;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all .2s ease;
}

.<...>-prev::before,
.<...>-next::before {
  content: '';
  width: 16px;
  height: 16px;
  background: #212121;
  mask-image: url('../images/arrow.svg');
  mask-repeat: no-repeat;
  mask-position: center;
}

.<...>-prev:hover,
.<...>-next:hover {
  background: #0e7e50;
}

.<...>-prev:hover::before,
.<...>-next:hover::before {
  background: #fff;
}
```

**Добавляешь новую карусель** → дописываешь её селекторы в групповой блок «стрелки» в `custom.css`, не пиши параллельный стиль.

## Breakpoints (slidesPerView)

Типовой паттерн для карточек (см. карусель отзывов):

```js
new Swiper('.reviews-swiper', {
  slidesPerView: 1.1,
  spaceBetween: 16,
  breakpoints: {
    576:  { slidesPerView: 1.6 },
    768:  { slidesPerView: 2.2 },
    992:  { slidesPerView: 3.2 },
    1200: { slidesPerView: 3.5 },
    1440: { slidesPerView: 4.5 },
  },
  navigation: {
    nextEl: '.reviews-swiper__next',
    prevEl: '.reviews-swiper__prev',
  },
});
```

Дробные `slidesPerView` — намеренно: показывает «обрезанную» следующую карточку, намекая на скролл.

## Скрытие стрелок на узких

На ≤1100px стрелки обычно скрываются (карусель свайпается пальцем):

```css
@media (max-width: 1100px) {
  .reviews-swiper__prev,
  .reviews-swiper__next { display: none; }
}
```

## Типовые карусели в проекте

| Карусель | Контейнер | Виджет / шаблон |
|---|---|---|
| Баннер на главной | `.home-banner-swiper` | `themes/default/views/homepage/hp/page.php` (inline) |
| Видео на главной | `.home-videos-swiper` | `themes/default/views/homepage/hp/page.php` |
| Реализованные объекты | `.ssw-swiper` | `themes/default/views/page/page/works.php` |
| Отзывы | `.reviews-swiper` | `themes/default/views/review/widgets/ReviewCarouselWidget/carousel.php` |
| `.objects-carousel` | разные | служебный legacy |

## Лайтбокс

Для карусели видео и галерей service-страниц — **fancybox** (легаси). Подключён глобально. Атрибут `data-fancybox="<group>"` на ссылках.
