# Overlay assets: pattern, prefixes, pipeline

## Паттерн overlay-ассетов

`themes/default/web/css/custom.css` и `themes/default/web/js/custom.js` — единственные «живые» ассеты, в которые мы пишем. Подключены в `themes/default/views/layouts/main.php:117-118` **последними** — переопределяют базу без необходимости править артефакты.

**Все новые стили / JS** идут сюда. Создание дополнительных CSS-файлов оправдано только если стилей очень много И они изолированы по странице (пример: `about.css` для `/o-kompanii` — регистрируется через `clientScript->registerCssFile()` в самой view).

## Каталог CSS-префиксов

| Префикс | Раздел | Файлы |
|---|---|---|
| `.svc-*` | Service-страницы (5 шт.) | `themes/default/views/page/page/{slug}.php` |
| `.nws-*` | Новости (виджет на главной + страница списка) | `themes/default/views/news/widgets/LastNewsWidget/lastnewswidget.php`, `themes/default/views/news/news/{index,_item}.php` |
| `.ab-*` | Страница «О компании» (`/o-kompanii`) | `themes/default/views/page/page/o-kompanii.php` + `web/css/about.css` |
| `.aboutus-*` | Блок «Несколько слов о нас» на главной | `themes/default/views/homepage/hp/page.php` |
| `.cf-*` | CTA «Остались вопросы?» на главной | `themes/default/views/homepage/hp/page.php` |
| `.ssw-*` | Карусель реализованных объектов | `themes/default/views/page/page/works.php` (или хомпейдж секция) |
| `.reviews-*` | Карусель отзывов на главной | `themes/default/views/review/widgets/ReviewCarouselWidget/carousel.php` |

**Правило:** новый блок — новый префикс. Не пересекать (например, `.ab-card` и `.svc-card` — две разные реальности).

## Брендинг

- Зелёный: `#0e7e50` / `rgba(14, 126, 80, 1)`. Также синонимы в коде: `var(--hdr-accent)`, `var(--svc-green)`.
- Светлый зелёный с прозрачностью (для фонов hover): `rgba(14, 126, 80, 0.08)` или `0.14`.
- Тёмный зелёный (для CTA-фона на «О компании»): `#0a5e3b` (`--ab-green-deep`).
- Серый icon-bg в шапке: `var(--hdr-icon-bg)` (≈ `#f2f4f8`).

**Анти-брендовые цвета** (остались с легаси, не использовать в новом коде):
- `#1b4e9b` — старый «корпоративный синий».
- `#1f34f2` — старый «акцентный синий».

## Шрифты

- **PLR** — базовый темовский, файлы в `themes/default/web/css/fonts/`. Подключён через `font-face` где-то в `style.min.css`. Используется как `font-family: 'PLR', sans-serif` или через base.
- **Inter** — Google Fonts, подключён в `main.php:116`:
  ```php
  Yii::app()->getClientScript()->registerCssFile('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
  ```
  Используется на service-страницах (`.svc-page` родительский селектор задаёт `font-family: 'Inter'`).

**Не подключай новые шрифты без необходимости.** Уже есть два — обычно хватает.

## Картинки

- **Формат:** AVIF + fallback. Паттерн:
  ```html
  <picture>
    <source srcset="image.avif" type="image/avif">
    <img src="image.png" alt="...">
  </picture>
  ```
- **Расположение:** `themes/default/web/images/` (общетемовские), `public_html/uploads/` (загружаемые админом), `themes/default/web/images/page/about/` (страничные иллюстрации).
- **Адаптив:** mobile-варианты — отдельный `<source media="(max-width: 900px)" srcset="hero-mob.jpg">`. На `/dostavka` пример: `hero.webp` (desktop) + `hero.png` (fallback) + `hero-mob.jpg` (mobile).

## Видео

- Расположение: `public_html/uploads/video/{N}.mp4`, постеры — `public_html/uploads/video/posters/{N}.webp`.
- **Сжатие портретных вертикалок:** ffmpeg до 720×1280 CRF 26 (`-vf "scale=720:1280"  -crf 26 -preset slow`).
- На главной 5 вертикальных видео в Swiper-карусели + лайтбокс (виджет «Производство в видео»).
- **Видеофон на главной** (`themes/default/views/homepage/hp/page.php`) — тоже ужат до этих параметров.

## Accessibility

- Скрытый `<h1 class="sr-only">` на главной — `homepage/hp/page.php`. Класс `.sr-only` определён в `custom.css`. **Не** `display: none` — Google занижает.
- `alt`-атрибуты обязательны для всех `<img>` (задача в backlog: пройтись по магазинному каталогу, см. memory `project_stromsteel_tasks`).
- `aria-label` для иконочных кнопок (магнифер, корзина, избранное).

## Модалки

5 ID-скоупов с унифицированными крестиками (`themes/default/web/css/custom.css`):
`#CallbackEmail`, `#CallbackFormEmail`, `#CallbackProduct`, `#callbackModal`, `#reviewZayavkaModal`.

Стиль `.close`: круг 36×36, фон `#f2f4f8` → hover `#0e7e50` с белой иконкой. **С `!important`**, т.к. `style.min.css` грузится раньше с той же специфичностью.

Новую модалку с тем же стилем — просто допиши ID в групповой селектор в `custom.css`.

## Cookie-баннер

Реализован в `custom.js` (инжектит HTML в `<body>`) + стили в `custom.css`. Управление через `localStorage`. Ссылки на «Политику» — `/politika-konfidencialnosti` (новая вкладка).
